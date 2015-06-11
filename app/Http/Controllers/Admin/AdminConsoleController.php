<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 后台控制台常规控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminConsoleController extends BackController
{

    /**
     * 后台首页 === 后台控制台概要页面
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('back.console.index');
    }
}
