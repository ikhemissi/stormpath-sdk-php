<?php


require 'vendor/autoload.php';


//$apiKeyFileLocation = "apiKey.id=5PKCXGOZEASRZMN15SN2Z9I7K\napiKey.secret=K3vTMFr3VpBK5HqzI2OloIM2azBs0DCJ3bxwSlq6mqQ";
$apiKeyFileLocation = 'apiKey.properties';

    $builder = new \Stormpath\ClientBuilder();

    $cacheManager = new \Stormpath\Cache\MemcachedManager();
    $cacheManager->addServer('127.0.0.1', '11211', '100');

    $client = $builder->
                setApiKeyFileLocation($apiKeyFileLocation)->
                setCacheManager($cacheManager)->
                build();

echo '<pre>';
$tenant = $client->
            dataStore->
            getResource('https://api.stormpath.com/v1/tenants/current', \Stormpath\Stormpath::TENANT);


var_dump($tenant);

$applications = $client->
                    dataStore->
                    getResource($tenant->applications->href, \Stormpath\Stormpath::APPLICATION);

var_dump($applications);