<?php namespace Stormpath\Cache;


class MemcachedManager implements CacheManager {

    protected $servers = [];

    public function getCache()
    {
        return new MemcachedCache($this->servers);
    }

    public function addServer($host, $port, $weight)
    {
        $this->servers[] = array('host' => $host, 'port' => $port, 'weight' => $weight);

        return $this;
    }
}