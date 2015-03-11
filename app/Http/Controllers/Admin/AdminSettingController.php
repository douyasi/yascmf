<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\SettingRequest;
use Douyasi\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Douyasi\Repositories\SettingRepository;

/**
 * 系统动态设置控制器
 * 
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminSettingController extends BackController {

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
		
		if(! user('object')->can('manage_system')  ){
			$this->middleware('deny403');
		}
		
	}

	
	public function index(Request $request)
	{
		$data = [
			's_name' => $request->input('s_name'),
			's_value' => $request->input('s_value'),
		];
		$settings = $this->setting->index('setting', $data);
		$links = page_links($settings, $data);
		return view('back.setting.index', compact('settings', 'links'));
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
		if ($request->is_ajax())
		{
			$validator = $request->validate('store');
			$data = $request->data('store');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '添加动态设置']);

			if($validator->passes()){
				$setting = $this->setting->store($data, 'setting');
				if($setting->id){
					$url = route('admin.setting_type.index').'/'.e($setting->type_id);
					$json = array_replace($json, ['status' => 1, 'info' => '成功', 'url' => $url]);
				}
				else{
					$info = '失败原因为：<span class="text_error">数据库操作返回异常</span>';
					$json = array_replace($json, ['info' => $info]);
				}
			} else {
				$json = format_json_message($validator->messages(), $json);
			}
			return response()->json($json);
		}

		else{
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
		$types = $this->setting->all();  //获取所有动态设置分组
		$setting = $this->setting->edit($id);
		is_null($setting) AND abort(404);
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
		if ( $request->is_ajax() && $request->is_method('put') )
		{
			$validator = $request->validate('update');
			$data = $request->data('update');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '修改动态设置']);

			if($validator->passes()){
				$setting = $this->setting->update($data, $id, 'setting');
				$url = route('admin.setting_type.index').'/'.e($setting->type_id);
				$json = array_replace($json, ['status' => 1, 'info' => '成功', 'url' => $url]);
			} else {
				$json = format_json_message($validator->messages(), $json);
			}
			return response()->json($json);
		}
		else{
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(SettingRequest $request, $id)
	{
	//
		if($request->is_ajax() && $request->is_method('delete'))
		{
			$this->setting->destroy($id, 'setting');
			$json = [
				'status' => 1, 
				'info' => '成功', 
				'operation' => '删除动态设置', 
				'url' => route('admin.setting.index'), 
			];
			return response()->json($json);
		}
		else{
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}
	}

}



