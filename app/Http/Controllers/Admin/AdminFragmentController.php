<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\FragmentRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\ContentRepository;
use Cache;

/**
 * 内容碎片资源控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminFragmentController extends BackController
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
        //
        $data = [
            's_title' => $request->input('s_title'),
            's_slug'  => $request->input('s_slug'),
        ];
        $fragments = $this->content->index($data, 'fragment', Cache::get('page_size', '10'));
        return view('back.fragment.index', compact('fragments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('back.fragment.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(FragmentRequest $request)
    {
        //
        $data = $request->all();

        $content = $this->content->store($data, 'fragment', user('id'));
        if ($content->id) {  //添加成功
            return redirect()->route('admin.fragment.index')->with('message', '成功新增碎片！');
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
        $fragment = $this->content->edit($id, 'fragment');
        return view('back.fragment.edit', ['data' => $fragment]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(FragmentRequest $request, $id)
    {
        //
        $data = $request->all();
        $this->content->update($id, $data, 'fragment');
        return redirect()->route('admin.fragment.index')->with('message', '修改碎片成功！');
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
        $this->content->destroy($id, 'fragment');
        return redirect()->route('admin.fragment.index')->with('message', '删除碎片成功！');
    }
}
