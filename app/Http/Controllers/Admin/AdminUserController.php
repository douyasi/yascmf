<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\UserRequest;
use Douyasi\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Douyasi\Logger\SystemLogger as SystemLogger;
use Douyasi\Repositories\UserRepository;


/**
 * （管理型）用户资源控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminUserController extends BackController {


	/**
	 * The UserRepository instance.
	 *
	 * @var Douyasi\Repositories\UserRepository
	 */
	protected $user;

	public function __construct(
		UserRepository $user)
	{
		parent::__construct();
		$this->user = $user;

		if(! user('object')->can('manage_users') ){
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
			's_name' => $request->input('s_name'), 
			's_phone' => $request->input('s_phone'), 
		];

		$users = $this->user->index('manager', $data);

		$links = page_links($users, $data);

		return view('back.user.index', compact('users', 'links'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$roles = $this->user->role();
		return view('back.user.create',['roles' => $roles]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
		//
		if($request->is_ajax())
		{
			$validator = $request->validate('store');
			$data = $request->data('store');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '添加管理用户']);
			if($validator->passes()){
				$manager = $this->user->store('manager', $data);
				if($manager->id){  //添加成功

					//记录系统日志，这里并未使用事件监听来记录日志
					$log = [
						'user_id' => user('id'),
						'type' => 'manager',
						'content' => '管理员：成功新增一名管理用户'.$manager->username.'<'.$manager->email.'>。',
					];
					SystemLogger::write($log);

					$json = array_replace($json, ['status' => 1, 'info' => '成功']);
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
	public function edit(UserRequest $request, $id)
	{
		//
		$user = $this->user->edit('manager', $id);
		is_null($user) AND abort(404);

		$roles = $this->user->role();

		//虽然Entrust支持一个用户多个角色用户组，但在本内容管理框架系统中，限定只能一个用户对应一个角色用户组
		$own_role = $this->user->getRole($user);

		if(is_null($own_role))  //新建的管理员用户可能不存在关联role模型
		{
			$own_role = $this->user->fakeRole();  //伪造一个Role对象，以免报错
		}
		return view('back.user.edit', compact('user', 'roles', 'own_role'));

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserRequest $request, $id)
	{
		//
		if ( $request->is_ajax() && $request->is_method('put') )
		{
			$validator = $request->validate('update');
			$data = $request->data('update');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '修改管理型用户']);

			if($validator->passes()){
				$this->user->update('manager', $data, $id);

				$log = [
					'user_id' => user('id'),
					'url'=>route('admin.user.edit', $id),
					'type'=>'manager',
					'content'=>'管理员：超级管理员修改了id为'.$id.'的管理用户资料。',
				];
				SystemLogger::write($log);

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
