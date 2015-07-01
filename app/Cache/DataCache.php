<?php

namespace Douyasi\Cache;

use Cache;
use DB;
use Config;

/**
 * Class DataCache
 *
 * 数据缓存
 * 用于缓存比较通用的内容Content/元Meta数据
 * 注意：这里存取数据未使用仓库，而是直接DB操作
 *
 * @package Douyasi\Cache
 * @author raoyc <raoyc2009@gmail.com>
 */
class DataCache
{

    /**
     * 缓存内容 (暂未完成 TODO)
     *
     * @return boolean true
     */
    public static function cacheContent($category)
    {
        return true;
    }


    /**
     * 缓存分类
     *
     * @return boolean true
     */
    public static function cacheCategories()
    {
        $categories = array();
        //这里变量$cats含义不是猫(复数),而是分类复数的缩写（categories）
        $cats = DB::table('metas')
            ->select('id', 'name', 'slug')
            ->where('type', '=', 'CATEGORY')
            ->get();
        if (!empty($cats)) {
            foreach ($cats as $key=>$cat) {
                $count = DB::table('contents')
                                ->where('category_id', '=', $cat->id)
                                ->where('type', '=', 'article')
                                ->count();
                $categories[$key]['category'] = $cat;
                $categories[$key]['count'] = $count;
            }
        }
        if (Config::get('cache.driver') === 'memcached') {
            //建议上memcached缓存，可以使用缓存标签特性

            Cache::tag('categories')->remember('categories', 120, function () use ($categories) {
                return $categories;
            });
        } else {
            Cache::remember('categories', 120, function () use ($categories) {
                return $categories;
            });
        }
        return true;
    }

    /**
     * 缓存标签 (暂未完成 TODO)
     *
     * @return boolean true
     */
    public static function cacheTags()
    {
        return true;
    }

    /**
     * 缓存推荐位
     *
     * @return boolean true
     */
    public static function cacheFlags()
    {
        $cache_flags = array();
        $flags = DB::table('flags')
            ->select('id', 'attr', 'attr_full_name', 'display_name')
            ->take(5)
            ->get();
        if(!empty($flags)) {
            foreach($flags as $flag) {
                $cache_flags[$flag->attr] = $flag->display_name.'('.$flag->attr_full_name.')';
            }
        }
        if (Config::get('cache.driver') === 'memcached') {
            //建议上memcached缓存，可以使用缓存标签特性

            Cache::tag('flags')->remember('flags', 120, function () use ($cache_flags) {
                return $cache_flags;
            });
        } else {
            Cache::remember('flags', 120, function () use ($cache_flags) {
                return $cache_flags;
            });
        }
        return true;
    }

    /**
     * 缓存存档，数据量大时可加快访问速度
     *
     * @return boolean true
     */
    public static function cacheArchive()
    {
        $archives = array();
        $yms = DB::table('contents')
            ->select(DB::raw('DATE_FORMAT (created_at, "%Y-%m") AS post_year_month'))
            ->where('type', '=', 'article')
            ->distinct()
            ->orderBy('post_year_month', 'desc')
            ->get();
        if (!empty($yms)) {
            foreach ($yms as $key=>$ym) {
                $articles = DB::table('contents')
                                ->join('metas', function ($join) {
                                        $join->on('metas.id', '=', 'category_id')
                                             ->where('metas.type', '=', 'CATEGORY');
                                    })
                                ->select('metas.id as c_id', 'metas.slug as c_slug', 'contents.title', 'contents.id', 'contents.slug', 'contents.category_id')
                                ->where('contents.created_at', 'LIKE', ''.$ym->post_year_month.'%')
                                ->where('contents.type', '=', 'article')
                                ->get();
                if (!empty($articles)) {
                    $archives[$key]['year_month'] = $ym->post_year_month;
                    $archives[$key]['articles'] = $articles;
                    $archives[$key]['count'] = count($articles);
                } else {
                    $archives[$key]['year_month'] = $ym->post_year_month;
                    $archives[$key]['articles'] = array();
                    $archives[$key]['count'] = 0;
                }
            }
        }
        if (Config::get('cache.driver') === 'memcached') {
            //建议上memcached缓存，可以使用缓存标签特性

            Cache::tag('archives')->remember('archives', 120, function () use ($archives) {
                return $archives;
            });
        } else {
            Cache::remember('archives', 120, function () use ($archives) {
                return $archives;
            });
        }
        return true;
    }

    /**
     * 重建数据缓存
     *
     * @return boolean true
     */
    public static function rebuildDataCache()
    {
        Cache::forget('categories');  //清理掉分类缓存
        Cache::forget('archives');  //清理掉存档缓存
        Cache::forget('flags');  //清理掉推荐位缓存
        static::cacheCategories();
        static::cacheArchive();
        static::cacheFlags();
        return true;
    }
}
