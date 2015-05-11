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
    public function index(Request $request)
    {
        $data = [
            's_name' => $request->input('s_name'),
        ];
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
        //需传递分类信息进去
        //$categories = $this->content->meta();
        //echo "aa";exit;
        return view('back.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TagRequest $request)
    {
        $data    = $request->all();  //获取请求过来的数据
        $content = $this->article_tag->store($data);
        if ($content->id) {  //添加成功
            return redirect()->route('admin.tag.index')->with('message', '添加新标签成功！');
        } else {  //添加失败
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }
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
        $article_tag = $this->article_tag->edit($id);
        return view('back.tag.edit', ['data'=>$article_tag]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(TagRequest $request,$id)
    {
        $data = $request->all();
        $this->article_tag->update($id, $data);
        return redirect()->route('admin.tag.index')->with('message', '修改标签成功！');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->article_tag->destroy($id);
        return redirect()->route('admin.tag.index')->with('message', '删除标签成功！');
    }
}
