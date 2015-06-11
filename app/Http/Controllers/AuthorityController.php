<?php

namespace Douyasi\Http\Controllers;

use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Douyasi\Events\UserLogin;
use Douyasi\Events\UserLogout;

/**
 * 用户登录统一认证
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AuthorityController extends CommonController
{

    /**
     * 添加路由过滤中间件
     */
    public function __construct()
    {
        $this->middleware('visitor', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        return view('authority.login');
    }

    public function postLogin(Request $request)
    {

        //认证凭证
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'user_type' => 'Manager',
            'is_lock'=> 0,
        ];
        if (Auth::attempt($credentials, $request->has('remember'))) {
            event(new UserLogin(user('object')));  //触发登录事件
            return redirect()->intended(route('admin'));
        } else {
            // 登录失败，跳回
            return redirect()->back()
                             ->withInput()
                             ->withErrors(array('attempt' => '“用户名”或“密码”错误，请重新登录！'));  //回传错误信息
        }
    }

    public function getLogout()
    {
        event(new UserLogout(user('object')));  //触发登出事件
        Auth::logout();
        return redirect()->to('/');
    }
}
