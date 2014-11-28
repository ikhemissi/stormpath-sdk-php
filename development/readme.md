# Stormpath Cache #

## Initialization ##
The cache manager will be passed to the client builders method setCacheManager().  CacheManager itself is in charge of 
extracting which Cache driver you would like to use as the main cache driver for your application.  
This is all done via the `$options` array that is passed in as the first variable of CacheManager.  

Everything listed below is the default for the options.
 
<pre>
<code>
         $options = array(
            'ttl' => '7200', //Time To Live in seconds (7200 == 2 hours)
            'tti' => '7200', //Time To Idle in seconds (7200 == 2 hours)
            //The following is only required if `redis` is the driver of choice
            'store_opts' => array(
                'host' => 'redis.local',
                'port' => 6739
            )
         )
</code>
</pre>

After you have your options you would like to override, You then need to create a new instance of CacheManager to pass 
into the ClientBuilder's method setCacheManager

<pre>
<code>
$cacheManager = new \Stormpath\Cache\Memory($options);

$builder = new \Stormpath\ClientBuilder();
$client = $builder->setCacheManager(CacheManager $cacheManager)->
                    build();
</code>
</pre>

## Overriding defaults and different settings for regions  ##

At times, you may need to use a different cache manager for a region.  You can do this by passing another set of options
into the cache manager options array.  An example of this, I will use redis for my accounts with a shorter TTI.  This 
will also show you different options which will override the driver and ttl for all regions.

<pre>
<code>
         $options = array(
            'ttl' => 3600,
            'regions' => array(
                'accounts' => array(
                    'tti' => '300'
                )
            )
         )
         
         $cacheManager = new \Stormpath\Cache\Memcached($options);
         
         $builder = new \Stormpath\ClientBuilder();
         $client = $builder->setCacheManager(CacheManager $cacheManager)->
                             build();
</code>
</pre>



## Clear Cache ##
At times you may need to clear your cache and force a refresh.  You can do this very easily with the following
<pre>
<code>
\Stormpath\Client::cacheClear();
</code>
</pre>


## Create Your Own Cache Manager ##
Creating your own cache manager is a simple process.  We have set up a cache manager interface as well as a cache interface.  
Your cache manager needs to implement both of these interfaces.  
 

<pre>
<code>
class \My\Awesome\Cache implements \Stormpath\CacheManager, \Stormpath\Cache { ... }
</code>
</pre>

Adhere to the contracts for both interfaces and you are ready to call your own CacheManager the same way as before

<pre>
<code>
    $cacheManager = new \My\Awesome\Cache($options);
         
     $builder = new \Stormpath\ClientBuilder();
     $client = $builder->setCacheManager(CacheManager $cacheManager)->
                         build();
</code>
</pre>









