<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\RoleRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\RoleRepository;

/**
 * 角色资源控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminRoleController extends BackController
{

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
        
        if (! user('object')->can('manage_users')) {
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
        $data = $request->all();
        $role = $this->role->store($data);
        if ($role->id) {  //添加成功
            return redirect()->route('admin.role.index')->with('message', '成功新增角色！');
        } else {  //添加失败
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
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
        $permissions = $this->role->permission();
        $cans = $this->role->getRoleCans($role);

        return view('back.role.edit', compact('role', 'permissions', 'cans'));
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
        $data = $request->all();
        $this->role->update($id, $data);
        return redirect()->route('admin.role.index')->with('message', '修改角色成功！');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $this->role->destroy($id);
        return redirect()->route('admin.role.index')->with('message', '删除角色成功！');
    }
}
