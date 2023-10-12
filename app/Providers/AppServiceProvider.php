<?php

namespace App\Providers;

use App\Services\AlarmsRepository;
use Elastic\Elasticsearch\ClientBuilder;
use App\Services\ElasticClient;
use App\Services\JsonAlarmsRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        App::bind(AlarmsRepository::class, function($app) {
            return new JsonAlarmsRepository;
        });

        App::bind(ElasticClient::class, function($app) {
            return ClientBuilder::create()
                ->setHosts(['localhost:9200'])
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
