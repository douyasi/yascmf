<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 业务管理主要控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminBusinessController extends BackController
{
    
    //
    /**
     * 业务管理页面首页
     * route('admin.business.index') 重定向至 route('admin.flow')
     */
    public function getIndex()
    {
        //跳转至 业务管理 - 业务流程 页面
        $redirect = redirect(route('admin.flow'));
        return $redirect;
    }

    /**
     * 业务流程
     * route('admin.flow')
     */
    public function getFlow()
    {
        return view('back.business.flow');
    }
}
