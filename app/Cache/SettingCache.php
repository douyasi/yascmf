<?php

namespace Douyasi\Cache;

use Douyasi\Models\Setting as Setting;
use Douyasi\Models\SettingType as SettingType;
use Cache;
use Config;

/**
 * Class SettingCache
 *
 * 系统动态设置缓存
 * 操作模型：Setting, SettingType
 * 操作数据表：settings, setting_type
 *
 * @package Douyasi\Cache
 * @author raoyc <raoyc2009@gmail.com>
 */
class SettingCache
{
    
/**
     * 缓存特定动态设置分组下的设置数据
     *
     * @param string $type_name 动态设置分组名
     * @param string $format 'object'|'array' 缓存数据的格式，默认'object'为 Eloquent 查询之后的 Illuminate\Support\Collection 对象，可选'array'为缓存键值对化处理之后的数组
     * @return boolean true|false 缓存成功，则返回true, 否则返回false
     */
    public static function cacheSetting($type_name, $format ='object')
    {
        $setting_type = SettingType::where('name', '=', e($type_name))->first();
        if (is_null($setting_type)) {
            return false;  //缓存失败，不存在该分组名
        } else {
            $type_id = $setting_type->id;
            $settings = Setting::where('type_id', '=', e($type_id))->where('status', '=', '1')->get();  //获取该$type_name下动态设置settings
            if ($format === 'array') {
                $set = array();
                if (!$settings->isEmpty()) {  //Eloquent ORM 查询结果集非空
                    foreach ($settings as $setting) {
                        $set[$setting->name] = $setting->value;  //数组键值对缓存
                    }
                }
            } else {
                $set = $settings;
            }

            if (Config::get('cache.driver') === 'memcached') {
                //建议上memcached缓存，可以使用缓存标签特性

                Cache::tag('setting', $type_name)->remember($type_name, 60, function () use ($type_id, $set) {
                    return $set;
                });
            } else {
                Cache::remember($type_name, 60, function () use ($type_id, $set) {
                    return $set;
                });
            }
            //虽说属于动态设置，但一般被改动的几率较小，故这里建议缓存1小时（即60分钟）
            return true;  //缓存成功
        }
    }

    /**
     * 清理动态设置数据缓存
     * 注意这里清理使用到了缓存标签，而：
     * 文件 或 数据库 这类缓存系统均不支持缓存标签. 此外, 使用带有 "forever" 的缓存标签时, 挑选 memcached 这类缓存系统将获得最好的性能, 它会自动清除过期的纪录。
     *
     * @param string $type_name 动态设置分组名
     * @return void
     */
    public static function uncacheSetting($type_name = '')
    {
        if ($type_name === '') {
            if (Config::get('cache.driver') === 'memcached') {
                Cache::tags('setting')->flush();  //清理所有动态设置（缓存标签为setting）缓存
            } else {
                $setting_types = SettingType::lists('name');  //这里返回是数组
                foreach ($setting_types as $st)
                {
                    static::uncacheSetting($st);
                }
            }
        } else {
            if (Config::get('cache.driver') === 'memcached') {
                Cache::tags($type_name)->flush();
            }
            Cache::forget($type_name);  //为保险起见，这里通过key来清理掉分组名为$type_name的缓存，因为它支持file驱动的缓存
        }
    }
}
