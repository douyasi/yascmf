<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\RoleRequest;
use Douyasi\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Douyasi\Repositories\RoleRepository;

/**
 * 角色资源控制器
 * 
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminRoleController extends BackController {

	/**
	 * The RoleRepository instance.
	 *
	 * @var Douyasi\Repositories\RoleRepository
	 */
	protected $role;


	public function __construct(
		RoleRepository $role)
	{
		parent::__construct();
		$this->role = $role;
		
		if(! user('object')->can('manage_users') ){
			$this->middleware('deny403');
		}
		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		/*角色（用户组）列表*/
		$roles = $this->role->index();
		return view('back.role.index', compact('roles'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$permissions = $this->role->permission();  //获取所有权限许可
		return view('back.role.create', compact('permissions'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RoleRequest $request)
	{
		//
		if ($request->is_ajax())
		{
			$validator = $request->validate('store');
			$data = $request->data('store');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '添加角色']);

			if($validator->passes()){
				$role = $this->role->store ($data);
				if($role->id){  //添加成功
					$json = array_replace($json, ['status' => 1, 'info' => '成功']);
				}
				else{  //添加失败
					$info = '失败原因为：<span class="text_error">数据库操作返回异常</span>';
					$json = array_replace($json, ['info' => $info]);
				}
			} else {
				// 验证失败
				$json = format_json_message($validator->messages(), $json);
			}
			return response()->json($json);
		}
		else{
			//非ajax请求抛出异常
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
		$role = $this->role->edit($id);
		is_null($role) AND abort(404);
		$permissions = $this->role->permission();
		
		$cans = $this->role->getRoleCans($role);

		return view('back.role.edit', compact('role', 'permissions' , 'cans'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(RoleRequest $request, $id)
	{
		//
		if ( $request->is_ajax() && $request->is_method('put') )
		{
			$validator = $request->validate('update');
			$data = $request->data('update');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '修改角色']);

			if($validator->passes()){
				$this->role->update($data, $id);
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


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(RoleRequest $request, $id)
	{
		//
		if($request->is_ajax() && $request->is_method('delete'))
		{
			$this->role->destroy($id);
			$json = [
				'status' => 1, 
				'info' => '成功', 
				'operation' => '删除角色', 
				'url' => route('admin.role.index'), 
			];
			return response()->json($json);
		}
		else{
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}
	}


}
