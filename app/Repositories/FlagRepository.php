<?php

namespace Douyasi\Repositories;

use Douyasi\Models\Flag;

/**
 * 推荐位Flag仓库FlagRepository
 * 请注意：推荐位不宜过多，不然会拖累文章查询速度，这里系统暂时限定最多10个推荐位
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class FlagRepository extends BaseRepository
{

    /**
     * Create a new ContentRepository instance.
     *
     * @param  Douyasi\Models\Flag $flag
     * @return void
     */
    public function __construct(
        Flag $flag)
    {
        $this->model = $flag;
    }


    /**
     * 获取前10条flag数据
     * 
     * @param  array $data 空数组
     * @param  string $extra 空字符串
     * @param  string $size
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $extra = '', $size = '10')
    {
        return $this->model->take(10)->get();
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
