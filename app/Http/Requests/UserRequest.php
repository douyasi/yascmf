<?php

namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\DouyasiRequest;

class UserRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * 自定义验证规则rules
     *
     * @return array
     */
    public function rules($type = 'store')
    {
        //update
        if($this->segment(3)){
            $rules = [
                'nickname'              => 'required|alpha_dash|min:4|max:10',
                'realname'              => 'required|min:2|max:5|regex:/^[\x{4e00}-\x{9fa5}]{2,5}$/u',  //中文正则匹配可能有遗漏
                'password'              => 'min:6|max:16|regex:/^[a-zA-Z0-9~@#%_]{6,16}$/i',  //登录密码只能英文字母(a-zA-Z)、阿拉伯数字(0-9)、特殊符号(~@#%)
                'password_confirmation' => 'same:password',
                'role'                  => 'required|exists:roles,id',
                'is_lock'               => 'required|boolean',
            ];
        }
        //store
        else{
            $rules = [
                'username'                 => 'required|min:4|max:10|eng_alpha_num|unique:users,username',
                'password'                 => 'required|min:6|max:16|regex:/^[a-zA-Z0-9~@#%_]{6,16}$/i',  //登录密码只能英文字母(a-zA-Z)、阿拉伯数字(0-9)、特殊符号(~@#%)
                'password_confirmation'    => 'required|same:password',
                'role'                     => 'required|exists:roles,id',
                'email'                    => 'required|email|unique:users,email',
                'realname'                 => 'required|min:2|max:5|regex:/^[\x{4e00}-\x{9fa5}]{2,5}$/u',  //中文正则匹配可能有遗漏
                'phone'                    => 'size:11|mobile_phone|unique:users,phone',
            ];
        }
        return $rules;
    }

    /**
     * 自定义验证信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nickname.required'   => '请填写昵称',
            'nickname.alpha_dash' => '昵称包含特殊字符',
            'nickname.min'        => '昵称过短，长度不得少于4',
            'nickname.max'        => '昵称过长，长度不得超出10',

            'username.unique'        => '此登录名已存在，请尝试其它名字组合',
            'username.required'      => '请填写登录名',
            'username.max'           => '登录名过长，长度不得超出10',
            'username.min'           => '登录名过短，长度不得少于4',
            'username.eng_alpha_num' => '登录名只能阿拉伯数字与英文字母组合',
            'username.unique'        => '此登录名已存在，请尝试其它名字组合',

            'password.required'              => '请填写登录密码',
            'password.min'                   => '密码长度不得少于6',
            'password.max'                   => '密码长度不得超出16',
            'password.regex'                 => '密码包含非法字符，只能为英文字母(a-zA-Z)、阿拉伯数字(0-9)与特殊符号(~@#%_)组合',
            'password_confirmation.required' => '请填写确认密码',
            'password_confirmation.same'     => '2次密码不一致',

            'role.required' => '请选择角色（用户组）',
            'role.exists'   => '系统不存在该角色（用户组）',

            'email.required' => '请填写邮箱地址',
            'email.email'    => '请填写正确合法的邮箱地址',
            'email.unique'   => '此邮箱地址已存在于系统，不能再进行二次关联',

            'realname.required' => '请填写真实姓名',
            'realname.min'      => '真实姓名字数不得少于2',
            'realname.max'      => '真实姓名字数不得多于5',
            'realname.regex'    => '真实姓名必须为中文',

            'phone.size'         => '国内的手机号码长度为11位',
            'phone.mobile_phone' => '请填写合法的手机号码',
            'phone.unique'       => '此手机号码已存在于系统中，不能再进行二次关联',

            'is_lock.required' => '请选择用户状态',
            'is_lock.boolean'  => '用户状态必须为布尔值',
        ];
    }
}
