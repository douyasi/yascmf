<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\PageRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\ContentRepository;

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
        $pages = $this->content->index($data, 'page');
        $links = page_links($pages, $data);
        return view('back.page.index', compact('pages', 'links'));
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
        if ($request->is_ajax()) {
            $validator = $request->validate('store');
            $data = $request->data('store');
            $json = $request->response();
            $json = array_replace($json, ['operation' => '添加单页']);
            if ($validator->passes()) {
                $content = $this->content->store($data, 'page', user('id'));
                if ($content->id) {
                    $json = array_replace($json, ['status' => 1, 'info' => '成功']);
                } else {
                    $info = '失败原因为：<span class="text_error">数据库操作返回异常</span>';
                    $json = array_replace($json, ['info' => $info]);
                }
            } else {
                $json = format_json_message($validator->messages(), $json);
            }
            return response()->json($json);
        } else {
            return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
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
        is_null($page) and abort(404);
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
        if ($request->is_ajax() && $request->is_method('put')) {
            $validator = $request->validate('update');
            $data = $request->data('update');
            $json = $request->response();
            $json = array_replace($json, ['operation' => '修改单页']);

            if ($validator->passes()) {
                $this->content->update($id, $data, 'page');
                $json = array_replace($json, ['status' => 1, 'info' => '成功']);
            } else {
                $json = format_json_message($validator->messages(), $json);
            }
            return response()->json($json);
        } else {
            return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(PageRequest $request, $id)
    {
        if ($request->is_ajax() && $request->is_method('delete')) {
            $this->content->destroy($id, 'page');
            $json = [
                'status' => 1,
                'info' => '成功',
                'operation' => '删除单页',
                'url' => route('admin.page.index'),
            ];
            return response()->json($json);
        } else {
            return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
        }
    }
}
