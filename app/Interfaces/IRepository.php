<?php 

namespace Douyasi\Interfaces;

/**
 * 定义DouyasiRepository接口
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
interface IRepository
{

    #********
    #* 与资源 REST 相关的接口函数 START
    #********

    /**
     * 资源列表
     *
     * @param  array $data 必须传入与模型查询相关的数据
     * @param  string|array $extra 可选额外传入的参数
     * @param  string $size 分页大小（存在默认值）
     * @return Illuminate\Support\Collection
     */
    public function index($data, $extra, $size);

    /**
     * 存储资源
     *
     * @param  array $inputs 必须传入与存储模型相关的数据
     * @param  string|array $extra 可选额外传入的参数
     * @return Illuminate\Database\Eloquent\Model
     */
    public function store($inputs, $extra);

    /**
     * 编辑特定id资源
     *
     * @param  int $id 资源id
     * @param  string|array $extra 可选额外传入的参数
     * @return Illuminate\Support\Collection
     */
    public function edit($id, $extra);

    /**
     * 更新特定id资源
     *
     * @param  int $id 资源id
     * @param  array $inputs 必须传入与更新模型相关的数据
     * @param  string|array $extra 可选额外传入的参数
     * @return void
     */
    public function update($id, $inputs, $extra);

    /**
     * 删除特定id资源
     *
     * @param  int $id 资源id
     * @param  string|array $extra 可选额外传入的参数
     * @return void
     */
    public function destroy($id, $extra);

    #********
    #* 与资源 REST 相关的接口函数 END
    #********
}
