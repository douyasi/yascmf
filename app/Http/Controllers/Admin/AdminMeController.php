<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\MeRequest;
use Douyasi\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Douyasi\Repositories\MeRepository;

/**
 * 我的账户控制器
 * 
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminMeController extends BackController {


	/**
	 * The RoleRepository instance.
	 *
	 * @var Douyasi\Repositories\MeRepository
	 */
	protected $me;


	public function __construct(
		MeRepository $me)
	{
		parent::__construct();
		$this->me = $me;
	}


	/**
	 * 个人资料页面
	 *
	 * @return Response
	 */
	public function getindex()
	{
		//
		$me = user('object');
		return view('back.me.index', compact('me'));
	}


	/**
	 * 提交修改个人资料
	 *
	 * @return Response
	 */
	public function putUpdate(MeRequest $request)
	{
		//
		if ( $request->is_ajax() && $request->is_method('put') )
		{
			$validator = $request->validate('update');
			$data = $request->data('update');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '修改个人资料']);

			if($validator->passes()){
				$this->me->update($data);
				$json = array_replace($json, ['status' => 1, 'info' => '成功']);
			} else {
				$json = format_json_message($validator->messages(), $json);
			}
			return response()->json($json);
		}
		else{
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}

	}

}
