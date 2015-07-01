<?php

namespace Douyasi\Services;


use Douyasi\Models\Content;

/**
 * ArticleService
 * 用于 Blade 模版服务注入
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class ArticleService {

    /**
     * 获取特定id文章
     *
     * @param  string $id 内容id
     * @param  string|null $slug 内容slug
     * @param  string $lang 内容语言版本
     * @return Illuminate\Support\Collection
     */
    public function getArticle($id = '0', $slug = null, $lang = 'chs')
    {
        $map = [];

        if(ctype_digit($id)) {
            if($id !== '0') {
                $map['id'] = $id;
            }
        }

        if($slug !== null) {
            $map['slug'] = $slug;
        }

        if(!empty($lang) && is_string($lang)) {
            $map['lang'] = $lang;
        } else {
            $map['lang'] = 'chs';
        }

        $article = Content::where(function ($query) use ($map) {
                                if(array_key_exists('slug', $map)) {
                                    $query->where('slug', '=', $map['slug']);
                                }
                                if(array_key_exists('id', $map)) {
                                    $query->where('id', '=', $map['id']);
                                }
                            })
                            ->first();
        return $article;
    }

    /**
     * 获取特定cat_id分类下文章
     *
     * @param  string $cat_id 分类id
     * @param  string|null $flag 推荐位
     * @param  string $lang 内容语言版本
     * @param  int $number 数量
     * @return Illuminate\Support\Collection
     */
    public function getArticleList($cat_id = '0', $flag = null, $number = 5)
    {
        $map = [];

        if(ctype_digit($cat_id)) {
            $map['cat_id'] = $cat_id;
        } else {
            $map['cat_id'] = '0';
        }

        if(($flag !== null) && is_string($flag))
        {
            $map['flag'] = $flag;
        }

        if(is_numeric($number)) {
            if($number > 10) {
                $map['number'] = 5;
            }
            else {
                $map['number'] = $number;
            }
        } else {
            $map['number'] = 5;
        }

        $articles = Content::article()
                             ->where('category_id', '=', $map['cat_id'])
                             ->where(function ($query) use ($map) {
                                if(array_key_exists('flag', $map)) {
                                    $query->where('flag', 'like', '%'.$map['flag'].'%');
                                }
                             })
                             ->orderBy('created_at', 'desc')
                             ->take($number)
                             ->get();
        return $articles;
    }


    /**
     * 芽丝slug URL生成
     * 优先使用string型的$slug作为slug url，否则使用int型的$id
     *
     * @param string $slug
     * @param int $id
     * @return string|int
     */
    public function getSlug($slug, $id)
    {
        $slug = e(trim($slug));
        if (empty($slug)) {
            return $id;
        } else {
            if (ctype_digit($slug)) {
                return $id;
            } else {
                return $slug;
            }
        }
    }

    /**
     * 芽丝分类URL生成
     *
     * @param string $slug 分类slug
     * @param int $id 分类id
     * @return string 返回slug化的字符串
     */
    public function getCategorySlug($slug, $id)
    {
        $slug = e(trim($slug));
        if (empty($slug)) {
            return '/cat_'.$id;
        } else {
            if (ctype_digit($slug)) {
                return '/cat_'.$id;
            } else {
                return '/'.$slug;
            }
        }
    }

    /**
     * 芽丝单页URL生成
     *
     * @param string $slug 单页slug
     * @param int $id 单页id
     * @return string 返回slug化的字符串
     */
    public function getPageSlug($slug, $id)
    {
        $slug = e(trim($slug));
        if (empty($slug)) {
            return '/page_'.$id.'.html';
        } else {
            if (ctype_digit($slug)) {
                return '/page_'.$id.'.html';
            } else {
                return '/'.$slug.'.html';
            }
        }
    }


    /**
     * 芽丝文章slug URL生成
     *
     * @param string $slug 文章slug
     * @param int $id 文章id
     * @param string $cslug 分类slug
     * @param int $id 分类id
     * @return string 返回slug化的字符串
     */
    public function getArticleSlug($slug, $id, $cslug, $cid)
    {
        $slug = $this->getSlug($slug, $id);
        $cslug = $this->getCategorySlug($cslug, $cid);
        return '/'.ltrim($cslug, '/').'/'.$slug.'.html';
    }
}
