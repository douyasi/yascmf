<?php

namespace Douyasi\Repositories;

use Douyasi\Models\Role;
use Douyasi\Models\Permission;

/**
 * 角色（用户组）仓库RoleRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class RoleRepository extends BaseRepository
{

    /**
     * The Content instance.
     *
     * @var Douyasi\Models\Permission
     */
    protected $permission;

    /**
     * Create a new MetaRepository instance.
     *
     * @param  Douyasi\Models\Role $role
     * @param  Douyasi\Models\Permission $permission
     * @return void
     */
    public function __construct(
        Role $role,
        Permission $permission)
    {
        $this->model = $role;
        $this->permission = $permission;
    }

    /**
     * 获取所有角色数据
     *
     * @return Illuminate\Support\Collection
     */
    public function all()
    {
        $roles = $this->model->all();
        return $roles;
    }

    /**
     * 获取所有权限许可
     *
     * @return Illuminate\Support\Collection
     */
    public function permission()
    {
        $permissions = $this->permission->all();
        return $permissions;
    }

    /**
     * 获取当前角色所拥有的权限
     *
     * @param  Illuminate\Support\Collection $role
     * @return array
     */
    public function getRoleCans($role)
    {
        $perms = $role->perms;  //请参阅Entrust文档：https://github.com/Zizaco/entrust/tree/laravel-5
        $cans = array();
        foreach ($perms as $p) {
            $cans[] = ['id' => $p->id, 'name' => $p->name];
        }
        return $cans;
    }


    /**
     * 创建或更新Role
     *
     * @param  Douyasi\Models\Role $role
     * @param  array $inputs
     * @return Douyasi\Models\Role
     */
    private function saveRole($role, $inputs)
    {
        $role->name = e($inputs['name']);
        $role->display_name = e($inputs['display_name']);
        if (array_key_exists('description', $inputs)) {
            $role->description = e($inputs['description']) ;
        }
        if ($role->save()) {
            if (array_key_exists('permissions', $inputs)) {
                $permissions = $inputs['permissions'];  //这里提交的为数组
                if (is_array($permissions) && $permissions) {
                    $role->perms()->sync($permissions);  //同步角色权限
                }
            } else {
                $role->perms()->sync([]);
            }
        }
        return $role;
    }

    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 角色资源列表数据
     * 注：暂使用all()返回所有角色数据，不进行分页与搜索处理
     *
     * @param  array $data
     * @param  string $extra 
     * @param  string $size 分页大小
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $extra = '', $size = '10')
    {
        return $this->all();
    }

    /**
     * 存储角色
     *
     * @param  array $inputs
     * @param  string|array $extra
     * @return Douyasi\Models\Role
     */
    public function store($inputs, $extra = '')
    {
        $role = new $this->model;
        $role = $this->saveRole($role, $inputs);
        return $role;
    }

    /**
     * 获取编辑的角色
     *
     * @param  int $id
     * @param  string|array $extra
     * @return Illuminate\Support\Collection
     */
    public function edit($id, $extra = '')
    {
        $role = $this->getById($id);
        return $role;
    }

    /**
     * 更新角色
     *
     * @param  int $id
     * @param  array $inputs
     * @param  string|array $extra
     * @return void
     */
    public function update($id, $inputs, $extra = '')
    {
        $role = $this->getById($id);
        $role = $this->saveRole($role, $inputs);
    }

    /**
     * 删除角色
     *
     * @param  int $id
     * @param  string|array $extra
     * @return void
     */
    public function destroy($id, $extra = '')
    {
        $role = $this->getById($id);
        $role->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
