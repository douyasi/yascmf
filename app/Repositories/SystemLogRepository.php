<?php namespace Douyasi\Repositories;

use Douyasi\Models\SystemLog;

/**
 * 系统配置仓库SystemOptionRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class SystemLogRepository extends BaseRepository{

	/**
	 * The SystemLog instance.
	 * 
	 * @var Douyasi\Models\SystemLog
	 */
	protected $log;

	/**
	 * Create a new SystemLogRepository instance.
	 *
	 * @param  Douyasi\Models\SystemLog $log
	 * @return void
	 */
	public function __construct(
		SystemLog $log)
	{
		$this->model = $log;
	}


	/**
	 * 系统日志资源列表数据
	 * 
	 * @param  array $data 额外传入的参数
	 * @param  string $size 分页大小
	 * @return Illuminate\Support\Collection
	 */
	public function index($data = [], $size = null)
	{
		if(!ctype_digit($size)) {
			$size = '10';
		}
		$data = array_add($data, 's_operator_realname', '');
		$data = array_add($data, 's_operator_ip', '');
		return $this->model->join('users','system_log.user_id','=','users.id')
						  ->select('system_log.*','users.realname')
						  ->where('users.realname','like','%'.e($data['s_operator_realname']).'%')
						  ->where('operator_ip','like','%'.e($data['s_operator_ip']).'%')
						  ->orderBy('created_at','desc')
						  ->paginate($size);
	}


	/**
	 * 批量更新系统配置
	 * 
	 * @param  array $data
	 * @return void
	 */
	public function batchUpdate($data)
	{
		$option = new $this->model;
		foreach ($data as $name=>$value){
			$map = [
				'name' => $name
			];
			$option->where($map)->update( ['value' => e($value)] );
		}
	}
}
