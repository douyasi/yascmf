<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\ArticleRequest;  //请求层
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\ContentRepository;  //模型仓库层
use Douyasi\Repositories\FlagRepository;  //推荐位仓库层
use Douyasi\Cache\DataCache;
use Cache;

/**
 * 内容文章资源控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminArticleController extends BackController
{


    /**
     * The ContentRepository instance.
     *
     * @var Douyasi\Repositories\ContentRepository
     */
    protected $content;

    /**
     * The FlagRepository instance.
     *
     * @var Douyasi\Repositories\FlagRepository
     */
    protected $flag;

    /**
     * 推荐位缓存数据
     *
     * @var array
     */
    protected $flags;

    public function __construct(
        ContentRepository $content,
        FlagRepository $flag)
    {
        parent::__construct();
        $this->content = $content;
        $this->flag = $flag;
        if (! user('object')->can('manage_contents')) {
            $this->middleware('deny403');
        }
        if (!Cache::has('flags')) {  //如果推荐位缓存不存在
            DataCache::cacheFlags();
        }
        $this->flags = Cache::get('flags');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = [
            's_title' => $request->input('s_title'),
            's_cat_id' => $request->input('s_cat_id', 0),
        ];

        //使用仓库方法获取文章列表
        $articles = $this->content->index($data, 'article', Cache::get('page_size', '10'));

        //注意：因为已经使用 Bootstrap 后台模版，故无须再传入自定义的分页样式
        //传入自定义的分页Presenter
        //$links = page_links($articles, $data);
        $flags = $this->flags;
        return view('back.article.index', compact('articles', 'flags'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //需传递分类信息进去
        $categories = $this->content->meta();
        $flags = $this->flag->index();
        return view('back.article.create', compact('categories', 'flags'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->all();  //获取请求过来的数据

        $content = $this->content->store($data, 'article', user('id'));  //使用仓库方法存储
        if ($content->id) {  //添加成功
            return redirect()->route('admin.article.index')->with('message', '成功发布新文章！');
        } else {  //添加失败
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $categories = $this->content->meta();
        $article = $this->content->edit($id, 'article');
        //已经findOrFail处理，如果不存在该id资源会抛出异常，再加is_null判定无意义
        //is_null($article) and abort(404); 
        $flags = $this->flag->index();
        return view('back.article.edit', ['data' => $article, 'categories' => $categories, 'flags' => $flags]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Douyasi\Http\Requests\ArticleRequest $request
     * @param  int  $id
     * @return Response
     */
    public function update(ArticleRequest $request, $id)
    {
        //
        $data = $request->all();
        $this->content->update($id, $data, 'article');
        return redirect()->route('admin.article.index')->with('message', '修改文章成功！');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $this->content->destroy($id, 'article');
        return redirect()->route('admin.article.index')->with('message', '删除文章成功！');
    }
}
