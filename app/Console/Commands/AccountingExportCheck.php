<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Files;
use App\Models\Corporate;
use App\Models\AccountingDocument;
use App\Models\AccountingScheduler;
use App\Models\AccountingExportList;
use App\Models\Bill;
use App\Models\Transaction;
use App\Mail\AccountingDocumentsCheck;
use Response;
use PDF;

class AccountingExportCheck extends Command
{
    
    protected $signature = 'AccountingExportCheck:Cron';
    protected $description = 'This command will check if all files to export are stored.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //GET SCHEDULER
        $schedulers = AccountingScheduler::where('status', 1)->get();

        foreach($schedulers as $scheduler)
        {
            $list = [];
            $corp_id = $scheduler->corp_id;

            //GET CORPORATE
            $corporate = Corporate::where('id', $corp_id)->where('corp_state', 1)->first();

            if($corporate != null) //EXPORTATIONS ARE BASED ON CURRENT YEAR
            {
                if($scheduler->period == 'monthly') //exportation each month
                {
                    $from = '01/'.date('m/Y');
                    $end = last_day_of(intval(date('m'))).'/'.date('m/Y');
                }
                elseif($scheduler->period == 'quarterly')
                {
                    $from = get_period_interval_with_date('quarter' ,date('Y-m-d'))['start'].'/'.date('Y');
                    $end = get_period_interval_with_date('quarter', date('Y-m-d'))['end'].'/'.date('Y');
                }
                elseif($scheduler->period == 'half-yearly')
                {
                    $from = get_period_interval_with_date('half-year' ,date('Y-m-d'))['start'].'/'.date('Y');
                    $end = get_period_interval_with_date('half-year', date('Y-m-d'))['end'].'/'.date('Y');
                }
                elseif($scheduler->period == 'yearly')
                {
                    $from = '01/01/'.date('Y');
                    $end = '31/12/'.date('Y');
                }

                $deadline = dateDiff(sqlDate($end), date('Y-m-d'));
                //CHECK IF EXPORT_DATE - CURRENT_DATE <= 7 DAYS
                if($deadline <= 7)
                {
                    //CHECK IF BILLS ARE ALL STORED
                    $bills = Bill::where('corp_id', $corp_id)
                           ->where('bill_status', null)
                           ->whereBetween('bill_date', [sqlDate($from), sqlDate($end)])
                           ->get();
            
                    if($bills->count() > 0)
                    {
                        foreach($bills as $bill)
                        {
                            $files = Files::where('corp_id', $corp_id)
                                ->where('data_type', 'bill')
                                ->where('data_id', $bill->id)
                                ->count();
                            
                            if($files == 0)
                            {
                                $list[] = [
                                    'data' => $bill->id,
                                    'type' => 'bill'
                                ];
                            }
                        }
                    }

                    //CHECK IF TRANSACTIONS ARE ALL STORED
                    $transactions = Transaction::where('corp_id', $corp_id)
                                  ->whereBetween('payment_date', [sqlDate($from), sqlDate($end)])
                                  ->where('linked_document_type', null)
                                  ->where('linked_document_id', null)
                                  ->get();
            
                    if($transactions->count() > 0)
                    {
                        foreach($transactions as $transaction)
                        {
                            $files = Files::where('corp_id', $corp_id)
                                ->where('data_type', 'transaction')
                                ->where('data_id', $transaction->id)
                                ->count();
                            
                            if($files == 0)
                            {
                                $list[] = [
                                    'data' => $transaction->id,
                                    'type' => 'transaction'
                                ];
                            }
                        }
                    }

                    if(count($list) > 0)
                    {
                        $user = User::where('corp_id', $corp_id)
                            ->where('admin', 1)
                            ->first();
                        
                        Mail::to($user->email)->send(new AccountingDocumentsCheck('Export comptable : pièces justificatives manquantes', $corporate->corp_name, $user->first_name, $corp_id, $from, $end, $list, $deadline));
                    }
                }
            }

            $this->info('Export documents checked !');
        }
    }
    
}
