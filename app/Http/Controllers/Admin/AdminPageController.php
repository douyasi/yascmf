<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\PageRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\ContentRepository;
use Cache;

/**
 * 内容单页资源控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminPageController extends BackController
{


    /**
     * The ContentRepository instance.
     *
     * @var Douyasi\Repositories\ContentRepository
     */
    protected $content;


    public function __construct(
        ContentRepository $content)
    {
        parent::__construct();
        $this->content = $content;
        
        if (! user('object')->can('manage_contents')) {
            $this->middleware('deny403');
        }
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
        ];
        $pages = $this->content->index($data, 'page', Cache::get('page_size', '10'));
        return view('back.page.index', compact('pages'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('back.page.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PageRequest $request)
    {
        $data = $request->all();

        $content = $this->content->store($data, 'page', user('id'));
        if ($content->id) {  //添加成功
            return redirect()->route('admin.page.index')->with('message', '成功发布新单页！');
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
        $page = $this->content->edit($id, 'page');
        return view('back.page.edit', ['data' => $page]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(PageRequest $request, $id)
    {
        //
        $data = $request->all();
        $this->content->update($id, $data, 'page');
        return redirect()->route('admin.page.index')->with('message', '修改单页成功！');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->content->destroy($id, 'page');
        return redirect()->route('admin.page.index')->with('message', '删除单页成功！');
    }
}
