<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\SettingRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\SettingRepository;
use Cache;

/**
 * 系统动态设置控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminSettingController extends BackController
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

    
    public function index(Request $request)
    {
        $data = [
            's_name' => $request->input('s_name'),
            's_value' => $request->input('s_value'),
        ];
        $settings = $this->setting->index($data, 'setting', Cache::get('page_size', '10'));
        return view('back.setting.index', compact('settings'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = $this->setting->all();  //获取所有的动态设置分组
        return view('back.setting.create', compact('types'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SettingRequest $request)
    {
        $data = $request->all();
        $setting = $this->setting->store($data, 'setting');
        if ($setting->id) {
            return redirect()->route('admin.setting_type.show', $setting->type_id)->with('message', '成功新增动态设置！');
        } else {
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
        $types = $this->setting->all();  //获取所有动态设置分组
        $setting = $this->setting->edit($id);
        return view('back.setting.edit', ['data' => $setting, 'types'=> $types]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(SettingRequest $request, $id)
    {
        $data = $request->all();
        $setting = $this->setting->update($id, $data, 'setting');
        return redirect()->route('admin.setting_type.show', $setting->type_id)->with('message', '修改动态设置成功！');
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
        $this->setting->destroy($id, 'setting');
        return redirect()->route('admin.setting.index')->with('message', '删除动态设置成功！');
    }
}
