<?php

namespace Douyasi\Extensions;

use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;
use Illuminate\Contracts\Pagination\Presenter as PresenterContract;

/**
 * DouyasiPresenter
 * 扩展分页样式（Laravel 5 中已经移除了分页模版）
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class DouyasiPresenter implements PresenterContract
{

    /**
     * The paginator implementation.
     *
     * @var \Illuminate\Contracts\Pagination\Paginator
     */
    protected $paginator;

    /**
     * Create a DouyasiPresenter.
     *
     * @param  \Illuminate\Contracts\Pagination\Paginator  $paginator
     * @return void
     */
    public function __construct(PaginatorContract $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * 是否需要分页
     *
     * @return bool
     */
    public function hasPages()
    {
        return $this->paginator->hasPages() && count($this->paginator->items()) > 0;
    }

    /*
    <div class="yas_page">
        <span class="current">1</span>
        <a href="http://yascmf.dev/admin/article?page=2">2</a>
        <a href="http://yascmf.dev/admin/article?page=3">3</a>
        <a href="http://yascmf.dev/admin/article?page=4">4</a>
    </div>
    */
    /**
     * 渲染出分页
     *
     * @return string
     */
    public function render()
    {
        if ($this->hasPages()) {
            return $this->getLinks();
        }

        return '';
    }


    /**
     * 当前激活页
     *
     * @param  string  $text
     * @return string
     */
    public function getActivePageWrapper($text)
    {
        return '<span class="current">'.$text.'</span>';
    }

    /**
     * 灰色不可点击页（如 省略页）
     *
     * @param  string  $text
     * @return string
     */
    public function getDisabledTextWrapper($text)
    {
        return '<span class="ellipsis">'.$text.'</span>';
    }


    /**
     * 其它可点击页
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

        return '<a href="'.$url.'"'.$rel.'>'.$page.'</a>';
    }


    /**
     * 省略页
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper("...");
    }

    /**
     * 获取当前页
     *
     * @return int
     */
    protected function currentPage()
    {
        return $this->paginator->currentPage();
    }

    /**
     * 获取最后页
     *
     * @return int
     */
    protected function lastPage()
    {
        return $this->paginator->lastPage();
    }

    /**
     * 生成特定页面URL
     *
     * @return string
     */
    protected function getUrl($page)
    {
        return $this->paginator->url($page);
    }

    /**
     * 生成分页链接[这里的分页算法逻辑可能令人迷惑，请自行琢磨]
     *
     * @return $string
     */
    protected function getLinks()
    {
        $html = '<div class="yas_page">';

        $cp = $this->currentPage();  //当前页
        $lp = $tp = $this->lastPage();  //最后页（总页数）

        if ($tp <=6) {
            //总页数小于等于6，全部展示

            for ($i = 1;$i <= $tp; $i++) {
                if ($cp == $i) {
                    $html .= $this->getActivePageWrapper($cp);
                } else {
                    $html .= $this->getAvailablePageWrapper($this->getUrl($i), $i, null);
                }
            }
        } else {
            if ($cp <= 4) {
                //优先满足前区5页

                /*
                <[1] 2 {3} 4 5> ... 7 | <[1] 2 {3} 4 5> ... 8 | <[1] 2 {3} 4 5> ... 9
                <1 [2] {3} 4 5> ... 7 | <1 [2] {3} 4 5> ... 8 | <1 [2] {3} 4 5> ...9
                <1 2 {[3]} 4 5> ... 7 | <1 2 {[3]} 4 5> ... 8 | <1 2 {[3]} 4 5> ... 9
                <1 2 {3} [4] 5> ... 7 | <1 2 {3} [4] 5> ... 8 | <1 2 {3} [4] 5> ... 9
                */
                for ($i = 1; $i <= 5; $i++) {
                    if ($cp == $i) {
                        $html .=  $this->getActivePageWrapper($cp);
                    } else {
                        $html .= $this->getAvailablePageWrapper($this->getUrl($i), $i, null);
                    }
                }
                $html .= $this->getDots().''.$this->getAvailablePageWrapper($this->getUrl($lp), $lp, null);
            } else {
                //优先满足后区5页

                /*
                1 ... <3 4 {[5]} 6 7> | 1 ... <4 [5] {6} 7 8> | 1 ... <[5] 6 {7} 8 9> | 1 ... <3 4 {[5]} 6 7> ... 10 | 1 ... <3 4 {[5]} 6 7> ... 11
                1 ... <3 4 {5} [6] 7> | 1 ... <4 5 {[6]} 7 8> | 1 ... <5 [6] {7} 8 9> | 1 ... <[6] 7 {8} 9 10> | 1 ... <4 5 {[6]} 7 8> ... 11
                1 ... <3 4 {5} 6 [7]> | 1 ... <4 5 {6} [7] 8> | 1 ... <5 6 {[7]} 8 9> | 1 ... <6 [7] {8} 9 10> | 1 ... <5 6 {[7]} 8 9> ... 11
                */
                if ($tp <= ($cp+4)) {
                    $html .= $this->getAvailablePageWrapper($this->getUrl(1), 1, null).''.$this->getDots();
                    for ($i=$tp-4;$i<=$tp;$i++) {
                        if ($cp == $i) {
                            $html .= $this->getActivePageWrapper($cp);
                        } else {
                            $html .= $this->getAvailablePageWrapper($this->getUrl($i), $i, null);
                        }
                    }
                } else {
                    $html .= $this->getAvailablePageWrapper($this->getUrl(1), 1, null).''.$this->getDots();
                    for ($i=($cp-2);$i<=($cp+2);$i++) {
                        if ($cp == $i) {
                            $html .= $this->getActivePageWrapper($cp);
                        } else {
                            $html .= $this->getAvailablePageWrapper($this->getUrl($i), $i, null);
                        }
                    }
                    $html .= $this->getDots().''.$this->getAvailablePageWrapper($this->getUrl($lp), $lp, null);
                }
            }
        }

        $html .= '</div>';
        return $html;
    }
}
