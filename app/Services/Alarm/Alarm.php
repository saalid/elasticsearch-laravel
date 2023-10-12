<?php

namespace App\Services\Alarm;

use App\Services\ElasticClient;
use App\Services\ElasticRepository;

class Alarm
{
    private $field;
    private $value;
    private $lastUpdatedAt;
    private $objElastic;

    public function __construct($field, $value, $lastUpdatedAt)
    {
        $this->field = $field;
        $this->value = $value;
        $this->lastUpdatedAt = $lastUpdatedAt;
        $this->objElastic = new ElasticRepository(app()->make(ElasticClient::class));
    }

    public function query()
    {
        return $this->objElastic->searchAfter($this->field, $this->value, $this->lastUpdatedAt)['hits']['hits']; 
    }

    public function toArray()
    {
        return [
            'fields' => $this->field,
            'value' => $this->value,
            'last_updated_at' => $this->lastUpdatedAt,
        ];
    }

    public function setUpdatedAt($timestamp)
    {
        $this->lastUpdatedAt = $timestamp;
    }

    public static function createFromArray($alarm)
    {
        return new static($alarm["fields"], $alarm["value"], $alarm["last_updated_at"]);
    }
    
}