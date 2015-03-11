<?php namespace Douyasi\Repositories;

use Douyasi\Models\SystemOption;

/**
 * 系统配置仓库SystemOptionRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class SystemOptionRepository extends BaseRepository{

	/**
	 * The SystemOption instance.
	 * 
	 * @var Douyasi\Models\SystemOption
	 */
	protected $option;

	/**
	 * Create a new SystemOptionRepository instance.
	 *
	 * @param  Douyasi\Models\SystemOption $option
	 * @return void
	 */
	public function __construct(
		SystemOption $option)
	{
		$this->model = $option;
	}


	/**
	 * 系统配置资源列表数据
	 * 注：暂使用all()返回所有角色数据，不进行分页与搜索处理
	 *
	 * @param  array $data 额外传入的参数
	 * @param  string $size 分页大小
	 * @return Illuminate\Support\Collection
	 */
	public function index($data = [], $size = null)
	{
		return $this->all();
	}

	/**
	 * 获取所有系统配置数据
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function all()
	{
		$options = $this->model->all();
		return $options;
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
