<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Douyasi\Cache\SystemOptionCache as SystemOptionCache;
use Douyasi\Repositories\SystemOptionRepository;

/**
 * 系统配置控制器
 * 
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminSystemOptionController extends BackController {

	/**
	 * The SettingRepository instance.
	 *
	 * @var Douyasi\Repositories\SettingRepository
	 */
	protected $option;

	public function __construct(
		SystemOptionRepository $option)
	{
		parent::__construct();
		$this->option = $option;
		
		if(! user('object')->can('manage_system')  ){
			$this->middleware('deny403');
		}
		
	}

	public function getIndex()
	{
		//
		$system_options = $this->option->index();
		foreach ($system_options as $so)
		{
			$data[$so['name']] = $so['value'];
		}

		return view('back.system_option.index', compact('data'));
	}


	public function putUpdate(Request $request)
	{
		if (($request->ajax()) && ($request->isMethod('put'))){
			$data = $request->input('data');
			$json = [
				'status' => 1, 
				'info' => '成功', 
				'operation'=>'更新系统配置', 
				'url' => route('admin.system_option.index'),
			];
			if($data && is_array($data)){
				$this->option->batchUpdate($data);
				//更新系统静态缓存
				SystemOptionCache::cacheStatic();
				return response()->json($json);
			}
			else{
				$json = array_replace($json, ['status' => 0, 'info' => '失败原因为：<span class="text_error">请勿提交非法数据！</span>']);
				return response()->json($json);
			}
		}
		else{
			//非ajax请求抛出异常
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}
	}


}
