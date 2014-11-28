<?php


class Memcached implements Cache, CacheManager {
    public function getCache() {}

    public function get($key) {}
    public function put($key, $value, $minutes) {}
    public function increment($key, $value = 1) {}
    public function decrement($key, $value = 1) {}
    public function forever($key, $value) {}
    public function forget($key) {}
    public function flush() {}
}

interface Cache {
    public function get($key);
    public function put($key, $value, $minutes);
    public function increment($key, $value = 1);
    public function decrement($key, $value = 1);
    public function forever($key, $value);
    public function forget($key);
    public function flush();

}

interface CacheManager {
    public function getCache();

}

$optionsArray = array(
    'TTL' => 240, //Default TTL OVERRIDE 4 hours (240 minutes)
    'account' => array( //Account region settings
        'TTL' => 120, //2 hours (120 minutes)
        'TTI' => 60 //1 hour (60 minutes)
    )
);
$cache = new Memcached($optionsArray);
$client = new \Stormpath\ClientBuilder()
                ->setCacheManager($cache)
                ->build();





