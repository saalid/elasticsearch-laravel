<?php
namespace App\Services;

interface ElasticClient 
{

    public function create($index, $id, $fields);
    public function getDocument($params);
    public function search($fields, $query, $indexes = '*');
    public function searchafter($fields, $query, $after, $indexes = '*');
    public function deleteIndex($index);


}