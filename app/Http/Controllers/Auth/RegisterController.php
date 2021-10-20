<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserValidation;
use App\Mail\LinnasoftClientsInvoicesSend;
use App\Models\Corporate;
use App\Models\User;
use App\Models\LinnasoftPlan;
use App\Models\LinnasoftSubscription;
use App\Models\LinnasoftInvoice;
use App\Models\LinnasoftSale;
use Auth;
use Session;


class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    //public $result = [];

    public function indexStep1()
    {
        return view('auth.register-step1');
    }

    public function registerStep1(Request $request)
    {
        if($request->firstname != '' && $request->lastname != '' && $request->email != '' && $request->telephone != '' && $request->company != '')
        {
            if(filter_var($request->email, FILTER_VALIDATE_EMAIL))
            {
                $checkUser = User::where('email', $request->email)->count();
                if($checkUser == 0)
                {
                    $request->session()->put('firstname', $request->firstname);
                    $request->session()->put('lastname', $request->lastname);
                    $request->session()->put('email', $request->email);
                    $request->session()->put('telephone', $request->telephone);
                    $request->session()->put('company', $request->company);
                    $request->session()->put('token', md5(rand()).time());

                    return redirect('/nouveau-compte/'.session()->get('token').'/choisir-une-offre');
                }
                else
                {
                    return back()->with('status', 'Cette adresse mail est associée à un compte existant !')->withInput();
                }
            }
            else
            {
                return back()->with('status', 'L\'adresse mail est invalide !')->withInput();
            }
        }
        else
        {
            return back()->with('status', 'Tous les champs sont requis !')->withInput();
        }
    }

    public function indexStep2($token)
    {
        if(session()->exists('token') && session()->get('token') == $token)
        {
            $plans_list = '';
            $plans = LinnasoftPlan::all();
            foreach($plans as $plan)
            {
                $plans_list .= '<div>
                                    <h6>'.$plan->designation.' => <b>'.number_format($plan->monthly_price,2,',',' ').'</b>/mois
                                    </h6>
                                </div>
                                <div>
                                    &bull; Utilisateurs : '.(($plan->users == 'unlimited')? 'illimités': $plan->users).' <br>
                                    &bull; Factures/mois : '.(($plan->invoices == 'unlimited')? 'illimitées': $plan->invoices).' <br>
                                    &bull; Stockage : '.(($plan->files_storage == 'unlimited')? 'illimité': $plan->files_storage.' Go').'
                                </div><br>';
            }

            $payment_modes = DB::table('_linnasoft_payment_modes')->get();

            $data = [
                'plans_fill' => $plans_list,
                'plans' => $plans,
                'payment_modes' => $payment_modes,
                'token' => $token
            ];

            return view('auth.register-step2')->with($data);
        }
        else
        {
            abort(404);
        }
    }

    public function registerStep2($token, Request $request)
    {
        if($request->subscription_plan != '' && $request->subscription_type != '' && $request->address != '' && $request->city != '' && $request->country != ''  && $request->currency != ''  && $request->payment_mode != '')
        {
            if((session()->exists('firstname') && session()->get('firstname') != null) && (session()->exists('lastname') && session()->get('lastname') != null) && (session()->exists('email') && session()->get('email') != null) && (session()->exists('telephone') && session()->get('telephone') != null) && (session()->exists('company') && session()->get('company') != null))
            {
                $password_generated = get_random(8);

                /*********************INSERT IN CORPORATES TABLE**************************/
                    $corp_token = md5(rand()).time();
                    $comp = new Corporate();
                    $comp->corp_name = session()->get('company');
                    $comp->telephone = session()->get('telephone');
                    $comp->currency = $request->currency;
                    $comp->address = $request->address;
                    $comp->city = $request->city;
                    $comp->country = $request->country;
                    $comp->token = $corp_token;
                    $comp->corp_state = 1;
                    $comp->save();
                /*********************INSERT IN CORPORATES TABLE**************************/

                /*********************INSERT IN USERS TABLE**************************/
                    $token = md5(rand()).time().'us';
                    $user = new User();
                    $user->first_name = session()->get('firstname');
                    $user->last_name = session()->get('lastname');
                    $user->email = trim(session()->get('email'));
                    $user->password = Hash::make($password_generated);
                    $user->user_role = 'user_admin';
                    $user->corp_id = $comp->id;
                    $user->token = $token;
                    $user->save();
                /*********************INSERT IN USERS TABLE**************************/

                /******************NUMBER GENERATED BY COUNTER**********************/
                    $get_last_counter = LinnasoftSubscription::orderBy('id', 'DESC')
                                      ->first();

                    if($get_last_counter == null) //the first row  ...
                    {
                        $current_counter = 999;
                        $new_counter = $current_counter+1;
                    }
                    else //
                    {
                        $current_counter = intval($get_last_counter->counter);
                        $new_counter = intval($get_last_counter->counter)+1;
                    }

                    $number = generate_number_from_params($current_counter, 5, 'L');
                /******************NUMBER GENERATED BY COUNTER*********************/

                /*********************INSERT IN SUBSCRIPTION TABLE**************************/
                    $price = LinnasoftPlan::find($request->subscription_plan)->monthly_price;

                    $discount = (LinnasoftSale::find(1)->clients_discount == null)? 0: LinnasoftSale::find(1)->clients_discount;
                    $yearly_price = ($price*12) - value_from_percent($discount, ($price*12));

                    $subscription = new LinnasoftSubscription();
                    $subscription->client_id = $comp->id;
                    $subscription->counter = $new_counter;
                    $subscription->client_number = $number;
                    $subscription->base_price = ($request->subscription_type == 'monthly')? $price: $yearly_price;
                    $subscription->subscription_type = ($request->subscription_type == 'monthly' || $request->subscription_type == 'yearly')? $request->subscription_type: 'monthly';
                    $subscription->subscription_started_at = date('Y-m-d');
                    $subscription->subscription_plan_id = (is_numeric($request->subscription_plan) && $request->subscription_plan > 0)? $request->subscription_plan: 1;
                    $subscription->payment_mode = $request->payment_mode;
                    $subscription->save();
                /*********************INSERT IN SUBSCRIPTION TABLE**************************/

                /*********************INSERT IN INVOICES TABLE****************************/
                    /******************NUMBER GENERATED BY COUNTER**********************/
                        $check_invoice = LinnasoftInvoice::whereYear('invoice_date', date('Y'))
                                       ->get();

                        $get_last_counter = LinnasoftInvoice::whereYear('invoice_date', date('Y'))
                                          ->orderBy('id', 'DESC')
                                          ->first();

                        if($check_invoice->count() == 0) //the first row of current year ...
                        {
                            $current_counter = 99;
                            $new_counter = $current_counter+1;
                        }
                        else //
                        {
                            $current_counter = intval($get_last_counter->counter);
                            $new_counter = intval($get_last_counter->counter)+1;
                        }

                        $number = 'LS'.generate_number_from_counter($current_counter).time();
                    /******************NUMBER GENERATED BY COUNTER*********************/

                    /***********************************************************/
                        $starting_date = date('Y-m-d');

                        $deadline_day = date('d');
                        $sale_config = LinnasoftSale::find(1);

                        $tax = ($sale_config->tax_applied == null)? 0: $sale_config->tax_applied;
                        $total_with_tax = ($subscription->base_price + (($subscription->base_price*$tax)/100));
                        $day_to_due_date = ($sale_config->invoices_deadline_d == null)? 0: $sale_config->invoices_deadline_d;

                        $generated_invoice = new LinnasoftInvoice();
                        $generated_invoice->counter = $new_counter;
                        $generated_invoice->client_id = $subscription->client_id;
                        $generated_invoice->invoice_date = date('Y-m-d');
                        $generated_invoice->invoice_due_date = date('Y-m-d', strtotime(date('Y-m-d').' + '.$day_to_due_date.' day'));
                        $generated_invoice->invoice_number = $number;
                        $generated_invoice->invoice_tax = $tax;
                        $generated_invoice->invoice_total_tax_excluded = $subscription->base_price;
                        $generated_invoice->invoice_total_tax_included = $total_with_tax;
                        $generated_invoice->save();
                    /***********************************************************/
                /*********************INSERT IN INVOICES TABLE***************************/

                Mail::to(trim(session()->get('email')))->send(new UserValidation(session()->get('company'),session()->get('firstname'), session()->get('lastname'), $password_generated, $generated_invoice->id));


                $email = session()->get('email');
                session()->flush();
                
                /*
                    $title = 'Bienvenue sur <b>'.config('app.name').'</b>';

                    $notification = new Notification();
                    $notification->title = $title;
                    $notification->status = 'unseen';
                    $notification->_type = 'welcome';
                    $notification->corp_id = $comp->id;
                    $notification->data_linked_type = null;
                    $notification->data_linked_id = null;
                    $notification->save();
                */

                return view('auth.user-created')->with('email', $email);
            }
            else
            {
                return back()->with('status', 'Une erreur s\'est produite, réessayez !')->withInput();
            }
        }
        else
        {
            return back()->with('status', 'Tous les champs sont requis !')->withInput();
        }
    }
}