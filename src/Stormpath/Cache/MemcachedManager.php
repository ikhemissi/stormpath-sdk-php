<?php namespace Stormpath\Cache;


class MemcachedManager implements CacheManager {

    protected $servers = [];

    public function getCache()
    {
        // TODO: Implement getCache() method.
    }

    public function addServer($host, $port, $weight)
    {
        $this->servers = array_merge($this->servers, array('host' => $host, 'port' => $port, 'weight' => $weight));
        return $this;
    }
}