<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Corporate;
use App\Models\Linnasoft;
use App\Models\LinnasoftSubscription;
use App\Models\LinnasoftInvoice;
use App\Models\LinnasoftPayment;
use App\Models\LinnasoftSale;
use App\Mail\LinnasoftClientsInvoicesSend;
use Response;
use PDF;

class LinnasoftClientsBalancesCheck extends Command
{
    protected $signature = 'LinnasoftClientsBalancesCheck:Cron';
    protected $description = 'This commande will run daily and block clients that current balances are positive';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $subscriptions = LinnasoftSubscription::all();

        foreach($subscriptions as $subscription)
        {
            $client_invoices = LinnasoftInvoice::where('client_id', $subscription->client_id)->get();
            $paid_counter = $unpaid_counter = 0;

            foreach($client_invoices as $invoice)
            {
                if($invoice->invoice_due_date < date('Y-m-d'))
                {
                    $payments = LinnasoftPayment::where('invoice_id', $invoice->id)->sum('amount');

                    if(floatval($payments) != floatval($invoice->invoice_total_tax_included))
                    {
                        $client = Corporate::find($subscription->client_id);
                        $client->corp_state = 0;
                        $client->save();

                        $unpaid_counter++;
                    }
                    else
                    {
                        $paid_counter++;
                    }
                }
            }

            //check if $paid_counter == expired invoices
            $client_expired_invoices = LinnasoftInvoice::where('client_id', $subscription->client_id)
                                     ->where('invoice_due_date', '<', date('Y-m-d'))
                                     ->count();
            if($client_expired_invoices == $paid_counter)
            {
                $client = Corporate::find($subscription->client_id);
                $client->corp_state = 1;
                $client->save();
            }
        }

        $this->info('Clients balances checked !');
    }
}
