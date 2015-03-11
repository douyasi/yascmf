<?php namespace Douyasi\Repositories;

use Douyasi\Events\UserUpdate as UserUpdate;

/**
 * 当前用户（Me）仓库MeRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class MeRepository extends BaseRepository
{
	public function __construct()
	{
		//无须引入User模型，因为 user('object') 辅助函数已经可以取得当前用户User对象
	}

	/**
	 * 更新管理型用户
	 *
	 * @param  array $inputs
	 * @return void
	 */
	public function updateMe($inputs)
	{
		$me = user('object');
		$me->nickname = e($inputs['nickname']);
		$me->realname = e($inputs['realname']);
		if(!empty($inputs['phone'])){
			$me->phone = e($inputs['phone']);
		}
		if(!empty($inputs['address'])){
			$me->address = e($inputs['address']);
		}
		if( (!empty($inputs['password'])) && (!empty($inputs['password_confirmation'])) ){
			$me->password = bcrypt(e($inputs['password']));
		}
		if($me->save()){
			event( new UserUpdate( $me ) );  //触发更新个人资料事件，这里将触发事件放置在仓库里可能有些不妥
		}
	}


	/**
	 * 更新当前用户
	 *
	 * @param  array $inputs
	 * @return void
	 */
	public function update($inputs)
	{
		$this->updateMe($inputs);
	}
}
