<?php

namespace Douyasi\Http\Controllers;

use Douyasi\Http\Requests;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Cache\DataCache as DataCache;
use Douyasi\Models\Content as Content;
use Douyasi\Models\Meta as Meta;
use Cache;

/**
 * 博客控制器
 * 用于前台博客展示
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class BlogController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
        if (!Cache::has('categories')) {  //如果分类缓存不存在
            DataCache::cacheCategories();
        }
        $categories = Cache::get('categories');

        //使用视图组件，传入头部导航数据
        view()->composer('widgets.bootstrapCategory', function ($view) use ($categories) {
            $view->with('categories', $categories);
        });

        view()->composer('widgets.bootstrapHeader', function ($view) {
            $topPage = Content::page()->take(3)->get();  //最多取得3个单页，以免撑爆导航栏
            $view->with('topPage', $topPage);
        });
    }

    /**
     * 博客首页
     */
    public function getIndex()
    {
        $articles = Content::article()->orderBy('created_at', 'desc')->paginate(6);
        $title = '首页';
        $description = '芽丝内容管理框架，基于Laravel 5开发而成，它比较适合拿来做一些小众项目开发。目前框架实现了一个简单的内容管理系统（CMS），支持多种内容模型，文章、单页、分类、碎片与标签，您现在完全可以拿它来完成一个简单的博客网站，“芽丝博客”就是它所驱动的博客示例网站。Github地址： https://github.com/douyasi/yascmf 。';  //追加seo描述Meta信息
        return view('front.index', compact('articles', 'title', 'description'));
    }

    /**
     * 博客分类
     */
    public function getCategoryArticles($slug)
    {

        //首先尝试通过slug匹配
        $category = Meta::category()->where('slug', '=', $slug)->first();
        if ($category) {
            $title = '文章分类：'.$category->name;
            $description = Cache::get('website_title', '芽丝博客').'-'.$title.'，  '.$category->description.'  本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
            $articles = Content::article()
                            ->where('category_id', '=', $category->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(6);
            return view('front.category', compact('articles', 'category', 'title', 'description'));
        } else {

            //再次尝试移除'cat_'前缀之后来匹配id
            $new_slug = ltrim($slug, 'cat_');
            if (ctype_digit($new_slug)) {
                $category = Meta::category()->find($new_slug);
                is_null($category) && abort(404);
                $title = '文章分类：'.$category->name;
                $description = Cache::get('website_title', '芽丝博客').'-'.$title.'，  '.$category->description.'  本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
                $articles = Content::article()
                            ->where('category_id', '=', $new_slug)
                            ->orderBy('created_at', 'desc')
                            ->paginate(6);
                return view('front.category', compact('articles', 'category', 'title', 'description'));
            } else {
                abort(404);
            }
        }
    }

    /**
     * 博客单页
     */
    public function getPageShow($slug)
    {
        //首先尝试通过slug匹配
        $page = Content::page()->where('slug', '=', $slug)->first();
        if ($page) {
            $title = $page->title;
            $description = Cache::get('website_title', '芽丝博客').' - '.$title.'，本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
            $view = 'front.'.$slug.'.page';  //单页模版视图
            if (view()->exists($view)) {
                //如果存在对应单页视图，则使用

                return view($view, compact('page', 'title', 'description'));
            } else {  //否则使用默认视图(front.page)
                return view('front.page', compact('page', 'title', 'description'));
            }
        } else {

            //再次尝试移除'page_'前缀之后来匹配id
            $new_slug = ltrim($slug, 'page_');
            if (ctype_digit($new_slug)) {
                $page = Content::page()->find($new_slug);
                is_null($page) && abort(404);
                $title = $page->title;
                $description = Cache::get('website_title', '芽丝博客').' - '.$title.'，本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
                return view('front.page', compact('page', 'title', 'description'));
            } else {
                abort(404);
            }
        }
    }

    /**
     * 博客文章
     */
    public function getArticleShow($cslug, $slug)
    {

        //尝试根据分类slug来匹配
        $category = Meta::category()->where('slug', '=', $cslug)->first();
        if ($category) {
            $article = Content::article()
                            ->where('category_id', '=', $category->id)
                            ->where('slug', '=', $slug)
                            ->first();
            if ($article) {
                $title = $article->title;
                $description = Cache::get('website_title', '芽丝博客').' - '.$title.'，本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
                return view('front.show', compact('article', 'category', 'title', 'description'));
            } else {
                if (ctype_digit($slug)) {
                    $article = Content::article()->where('category_id', '=', $category->id)->find($slug);
                    is_null($article) && abort(404);
                    $title = $article->title;
                    $description = Cache::get('website_title', '芽丝博客').' - '.$title.'，本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
                    return view('front.show', compact('article', 'category', 'title', 'description'));
                } else {
                    abort(404);
                }
            }
        } else {
            //再次尝试移除'cat_'前缀之后来匹配
            $new_cslug = ltrim($cslug, 'cat_');
            if (ctype_digit($new_cslug)) {
                $category = Meta::category()->find($new_cslug);
                is_null($category) && abort(404);
                $article = Content::article()
                            ->where('category_id', '=', $new_cslug)
                            ->where('slug', '=', $slug)
                            ->first();
                if ($article) {
                    $title = $article->title;
                    $description = Cache::get('website_title', '芽丝博客').' - '.$title.'，本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
                    return view('front.show', compact('article', 'category', 'title', 'description'));
                } else {
                    if (ctype_digit($slug)) {
                        $article = Content::article()->where('category_id', '=', $category->id)->find($slug);
                        is_null($article) && abort(404);
                        $title = $article->title;
                        $description = Cache::get('website_title', '芽丝博客').' - '.$title.'，本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
                        return view('front.show', compact('article', 'category', 'title', 'description'));
                    } else {
                        abort(404);
                    }
                }
            } else {
                abort(404);
            }
        }
    }
    

    /**
     * 博客归档，使用cache机制，以加快速度
     */
    public function getArchive()
    {
        if (!Cache::has('archives')) {  //如果归档缓存不存在
            DataCache::cacheArchive();
        }
        $archives = Cache::get('archives');
        $title = '文章归档';
        $description = Cache::get('website_title', '芽丝博客').'-'.$title.'，本博客由 芽丝内容管理框架(YASCMF) 所驱动的博客，基于Laravel实现的内容管理框架，Github地址： https://github.com/douyasi/yascmf 。';
        return view('front.archive', compact('archives', 'title', 'description'));
    }
}
