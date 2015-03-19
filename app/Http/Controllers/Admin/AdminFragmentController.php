<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\FragmentRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\ContentRepository;

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
            's_slug' => $request->input('s_slug'),
        ];
        $fragments = $this->content->index($data, 'fragment');
        $links = page_links($fragments, $data);
        return view('back.fragment.index', compact('fragments', 'links'));
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
        if ($request->is_ajax()) {
            $validator = $request->validate('store');
            $data = $request->data('store');
            $json = $request->response();
            $json = array_replace($json, ['operation' => '添加碎片']);
            if ($validator->passes()) {
                $content = $this->content->store($data, 'fragment', user('id'));
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
        $fragment = $this->content->edit($id, 'fragment');
        is_null($fragment) and abort(404);
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
        if ($request->is_ajax() && $request->is_method('put')) {
            $validator = $request->validate('update');
            $data = $request->data('update');
            $json = $request->response();
            $json = array_replace($json, ['operation' => '修改碎片']);

            if ($validator->passes()) {
                $this->content->update($id, $data, 'fragment');
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
    public function destroy(FragmentRequest $request, $id)
    {
        //
        if ($request->is_ajax() && $request->is_method('delete')) {
            $this->content->destroy($id, 'fragment');
            $json = [
                'status' => 1,
                'info' => '成功',
                'operation' => '删除删除',
                'url' => route('admin.fragment.index'),
            ];
            return response()->json($json);
        } else {
            return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
        }
    }
}
