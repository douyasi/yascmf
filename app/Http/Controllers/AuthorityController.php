<?php namespace Douyasi\Http\Controllers;

use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Douyasi\Events\UserLogin as UserLogin;
use Douyasi\Events\UserLogout as UserLogout;
use Douyasi\Http\Requests\UserRequest;
use Douyasi\Models\User;
use Douyasi\Services\Registrar;
use Douyasi\Cache\DataCache;
use Cache;

/**
 * 用户登录统一认证
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AuthorityController extends CommonController
{

    /**
     * 添加路由过滤中间件
     * Douyasi\Http\Middleware\Visit
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
            //'user_type' => 'Manager',
            'is_lock' => 0,
        ];
        /* Auth::attempt
         * Use Auth (实例)Illuminate\Auth\Guard
         * Attempt to authenticate a user using the given credentials.
         * @param array $credentials = array()
         * @param bool $remember = false
         * @param bool $login = true
         */
        if (Auth::attempt($credentials, $request->has('remember'))) {
            event(new UserLogin(user('object')));  //event 辅助方法触发登录事件
            /**
             * 取得缓存主页左边菜单的缓存
             * 首先判断缓存是否存在
             * 如果不存在重新缓存
             */
            $user_id = user('id');
            if (!Cache::get('SideBar' . $user_id)) {
                DataCache::cacheSideBar();
            }
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

    public function getRegister()
    {

        return view('authority.register');
    }

    /**
     * Request
     * Illuminate/Support/MessageBag.php
     */

    public function postRegister(UserRequest $request)
    {

        $user = new User();
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->email = $request->input('email');
        $user->nickname = $request->input('nickname');
        $user->realname = $request->input('realname');
        $user->username  = $request->input('username');
        $user->password  = bcrypt($request->input('password'));
        $user->email     = $request->input('email');
        $user->save();
        return redirect()->route('login')->with('message', '注册成功！');
    }
}
