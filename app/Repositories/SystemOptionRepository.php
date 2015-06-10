<?php

namespace Douyasi\Repositories;

use Douyasi\Models\SystemOption;

/**
 * 系统配置仓库SystemOptionRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class SystemOptionRepository extends BaseRepository
{

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
        foreach ($data as $name=>$value) {
            $map = [
                'name' => $name
            ];
            $option->where($map)->update(['value' => e($value)]);
        }
    }

    /**
     * 系统配置资源列表数据
     * 注：暂使用all()返回所有角色数据，不进行分页与搜索处理
     *
     * @param  array $data
     * @param  array|string $extra
     * @param  string $size 分页大小
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $extra = '', $size = '10')
    {
        return $this->all();
    }

    #********
    #* 空写未使用的接口函数update与edit START
    #********
    public function edit($id = 0, $extra = ''){
        return;
    }
    public function update($id = 0, $inputs = [], $extra = ''){
        return;
    }
    #********
    #* 空写未使用的接口函数update与edit END
    #********
}
