<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
use Elastica\Client as ElasticaClient;

class ClientController extends Controller
{
    protected $elasticsearch;
    protected $elastica;

    public function __construct() 
    {
        $this->middleware('auth:api', ['except' => ['elastictest']]);
        $this->elasticsearch = ClientBuilder::create()->build();

        $elasticaConfig = [
            'host' => '192.168.1.105',
            'port' => 9200,
            'index' => 'cnn-2022'
        ];

        $this->elastica = new ElasticaClient($elasticaConfig);
    }

    public function elasticsearchTest() {
        dump($this->elasticsearch);

        $params = [
            'index' => 'cnn-2022',
            'type'=> '_doc',
            'id'=> '1dd2b3cee36ab35352f7c5d72af1b3ab22bf1dd9984a4d7e1cc6d62306b9faa3'
        ];
        $response = $this->elasticsearch->get($params);
        dump($response);

        return response()->json($response);
    }
}
