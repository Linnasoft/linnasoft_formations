<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanStorage extends Command
{
    protected $signature = 'CleanStorage';
    protected $description = 'This command will clean storage directory !';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $folder1 = "storage/app/public/data_files";
        if(is_dir($folder1))
        {
            $files = glob($folder1.'/*');
            foreach($files as $file)
            { 
                if(is_file($file)) 
                {
                    unlink($file); 
                }
            } 
        }

        $folder2 = "storage/app/public/logo";
        if(is_dir($folder2))
        {
            $files = glob($folder2.'/*');
            foreach($files as $file)
            { 
                if(is_file($file)) 
                {
                    unlink($file); 
                }
            } 
        }

        $this->info('Storage cleaned, all files deleted !');
    }
}
