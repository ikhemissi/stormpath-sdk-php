<?php namespace Stormpath\Cache;

/*
 * Copyright 2015 Stormpath, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * A Cache efficiently stores temporary objects primarily to improve an application's performance.
 * <p/>
 * This interface provides an abstraction (wrapper) API on top of an underlying
 * cache framework's cache instance (e.g. Memcached, Redis, Array, etc),
 * allowing a Stormpath SDK user to configure any cache mechanism they choose.
 *
 * @since 0.8
 */
interface Cache {

    /**
     * Returns the cached value stored under the specified `key` or
     * `null` if there is no cache entry for that `key`.
     *
     * @param key the key that the value was previous added with
     * @return the cached object or `null` if there is no entry for the specified `key`
     */
    public function get($key);


    /**
     * Adds a cache entry.
     *
     * @param key   the key used to identify the object being stored.
     * @param value the value to be stored in the cache.
     * @return the previous value associated with the given `key` or `null if there was no previous value
     */
    public function put($key, $value);


    /**
     * Removes the cached value stored under the specified `key`.
     *
     * @param key the key used to identify the object being stored.
     * @return the removed value or `null` if there was no value cached.
     */
    public function remove($key);

}