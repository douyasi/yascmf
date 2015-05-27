<?php namespace Douyasi\Cache;

use Cache;
use DB;
use Config;
use PhpSpec\Exception\Exception;

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
        static::cacheCategories();
        static::cacheArchive();
        return true;
    }

    /**
     * 缓存后台SideBar
     * @return boolean true
     * key-value
     * SideBar+$user_id
     */

    public static function cacheSideBar()
    {
        $user_id = user('id');
        Cache::forget('SideBar'.$user_id);  //清理掉个人侧边栏目录

        $user  = user('object');//User对象
        //$roles = $user->can('manage_system');
        $templateSideBar = array(
            '控制面板'=>array(
                'icon'=>'fa fa-dashboard',
                'message_class'=>'fa fa-angle-left pull-right',
                'notice'=>'',
                array('menu_name'=>'概述','route'=>'admin.console.index','role'=>'manage_system','icon'=>'fa fa-circle-o'),
                array('menu_name'=>'个人资料','route'=>'admin.me.index','role'=>'manage_system','icon'=>'fa fa-circle-o'),
                array('menu_name'=>'重建缓存','route'=>'admin.cache','role'=>'manage_system','icon'=>'fa fa-circle-o')
            ),
            '内容管理'=>array(
                'icon'=>'fa fa-edit',
                'message_class'=>'label label-primary pull-right',
                'notice'=>'New',
                array('menu_name'=>'文章','route'=>'admin.article.index','role'=>'manage_system','icon'=>'fa fa-file-o'),
                array('menu_name'=>'单页','route'=>'admin.page.index','role'=>'manage_system','icon'=>'fa fa-file-o'),
                array('menu_name'=>'碎片','route'=>'admin.fragment.index','role'=>'manage_system','icon'=>'fa fa-file-o'),
                array('menu_name'=>'分类','route'=>'admin.category.index','role'=>'manage_system','icon'=>'fa fa-file-o')
            ),
            '友链'=>array('menu_name'=>'友链','route'=>'#','role'=>'manage_system','icon'=>'fa fa-link'),
            '写作'=>array('menu_name'=>'写作','route'=>'#','role'=>'manage_system','icon'=>'fa fa-book'),
            '标签'=>array('menu_name'=>'标签','route'=>'admin.tag.index','role'=>'manage_system','icon'=>'fa fa-tags'),
            '讨论'=>array(
                'icon'=>'fa fa-comments-o',
                'message_class'=>'label pull-right bg-green',
                'notice'=>'New',
                array('menu_name'=>'节点','route'=>'#','role'=>'manage_system','icon'=>'fa fa-square-o'),
                array('menu_name'=>'话题','route'=>'#','role'=>'manage_system','icon'=>'fa fa-square-o'),
                array('menu_name'=>'审核','route'=>'#','role'=>'manage_system','icon'=>'fa fa-square-o'),
                array('menu_name'=>'举报','route'=>'#','role'=>'manage_system','icon'=>'fa fa-square-o')
            ),
            '用户管理'=>array(
                'icon'=>'fa fa-user',
                'message_class'=>'label pull-right bg-red',
                'notice'=>'4',
                array('menu_name'=>'管理员','route'=>'admin.user.index','role'=>'manage_system','icon'=>'fa fa-circle-o'),
                array('menu_name'=>'注册用户','route'=>'#','role'=>'manage_system','icon'=>'fa fa-circle-o'),
                array('menu_name'=>'付费客户','route'=>'admin.fragment.index','role'=>'manage_system','icon'=>'fa fa-circle-o'),
                array('menu_name'=>'角色','route'=>'admin.role.index','role'=>'manage_system','icon'=>'fa fa-circle-o'),
                array('menu_name'=>'权限','route'=>'admin.permission.index','role'=>'manage_system','icon'=>'fa fa-circle-o')
            ),
            '业务管理'=>array(
                'icon'=>'fa fa-coffee',
                'message_class'=>'fa fa-angle-left pull-right',
                'notice'=>'',
                array('menu_name'=>'业务流程','route'=>'admin.flow','role'=>'manage_system','icon'=>'fa fa-sitemap'),
                array('menu_name'=>'信息','route'=>'#','role'=>'manage_system','icon'=>'fa fa-envelope-o'),
                array('menu_name'=>'通知','route'=>'#','role'=>'manage_system','icon'=>'fa fa-bell-o'),
                array('menu_name'=>'任务','route'=>'#','role'=>'manage_system','icon'=>'fa fa-flag-o')
            ),
            '系统管理'=>array(
                'icon'=>'fa fa-cog',
                'message_class'=>'fa fa-angle-left pull-right',
                'notice'=>'',
                array('menu_name'=>'系统配置','route'=>'admin.system_option.index','role'=>'manage_system','icon'=>'fa fa-square-o'),
                array('menu_name'=>'动态设置分组','route'=>'admin.setting_type.index','role'=>'manage_system','icon'=>'fa fa-square-o'),
                array('menu_name'=>'动态设置','route'=>'admin.setting.index','role'=>'manage_system','icon'=>'fa fa-square-o'),
                array('menu_name'=>'系统日志','route'=>'admin.system_log.index','role'=>'manage_system','icon'=>'fa fa-square-o'),
                array('menu_name'=>'邮件日志','route'=>'#','role'=>'manage_system','icon'=>'fa fa-square-o'),
                array('menu_name'=>'概述','route'=>'admin.console.index','role'=>'manage_system'),
                array('menu_name'=>'个人资料','route'=>'admin.me.index','role'=>'manage_system'),
                array('menu_name'=>'重建缓存','route'=>'admin.cache','role'=>'manage_system'),
            )
        );

        foreach($templateSideBar as $k=>$v){
            foreach($v as $key=>$value){
                if(!$user->can('manage_system')){
                    unset($templateSideBar[$k][$key]);
                }
            }
            if(empty($templateSideBar[$k])){
                unset($templateSideBar[$k]);
            }
        }
        Cache::forever('SideBar'.$user_id,$templateSideBar);
        return true;
    }
}
