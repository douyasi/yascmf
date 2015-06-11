<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\MeRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Repositories\MeRepository;

/**
 * 我的账户控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminMeController extends BackController
{


    /**
     * The MeRepository instance.
     *
     * @var Douyasi\Repositories\MeRepository
     */
    protected $me;


    public function __construct(
        MeRepository $me)
    {
        parent::__construct();
        $this->me = $me;
    }


    /**
     * 个人资料页面
     *
     * @return Response
     */
    public function getindex()
    {
        $me = user('object');
        return view('back.me.index', compact('me'));
    }


    /**
     * 提交修改个人资料
     *
     * @return Response
     */
    public function putUpdate(MeRequest $request)
    {
        //使用Bootstrap后台框架，可以废弃ajax提交方式，使用表单自动验证
        $this->me->update(user('id'), $request->all());
        return redirect()->route('admin.me.index')->with('message', '成功更新个人资料！');
    }
}
