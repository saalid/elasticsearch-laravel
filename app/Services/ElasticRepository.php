<?php

namespace App\Services;
use Elastic\Elasticsearch\Client;
use App\Services\ElasticClient;

class ElasticRepository implements ElasticClient
{
    public function __construct(protected Client $client)
    {
        
    }

    /**
     * This function add data in index
     * @param string $index 
     * @param string $id
     * @param array $fields 
     * 
     */
    public function create($index, $id, $fields) 
    {
        if($id !== null){
            $params = [
                'index' => $index,
                'id' => $id,
                'body'  => $fields
            ];
        }else{
            $params = [
                'index' => $index,
                'body'  => $fields
            ];
        }
        
        $response = $this->client->index($params);
        if($response->getStatusCode() === 200) {
            return true;
        } else{
            return false;
        }
    }

    public function getDocument($params)
    {   
        $response = $this->client->get($params);

        return json_decode($response, true);

    }

    public function search($fields, $query, $indexes = '*')
    {
        $params = [
            'index' => $indexes,
            'body'  => [
                'query' => [
                    'simple_query_string' => [
                        "query" => $query,
                        "fields" => $fields,
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);

        return json_decode($response, true);
    }

    public function searchAfter($fields, $query, $after, $indexes = '*')
    {
        $params = [
            'index' => $indexes,
            'body'  => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'simple_query_string' => [
                                    "query" => $query,
                                    "fields" => $fields,
                                ]
                            ],
                            [
                                "range"=> [
                                    "created_at"=> [
                                        "gt"=> $after
                                    ]
                                ]
                            ]
                        ]
                    ]

                    
                ]
            ]
        ];
        $response = $this->client->search($params);

        return json_decode($response, true);
    }
    
    public function deleteIndex($index){
        // TODO
        // $params =  ['index' => $index,"id"=>"eJr56YzpQDyE-NLFwLWn3A"];
        // $response = $this->client->delete($params);
        // return json_decode($response, true);
    }

}