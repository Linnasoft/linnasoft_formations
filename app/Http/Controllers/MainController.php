<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Student;
use App\Models\GC;
use App\Models\Dates;
use App\Models\Transaction;
use Illuminate\Support\Facades\App;
use PDF;
use Auth;
use Response;

class MainController extends Controller
{
    public function StudentsInscriptionIndex($token)
    {
        $formation = Formation::where('token', $token)->where('f_state', 'active')->first();
        if(!$formation)
        {
            abort(404);
        }

        $registered_students = Student::where('formation_id', $formation->id)->count();
        if($formation->f_max_students == $registered_students)
        {
            abort(500, 'Les inscriptions pour la formation ciblée sont terminées; merci de nous contacter au : +223 75 82 20 48');
        }

        $conditions = GC::all();
        $dates = Dates::where('formation_id', $formation->id)
               ->orderBy('starts_on')
               ->get();

        $data = [
            'category_name' => '',
            'page_name' => 'students_inscription',
            'page_title' => 'Inscrivez-vous',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'formation' => $formation,
            'conditions' => $conditions,
            'dates' => $dates
        ];

        return view('students_inscription_index')->with($data);
    }

    public function StudentsInscription(Request $req, $formation)
    {
        $result = [];

        $target_formation = Formation::find($formation);
        $registered_students = Student::where('formation_id', $formation)->count();
        if($target_formation->f_max_students > $registered_students)
        {
            if($req->gender)
            {
                if($req->firstname != '')
                {
                    if($req->lastname != '')
                    {
                        if($req->email != '')
                        {
                            if(filter_var($req->email, FILTER_VALIDATE_EMAIL))
                            {
                                if($req->phone != '')
                                {
                                    $is_already_register = Student::where('email', $req->email)
                                                        ->where('phone_number', $req->phone)
                                                        ->where('formation_id', $formation)
                                                        ->first();

                                    if(!$is_already_register)
                                    {
                                        $token = md5(rand()).time();

                                        $student = new Student();
                                        $student->firstname = $req->firstname;
                                        $student->lastname = $req->lastname;
                                        $student->email = $req->email;
                                        $student->phone_number = $req->phone;
                                        $student->gender = ($req->gender == 'female')? 'f': 'm';
                                        $student->formation_id = $formation;
                                        $student->token = $token;
                                        $student->save();

                                        $result = [
                                            'type' => 'success',
                                            'msg' => 'BRAVO, vous ête inscrit'.(($req->gender == 'female')? 'e': '').' avec succès !'
                                        ];
                                    }
                                    else
                                    {
                                        $result = [
                                            'type' => 'error',
                                            'msg' => 'Vous êtes déjà inscrit(e) pour cette formation !'
                                        ];
                                    }
                                }
                                else
                                {
                                    $result = [
                                        'type' => 'error',
                                        'msg' => 'Entrez votre numéro de téléphone svp !'
                                    ];
                                }
                            }
                            else
                            {
                                $result = [
                                    'type' => 'error',
                                    'msg' => 'L\'email renseigné n\'est pas valide !'
                                ];
                            }
                        }
                        else
                        {
                            $result = [
                                'type' => 'error',
                                'msg' => 'Entrez votre email svp !'
                            ];
                        }
                    }
                    else
                    {
                        $result = [
                            'type' => 'error',
                            'msg' => 'Entrez votre nom svp !'
                        ];
                    }
                }
                else
                {
                    $result = [
                        'type' => 'error',
                        'msg' => 'Entrez votre prénom svp !'
                    ];
                }
            }
            else
            {
                $result = [
                    'type' => 'error',
                    'msg' => 'Cochez le sexe svp !'
                ];
            }
        }
        else
        {
            $result = [
                'type' => 'error',
                'msg' => 'Plus de place disponible pour cette formation; merci de nous contacter au : +223 75 82 20 48 !'
            ];
        }

        return $result;
    }

