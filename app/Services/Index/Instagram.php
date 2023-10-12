<?php

namespace App\Services\Index;
use App\Services\ElasticClient;
use App\Services\Index\Index;
use App\Services\ElasticRepository;

class Instagram implements Index
{

    public static function insert($fields){
        $obj = new ElasticRepository(app()->make(ElasticClient::class));
        $obj->create('instagram', null, $fields);
    }
}