<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AlarmsRepository;
use Illuminate\Support\Facades\App;

class ElasticsearchSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alarm:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email for the audience if given alarm had result';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Schedule started");
        $alarms = App::make(AlarmsRepository::class)->getAll();

        foreach ($alarms as $key => $alarm){
            $result = $alarm->query();
            
            if (sizeof($result)) {
                $alarm->setUpdatedAt($result[0]["_source"]["created_at"]);

                // notify users
                $this->info("An email sent using a queue");
            }
        }

        App::make(AlarmsRepository::class)->storeAll($alarms);

        $this->info("Schedule done");
        return Command::SUCCESS;
    }
}
