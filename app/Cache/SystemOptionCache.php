<?php

namespace Douyasi\Cache;

use Douyasi\Models\SystemOption;
use Cache;
use Config;

/**
 * Class SystemOptionCache
 *
 * 系统静态（配置项）缓存
 * 操作模型：SystemOption
 * 操作数据表：system_options
 *
 * @package Douyasi\Cache
 * @author raoyc <raoyc2009@gmail.com>
 */

class SystemOptionCache
{
    
    /**
     * 缓存系统静态配置
     * 操作SystemOption模型
     *
     * @return void
     */
    public static function cacheStatic()
    {
        $system_options = SystemOption::all();
        foreach ($system_options as $so) {
            if (Config::get('cache.driver') === 'memcached') {
                //建议上memcached缓存

                Cache::tags('system', 'static')->forever($so['name'], $so['value']);  //系统静态配置很少会发生改变，因此建议永久储存该缓存
            } else {
                Cache::forever($so['name'], $so['value']);  //file与database驱动的缓存不支持缓存标签
            }
        }
    }
    
    /**
     * 清理系统静态配置缓存
     * 操作SystemOption模型
     * 注意这里清理使用到了缓存标签，而：
     * 文件 或 数据库 这类缓存系统均不支持缓存标签. 此外, 使用带有 "forever" 的缓存标签时, 挑选 memcached 这类缓存系统将获得最好的性能, 它会自动清除过期的纪录。
     * 当缓存驱动为file时，实际上是无法清理掉全部系统静态配置缓存的（因为其键名key过多，通过查询数据库获取键名key清理缓存，实际上没有必要），建议直接调用cacheStatic()重建静态缓存
     *
     * @return void
     */
    public static function uncacheStatic()
    {
        if (Config::get('cache.driver') === 'memcached') {
            Cache::tags('system', 'static')->flush();
        }
    }
}
