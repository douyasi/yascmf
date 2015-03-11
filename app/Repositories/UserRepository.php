<?php namespace Douyasi\Repositories;


use Douyasi\Models\User;
use Douyasi\Models\Role;

/**
 * 用户仓库UserRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class UserRepository extends BaseRepository
{
	/**
	 * The Role instance.
	 * 
	 * @var Douyasi\Models\Role
	 */
	protected $role;

	/**
	 * Create a new UserRepository instance.
	 *
	 * @param  Douyasi\Models\Content $content
	 * @param  Douyasi\Models\Role $role
	 * @return void
	 */
	public function __construct(
		User $user,
		Role $role)
	{
		$this->model = $user;
		$this->role = $role;
	}

	/**
	 * 存储客户
	 * [二次开发项目所需，该CMS实现分支略去]
	 * 
	 * @param  array $inputs
	 * @param  int $sid
	 * @return void
	 */
	public function saveCustomer($inputs, $sid)
	{
		return;
	}


	/**
	 * 存储管理型用户
	 *
	 * @param  Douyasi\Models\User $manager
	 * @param  array $inputs
	 * @return Douyasi\Models\User
	 */
	private function saveManager($manager, $inputs)
	{
		$manager->username = $manager->nickname = e($inputs['username']);
		$manager->password = bcrypt(e($inputs['password']));
		$manager->email = e($inputs['email']);
		$manager->realname = e($inputs['realname']);
		$manager->user_type = 'Manager';  //管理型用户
		$manager->confirmation_code = md5(uniqid(mt_rand(), true));
		$manager->confirmed = true;  //确定用户已被验证激活

		if($manager->save()){
			$manager->roles()->attach($inputs('role'));  //附加上用户组（角色）
		}

		return $manager;
	}


	/**
	 * 更新管理型用户
	 *
	 * @param  Douyasi\Models\User $manager
	 * @param  array $inputs
	 * @return void
	 */
	private function updateManager($manager, $inputs)
	{
		$manager->nickname = e($inputs['nickname']);
		$manager->realname = e($inputs['realname']);
		$manager->is_lock = e($inputs['is_lock']);
		if( (!empty($inputs['password'])) && (!empty($inputs['password_confirmation'])) ){
			$manager->password = bcrypt(e($inputs['password']));
		}
		if($manager->save()){

			//确保一个管理型用户只拥有一个角色
			$roles = $manager->roles;
			if($roles->isEmpty()){  //判断角色结果集是否为空
				$manager->roles()->attach( $inputs['role'] );  //空角色，则直接同步角色
			}
			else{
				if(is_array($roles)){
					//如果为对象数组，则表明该管理用户拥有多个角色
					//则删除多个角色，再同步新的角色
					$manager->detachRoles($roles);
					$manager->roles()->attach( $inputs['role'] );  //同步角色
				}
				else{
					if( $roles->first()->id !== $inputs['role'] ){
						$manager->detachRole($roles->first());
						$manager->roles()->attach( $inputs['role'] );  //同步角色
					}
				}
			}
			//上面这一大段代码就是保证一个管理型用户只拥有一个角色
			//Entrust扩展包自身是支持一个用户拥有多个角色的，但在本内容管理框架系统中，限定一个用户只能拥有一个角色

		}
	}


	/**
	 * 用户资源列表数据
	 *
	 * @param  string $type 用户模型类型 管理型用户manager,客户customer
	 * @param  array $data 额外传入的参数
	 * @param  string $size 分页大小
	 * @return Illuminate\Support\Collection
	 */
	public function index($type = 'manager', $data = [], $size = null)
	{
		if(!ctype_digit($size)) {
			$size = '10';
		}
		if($type === 'manager'){

			$s_phone = e($data['s_phone']);
			if(!empty($s_phone)){
				$users = $this->model->manager()
									->where('phone','=', $s_phone)
									->where(function($query) use ($data) {
										$s_name = e($data['s_name']);
										if(!empty($s_name)){
											$query->where('username','like','%'.$s_name.'%')
												  ->orWhere('nickname','like','%'.$s_name.'%')
												  ->orWhere('realname','like','%'.$s_name.'%');
										}
									})
									->paginate($size);
			}
			else{
				$users = $this->model->manager()
									->where(function($query) use ($data) {
										$s_name = e($data['s_name']);
										if(!empty($s_name)){
											$query->where('username','like','%'.$s_name.'%')
												  ->orWhere('nickname','like','%'.$s_name.'%')
												  ->orWhere('realname','like','%'.$s_name.'%');
										}
									})
									->paginate($size);
			}
		}
		return $users;
	}

	/**
	 * 获取所有角色(用户组)
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function role()
	{
		return $roles = $this->role->all();
	}


	/**
	 * 存储用户
	 *
	 * @param  string $type 用户模型类型 管理型用户manager,客户customer
	 * @param  array  $inputs
	 * @param  int $user_id
	 * @return object 返回用户对象
	 */
	public function store($type = 'manager', $inputs, $user_id = null)
	{
		$user = new $this->model;
		if($type === 'manager'){
			$user = $this->saveManager($user, $inputs);
		}
		return $user;
	}


	/**
	 * 获取编辑的用户
	 *
	 * @param  string $type 用户模型类型 管理型用户manager,客户customer
	 * @param  int $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($type = 'manager', $id){
		if($type === 'manager'){
			$user = $this->model->manager()->findOrFail($id);
		}
		return $user;
	}

	/**
	 * 获取用户角色
	 * 
	 * @param  Douyasi\Models\User
	 * @return Illuminate\Support\Collection
	 */
	public function getRole($manager){
		return $manager->roles->first();
	}

	/**
	 * 伪造一个id为0的Role对象
	 * 
	 * @return Douyasi\Models\Role
	 */
	public function fakeRole(){
		$role = new $this->role;
		$role->id = 0;  //id置为不存在的0
		return $role;
	}


	/**
	 * 更新用户
	 *
	 * @param  string 用户模型类型 管理型用户manager,客户customer
	 * @param  array  $inputs
	 * @param  int    $id
	 * @return void
	 */
	public function update($type = 'manager', $inputs, $id)
	{
		if($type === 'manager'){
			$user = $this->model->manager()->findOrFail($id);
			$user = $this->updateManager($user, $inputs);
		}
	}
}
