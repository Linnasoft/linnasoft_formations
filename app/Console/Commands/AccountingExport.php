<?php

namespace App\Console\Commands;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Imports\InvoicesImport;
use App\Models\User;
use App\Models\Files;
use App\Models\Corporate;
use App\Models\AccountingPeople;
use App\Models\AccountingDocument;
use App\Models\AccountingScheduler;
use App\Models\AccountingExportList;
use App\Models\Invoice;
use App\Models\Bill;
use App\Models\CreditNote;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\ProductMovements;
use App\Models\Client;
use App\Mail\AccountingDocumentsSend;
use App\Mail\InformUsersAccountingDocumentsSent;
use Response;
use PDF;

class AccountingExport extends Command
{
    protected $signature = 'AccountingExport:Cron';
    protected $description = 'This command will send accounting documents if scheduler is activated !';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {   
        
    }
}
