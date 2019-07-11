<?php
namespace Yiisoft\Cache;

/**
 * WinCache provides Windows Cache caching in terms of an application component.
 *
 * To use this application component, the [WinCache PHP extension](https://sourceforge.net/projects/wincache/)
 * must be loaded. Also note that "wincache.ucenabled" should be set to "1" in your php.ini file.
 *
 * Application configuration example:
 *
 * ```php
 * return [
 *     'components' => [
 *         'cache' => [
 *             '__class' => Yiisoft\Cache\Cache::class,
 *             'handler' => [
 *                 '__class' => Yiisoft\Cache\WinCache::class,
 *             ],
 *         ],
 *         // ...
 *     ],
 *     // ...
 * ];
 * ```
 *
 * See [[\Psr\SimpleCache\CacheInterface]] for common cache operations that are supported by WinCache.
 *
 * For more details and usage information on Cache, see the [guide article on caching](guide:caching-overview).
 */
class WinCache extends SimpleCache
{
    public function hasValue($key): bool
    {
        return \wincache_ucache_exists($key);
    }

    protected function getValue($key)
    {
        return \wincache_ucache_get($key);
    }

    protected function getValues($keys): array
    {
        return \wincache_ucache_get($keys);
    }

    protected function setValue($key, $value, $ttl): bool
    {
        return \wincache_ucache_set($key, $value, $ttl);
    }

    protected function setValues($values, $ttl): bool
    {
        return \wincache_ucache_set($values, null, $ttl) === [];
    }

    protected function deleteValue($key): bool
    {
        return \wincache_ucache_delete($key);
    }

    public function clear(): bool
    {
        return \wincache_ucache_clear();
    }
}
