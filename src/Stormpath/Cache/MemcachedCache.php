<?php namespace Stormpath\Cache;

use Memcached;

class MemcachedCache implements Cache {

    /**
     * The Memcached instance.
     *
     * @var \Memcached
     */
    protected $memcached;
    /**
     * A string that should be prepended to keys.
     *
     * @var string
     */
    protected $prefix;
    /**
     * Create a new Memcached store.
     *
     * @param  \Memcached  $memcached
     * @param  string      $prefix
     * @return void
     */
    public function __construct(Array $servers, $prefix = 'stormpath')
    {
        $this->memcached = new Memcached();
        $this->memcached->addServers($servers);
        $this->prefix = $prefix;
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @param  string $key
     * @return mixed
     */
    public function get($key)
    {
        $value = $this->memcached->get($this->prefix.$key);
        if ($this->memcached->getResultCode() == 0)
        {
            return $value;
        }
    }

    /**
     * Store an item in the cache for a given number of minutes.
     *
     * @param  string $key
     * @param  mixed $value
     * @param  int $minutes
     * @return void
     */
    public function put($key, $value, $minutes = 120)
    {
        $this->memcached->set($this->prefix.$key, $value, $minutes * 60);
    }

    /**
     * Remove an item from the cache.
     *
     * @param  string $key
     * @return bool
     */
    public function delete($key)
    {
        return $this->memcached->delete($this->prefix.$key);
    }

    /**
     * Remove all items from the cache.
     *
     * @return void
     */
    public function clear()
    {
        $this->memcached->flush();
    }

    public function has($key) {
        var_dump($this->memcached->getAllKeys());
        return self::get($key) ? true : false;
    }
}