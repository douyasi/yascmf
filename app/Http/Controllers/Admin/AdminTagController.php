<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\TagRequest;
use Douyasi\Http\Controllers\Controller;
use Douyasi\Repositories\ArticleTagRepository;  //模型仓库层
use Illuminate\Http\Request;
use Cache;
/**
 * 标签资源控制器
 */
class AdminTagController extends BackController
{

    protected $article_tag;

    public function __construct(ArticleTagRepository $article_tag)
    {
        parent::__construct();
        if (! user('object')->can('manage_contents')) {
            $this->middleware('deny403');
        }
        $this->article_tag = $article_tag;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $article_tag = $this->article_tag->index('article_tag','', Cache::get('page_size', '10'));
        //var_dump($article_tag);exit;
        return view('back.tag.index', compact('article_tag'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }
}
