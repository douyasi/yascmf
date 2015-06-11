<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\SettingTypeRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\SettingRepository;
use Cache;

/**
 * 系统动态设置分组控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
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
        $types = $this->setting->index($data, '', Cache::get('page_size', '10'));  //注意，第二个参数不为'setting'，取的是SettingType模型
        return view('back.setting_type.index', compact('types'));
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
        $data = $request->all();
        $setting_type = $this->setting->store($data, '');  //注意，第二个参数不为'setting'，取的是SettingType模型
        if ($setting_type->id) {
            return redirect()->route('admin.setting_type.index')->with('message', '成功新增动态设置分组！');
        } else {
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
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
        /*①查出是否有该分组id，不存在则抛出异常*/
        $type = $this->setting->getById($id);
        /*②存在该分组id，则显示出该分组id下所有动态设置项*/
        $settings = $this->setting->show($id);
        $typename = $type->name;
        return view('back.setting.index', compact('settings', 'typename'));
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
        $data = $request->all();
        $setting_type = $this->setting->update($id, $data, '');  //注意，第三个参数不为'setting'，取的是SettingType模型
        return redirect()->route('admin.setting_type.index')->with('message', '修改动态设置分组成功！');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($id == 1) {
            return redirect()->route('admin.setting_type.index')->with('fail', 'ID为1的默认动态设置分组不能被删除！！');
        } else {
            if ($this->setting->hasSetting($id)) {
                return redirect()->route('admin.setting_type.index')->with('fail', '该分组下还存在设置项，不能被删除；请清空该分组下设置项后再试！！');
            } else {
                $this->setting->destroy($id, '');  //注意，第二个参数不为'setting'，取的是SettingType模型
                return redirect()->route('admin.setting_type.index')->with('message', '删除动态设置分组成功！');
            }
        }
      
    }
}
