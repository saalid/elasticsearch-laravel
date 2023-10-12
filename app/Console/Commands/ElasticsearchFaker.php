<?php

namespace App\Console\Commands;

use App\Services\ElasticRepository;
use Illuminate\Console\Command;
use App\Services\ElasticClient;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\App;

class ElasticsearchFaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:fake {index} {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Fake data to indices elastic';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()

    {
        $faker = App::make(Faker::class);
        $index = $this->argument('index');
        $count = $this->argument('count');
        if(!isset($count)){
            $count = $faker->numberBetween($min = 1, $max = 10000);
        }

        switch ($index) {
            case 'news':
                for($i=1; $i<=$count; $i++){
                    $this->news($i);
                }
                echo "Fake data about news index imported";
                break;
            case 'instagram':
                for($i=1; $i<=$count; $i++){
                    $this->instagram($i);
                }
                echo "Fake data about instagram index imported";
                break;
            case 'twitter':
                for($i=1; $i<=$count; $i++){
                    $this->twitter($i);
                }
                echo "Fake data about twitter index imported";
                break;
            default :
                echo "Index not exist";

        }

        return Command::SUCCESS;
        
    }

    protected function news($id){
        $faker = App::make(Faker::class);
        $obj = new ElasticRepository(app()->make(ElasticClient::class));
        $link = explode(" ", $faker->name)[0];
        $fields = [
            'title'=> $faker->sentence,
            'source'=>  $faker->name,
            'data'=>  $faker->paragraph,
            'link'=> "http://$link.ir",
            'avatar'=> $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker'),
            'created_at' => $this->getRandomTimestamp(),
            'updated_at' => $this->getRandomTimestamp(),

        ];
        $obj->create('news', $id, $fields);
    }
    protected function instagram($id){
        $faker = App::make(Faker::class);
        $obj = new ElasticRepository(app()->make(ElasticClient::class));
        $fields = [
            'name'=> $faker->name,
            'username'=> $faker->name,
            'title'=> $faker->sentence,
            'gallery_pic'=>  $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker'),
            'gallery_video'=>  $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker'),
            'text'=> $faker->paragraph,
            'avatar'=> $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker'),
            'created_at' => $this->getRandomTimestamp(),
            'updated_at' => $this->getRandomTimestamp(),

        ];
        $obj->create('instagram', $id, $fields);
    }

    protected function twitter($id){
        $faker = App::make(Faker::class);
        $obj = new ElasticRepository(app()->make(ElasticClient::class));
        $fields = [
            'name'=> $faker->name,
            'count_twitt'=> $faker->numberBetween($min = 1, $max = 10000),
            'gallery_pic'=>  $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker'),
            'twitt'=> $faker->paragraph,
            'avatar'=> $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker'),
            'created_at' => $this->getRandomTimestamp(),
            'updated_at' => $this->getRandomTimestamp(),

        ];
        $obj->create('twitter', $id, $fields);
    }

    protected function getRandomTimestamp()
    {
        $faker = App::make(Faker::class);
        
        return Carbon::parse($faker->dateTimeBetween('-5 week', 'now')->format("Y-m-d H:i:s"))->timestamp;
    }
}
