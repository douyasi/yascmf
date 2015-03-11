<?php namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\DouyasiRequest;

class MeRequest extends DouyasiRequest {

	/**
	 * 自定义验证规则rules
	 *
	 * @param string $type 规则类型，'store'表示存储数据时规则，'update'表示更新数据时规则，'destroy'表示删除数据时规则（极少用到）
	 * @return array
	 */
	public function rules($type = 'store')
	{
		return [
			'nickname'                 => 'required|alpha_dash|min:2|max:5',
			'realname'                 => 'required|min:2|max:5|regex:/^[\x{4e00}-\x{9fa5}]{2,5}$/u',  //中文正则匹配可能有遗漏
			'phone'                    => 'size:11|mobile_phone|unique:users,phone,'.user('id'),  //排除当前用户id
			'address'                   => 'min:5',
			'password'                 => 'min:6|max:16|regex:/^[a-zA-Z0-9~@#%_]{6,16}$/i',  //登录密码只能英文字母(a-zA-Z)、阿拉伯数字(0-9)、特殊符号(~@#%)
			'password_confirmation'  => 'same:password',
		];
	}

	/**
	 * 自定义验证信息
	 * 
	 * @return array
	 */
	public function messages()
	{
		return [
			'nickname.required'  => '请填写昵称',
			'nickname.min'       => '昵称字数不得少于2',
			'nickname.max'       => '昵称字数不得多于5',
			'nickname.alpha_dash'    => '昵称包含某些非常规字符，请移除后重试',

			'realname.required'  => '请填写真实姓名',
			'realname.min'       => '真实姓名字数不得少于2',
			'realname.max'       => '真实姓名字数不得多于5',
			'realname.regex'    => '真实姓名必须为中文',

			'phone.required'      => '请填写手机号码',
			'phone.size'         => '国内的手机号码长度为11位',
			'phone.mobile_phone'       => '请填写合法的手机号码',
			'phone.unique'      => '此手机号码已存在于系统中',

			'address.min'       => '通联地址长度不得少于5',

			'password.min'          => '密码长度不得少于6',
			'password.max'          => '密码长度不得超出16',
			'password.regex'        => '密码包含非法字符，只能为英文字母(a-zA-Z)、阿拉伯数字(0-9)与特殊符号(~@#%_)组合',

			'password_confirmation.same'      => '2次密码不一致',
		];
	}

	/**
	 * 自定义响应
	 *
	 * @return array 返回的数组将被JSON化作为响应
	 */
	public function response()
	{
		return [
			'status' => 0, 
			'info' => '失败', 
			'operation' => '更新个人资料操作', 
			'url' => route('admin.me.index'), 
		];
	}

}
