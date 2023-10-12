<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ElasticPing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Connection';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = app()->make('client')->info();
        if($response->getStatusCode() === 200) {
            echo "connection is estable\n";
            return Command::SUCCESS;
        }else{
            
        }
        
    }
}
