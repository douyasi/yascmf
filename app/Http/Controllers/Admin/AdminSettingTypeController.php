<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\SettingTypeRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\SettingRepository;

class AdminSettingTypeController extends BackController
{
    
/**
     * The SettingRepository instance.
     *
     * @var Douyasi\Repositories\SettingRepository
     */
    protected $setting;

    public function __construct(
        SettingRepository $setting)
    {
        parent::__construct();
        $this->setting = $setting;
        
        if (! user('object')->can('manage_system')) {
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
            's_name' => $request->input('s_name'),
            's_value' => $request->input('s_value'),
        ];
        $types = $this->setting->index($data, '');  //注意，第二个参数不为'setting'，取的是SettingType模型
        $links = page_links($types, $data);
        return view('back.setting_type.index', compact('types', 'links'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('back.setting_type.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SettingTypeRequest $request)
    {
        if ($request->is_ajax()) {
            $validator = $request->validate('store');
            $data = $request->data('store');
            $json = $request->response();
            $json = array_replace($json, ['operation' => '添加动态设置分组']);

            if ($validator->passes()) {
                $setting_type = $this->setting->store($data, '');  //注意，第二个参数不为'setting'，取的是SettingType模型
                if ($setting_type->id) {
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
     * Display the specified resource.
     * 展示特定分组下的动态设置
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //需关联查询
        /*①查出是否有该分组id，不存在则抛出404*/
        $type = $this->setting->getById($id);
        is_null($type) and abort(404);
        /*②存在该分组id，则显示出该分组id下所有动态设置项*/
        $settings = $this->setting->show($id);
        $links = page_links($settings);
        $typename = $type->name;
        return view('back.setting.index', compact('settings', 'links', 'typename'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $type = $this->setting->getById($id);
        is_null($type) and abort(404);
        return view('back.setting_type.edit', ['data' => $type]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(SettingTypeRequest $request, $id)
    {
        if ($request->is_ajax() && $request->is_method('put')) {
            $validator = $request->validate('update');
            $data = $request->data('update');
            $json = $request->response();
            $json = array_replace($json, ['operation' => '修改动态设置分组']);

            if ($validator->passes()) {
                $setting_type = $this->setting->update($id, $data, '');  //注意，第三个参数不为'setting'，取的是SettingType模型
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
    public function destroy(SettingTypeRequest $request, $id)
    {
        if ($request->is_ajax() && $request->is_method('delete')) {
            $json = $request->response();
            $json = array_replace($json, ['operation' => '删除动态设置分组']);
            if ($id == 1) {
                $json = array_replace($json, ['info' => '失败原因为：<span class="text_error">ID为1的默认动态设置分组不能被删除！</span>']);
            } else {
                if ($this->setting->hasSetting($id)) {
                    $json = array_replace($json, ['info' => '失败原因为：<span class="text_error">该分组下还存在动态设置，不能被删除！</span>']);
                } else {
                    $this->setting->destroy($id, '');  //注意，第二个参数不为'setting'，取的是SettingType模型
                    $json = array_replace($json, ['status'=>1, 'info' => '成功']);
                }
            }
            return response()->json($json);
        } else {
            return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
        }
    }
}