    public function adminDashboard()
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'dashboard',
            'page_title' => 'Dashboard',
            'has_scrollspy' => 0,
            'scrollspy_offset' => ''
        ];

        return view('dashboard')->with($data);
    }

    public function adminFormations()
    {
        $formations = Formation::orderBy('id', 'DESC')->get();

        $data = [
            'category_name' => 'formations',
            'page_name' => 'formations',
            'page_title' => 'Formations',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'formations' => $formations
        ];

        return view('formations')->with($data);
    }

    public function adminSingleFormation($token)
    {
        $formation = Formation::where('token', $token)->first();
        if(!$formation)
        {
            abort(404);
        }

        $students_n_payments = [];

        $dates = Dates::where('formation_id', $formation->id)->get();
        $students = Student::where('formation_id', $formation->id)->get();
        foreach($students as $student)
        {
            $payment = Transaction::where('student_id', $student->id)->sum('amount_paid');

            $students_n_payments[] = [
                'id' => $student->id,
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
                'gender' => $student->gender,
                'email' => $student->email,
                'phone' => $student->phone_number,
                'date' => $student->created_at,
                'payment' => $payment
            ];
        }

        $data = [
            'category_name' => 'formations',
            'page_name' => 'formations',
            'page_title' => 'Formation',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'formation' => $formation,
            'dates' => $dates,
            'students' => $students_n_payments
        ];

        return view('single-formation')->with($data);
    }

    public function deleteFormation($formation_id)
    {
        $formation = Formation::find($formation_id);

        $dates = Dates::where('formation_id', $formation_id)->delete();
        $transactions = Transaction::where('formation_id', $formation_id)->delete();
        $students = Student::where('formation_id', $formation_id)->delete();
        $formation->delete();

        return 'Formation supprimée avec succès !';
    }

    public function addNewFormation(Request $req, $count_date)
    {
        $result = [];

        if($count_date && is_numeric($count_date) && $count_date > 0)
        {
            if($req->formation_title && $req->formation_title != '')
            {
                if($req->formation_type == 'physical' || $req->formation_type == 'online')
                {
                    if($req->formation_price && is_numeric($req->formation_price) && $req->formation_price > 0)
                    {
                        if($req->formation_max_students && is_numeric($req->formation_max_students) && $req->formation_max_students > 0)
                        {
                            if($req->formation_description && $req->formation_description != '')
                            {
                                $token = md5(rand()).time();

                                $formation = new Formation();
                                $formation->token = $token;
                                $formation->f_title = $req->formation_title;
                                $formation->f_price = $req->formation_price;
                                $formation->f_description = $req->formation_description;
                                $formation->f_certification = ($req->formation_certification)? 'yes': 'no';
                                $formation->f_requirements = ($req->formation_requirements == '')? null: $req->formation_requirements;
                                $formation->f_type = $req->formation_type;
                                $formation->f_max_students = $req->formation_max_students;
                                $formation->f_state = 'active';
                                $formation->save();

                                for($i=1; $i <= $count_date; $i++)
                                {
                                    $dates = new Dates();
                                    $dates->formation_id = $formation->id;
                                    $dates->starts_on = sqlDate($req->input('starton'.$i));
                                    $dates->starts_at = $req->input('startat'.$i);
                                    $dates->ends_at = $req->input('endat'.$i);
                                    $dates->save();
                                }

                                $result = [
                                    'type' => 'success',
                                    'msg' => ' Nouvelle formation enregistrée avec succès !',
                                    'id' => $formation->id,
                                    'token' => $formation->token,
                                    'title' => $formation->f_title,
                                    'type' => formation_type($formation->type),
                                    'price' => number_format($formation->f_price,0,',',' '),
                                    'max_students' => $formation->f_max_students,
                                    'certification' => is_certif($formation->f_certification),
                                    'state' => ($formation->f_state == 'active')? 'Activée': 'Desactivée'
                                ];
                            }
                            else
                            {
                                $result = [
                                    'type' => 'error',
                                    'msg' => 'Entrez une description de la formation !'
                                ];
                            }
                        }
                        else
                        {
                            $result = [
                                'type' => 'error',
                                'msg' => 'Entrez le nombre max de places (valeur numérique supérieure à 0) !'
                            ];
                        }
                    }
                    else
                    {
                        $result = [
                            'type' => 'error',
                            'msg' => 'Entrez le tarif (valeur numérique supérieure à 0) !'
                        ];
                    }
                }
                else
                {
                    $result = [
                        'type' => 'error',
                        'msg' => 'Selectionnez le type de la formation !'
                    ];
                }
            }
            else
            {
                $result = [
                    'type' => 'error',
                    'msg' => 'Le titre de la formation est requis !'
                ];
            }
        }
        else
        {
            $result = [
                'type' => 'error',
                'msg' => 'Date introuvable !'
            ];
        }

        return $result;
    }

    public function changeFormationState($formation_id)
    {
        $formation = Formation::find($formation_id);
        $formation->f_state = (($formation->f_state == 'active')? 'desabled': 'active');
        $formation->save();

        return [
            'msg' => 'La formation a été '.(($formation->f_state == 'active')? 'activée !': 'désactivée !'),
            'state' => '<b>'.(($formation->f_state == 'active')? 'Activée': 'Désactivée').'</b>'
        ];
    }

    public function deleteStudent($student_id)
    {
        $student = Student::find($student_id);
        $transactions = Transaction::where('student_id', $student->id)->delete();
        $student->delete();

        return 'Inscription supprimée avec succès !';
    }

    public function adminTransactions()
    {
        $transactions_list = [];
        $transactions = Transaction::orderBy('id', 'DESC')->get();
        foreach($transactions as $transaction)
        {
            $formation = Formation::find($transaction->formation_id);
            $student = Student::find($transaction->student_id);

            $transactions_list[] = [
                'id' => $transaction->id,
                'amount' => $transaction->amount_paid,
                'payment_mode' => $transaction->payment_mode,
                'date' => $transaction->payment_date,
                'formation' => $formation->f_title,
                'student' => $student->firstname.' '.$student->lastname
            ];
        }

        $students_list = [];
        $students = Student::orderBy('id', 'DESC')->get(); //where payment not done
        foreach($students as $student)
        {
            $formation = Formation::find($student->formation_id);
            $transaction = Transaction::where('student_id', $student->id)->sum('amount_paid');

            if($transaction < $formation->f_price)
            {
                $students_list[] = [
                    'firstname' => $student->firstname,
                    'lastname' => $student->lastname,
                    'id' => $student->id
                ];
            }
        }

        $data = [
            'category_name' => 'transactions',
            'page_name' => 'transactions',
            'page_title' => 'Transactions',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'transactions' => $transactions_list,
            'students' => $students_list
        ];

        return view('transactions')->with($data);
    }

    public function deleteTransaction($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        $transaction->delete();

        return 'Transaction supprimée avec succès !';
    }

    public function addNewTransaction(Request $req)
    {
        $result = [];

            if($req->transaction_student && is_numeric($req->transaction_student))
            {
                if($req->transaction_amount && is_numeric($req->transaction_amount) && $req->transaction_amount > 0)
                {
                    if($req->transaction_date && $req->transaction_date != '')
                    {
                        if($req->transaction_payment_mode && $req->transaction_payment_mode != '')
                        {
                                $student = Student::find($req->transaction_student);
                                $formation = Formation::find($student->formation_id);

                                $transaction = new Transaction();
                                $transaction->formation_id = $formation->id;
                                $transaction->student_id = $req->transaction_student;
                                $transaction->payment_date = sqlDate($req->transaction_date);
                                $transaction->amount_paid = $req->transaction_amount;
                                $transaction->payment_mode = $req->transaction_payment_mode;
                                $transaction->save();

                                $result = [
                                    'type' => 'success',
                                    'msg' => ' Nouvelle transaction enregistrée avec succès !',
                                    'id' => $transaction->id,
                                    'date' => returnDate($transaction->payment_date),
                                    'amount' => number_format($transaction->amount_paid,0,',',' '),
                                    'payment_mode' => $transaction->payment_mode,
                                    'student' => $student->firstname.' '.$student->lastname,
                                    'formation' => $formation->f_title
                                ];
                        }
                        else
                        {
                            $result = [
                                'type' => 'error',
                                'msg' => 'Entrez le nombre max de places (valeur numérique supérieure à 0) !'
                            ];
                        }
                    }
                    else
                    {
                        $result = [
                            'type' => 'error',
                            'msg' => 'Entrez la date de paiement !'
                        ];
                    }
                }
                else
                {
                    $result = [
                        'type' => 'error',
                        'msg' => 'Le montant payé doit être une valeur numérique > 0 !'
                    ];
                }
            }
            else
            {
                $result = [
                    'type' => 'error',
                    'msg' => 'Selectionnez l\'etudiant !'
                ];
            }

        return $result;
    }

    public function getCertificate($student_id)
    {
        $student = Student::find($student_id);
        $formation = Formation::find($student->formation_id);
        $date_start = Dates::where('formation_id', $formation->id)->min('starts_on');
        $date_end = Dates::where('formation_id', $formation->id)->max('starts_on');

        $data = [
            'student' => $student,
            'formation' => $formation,
            'date_start' => $date_start,
            'date_end' => $date_end
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('certificate', ['data'=>$data])->setPaper('a4', 'landscape');

        return $pdf->download('Certificat '.config('app.name').' - '.$student->firstname.' '.$student->lastname.'.pdf', array("Attachment" => false)) ;
    }

    public function generateCertificate($student_id)
    {
        $student = Student::find($student_id);
        $formation = Formation::find($student->formation_id);
        $date = Dates::where('formation_id', $formation->id)
              ->orderBy('starts_on', 'DESC')
              ->first()
              ->starts_on;

        $data = [
            'student' => $student,
            'formation' => $formation,
            'date' => $date
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('certificate', ['data'=>$data])->setPaper('a4', 'landscape');

        return $pdf;
    }

    public function getAllCertificates($formation_id)
    {
        $temp_files = [];

        $formation = Formation::find($formation_id);
        $students = Student::where('formation_id', $formation_id)->get();
        $zip = new \PhpZip\ZipFile();

        foreach($students as $student)
        {
            $transaction = Transaction::where('student_id', $student->id)
                         ->sum('amount_paid');
            if($formation->f_price == $transaction)
            {
                $temp_file_token = $student->token;
                file_put_contents('temp_storage/'.$temp_file_token.'.pdf', $this->generateCertificate($student->id)->output());

                $zip->addFile('temp_storage/'.$temp_file_token.'.pdf', 'Certificat Linnasoft - '.$student->firstname.' '.$student->lastname.'.pdf');

                $temp_files[] = [
                    'file' => $temp_file_token.'.pdf',
                    'path' => 'temp_storage/'
                ];
            }
        }

        $zip->outputAsAttachment('certificats.zip');
        //unlink temp files
        if(count($temp_files) > 0)
        {
            foreach($temp_files as $temp)
            {
                if(is_file($temp['path'].$temp['file']))
                {
                    unlink($temp['path'].$temp['file']);
                }
            }
        }
    }
}
