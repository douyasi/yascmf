<?php namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\DouyasiRequest;

class SettingTypeRequest extends DouyasiRequest {

	/**
	 * 自定义验证规则rules
	 *
	 * @param string $type 规则类型，'store'表示存储数据时规则，'update'表示更新数据时规则，'destroy'表示删除数据时规则（极少用到）
	 * @return array
	 */
	public function rules($type = 'store')
	{
		$id = $this->segment(3) ? ','.$this->segment(3) : '';
		$rules = [
				'name'           => 'required|max:20|unique:setting_type,name'.$id,
				'value'          => 'required|max:10|alpha_dash',
			];
		if($type === 'update'){
			$rules = array_add($rules, 'sort', 'numeric');
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
			'name.required'   => '请填写动态设置分组名',
			'name.max'         => '动态设置分组名长度不得超出20',
			'name.lower_case'     => '动态设置分组名只能为小写英文字母与下划线(a-z_)组合',
			'name.unique'       => '已存在同名的动态设置分组',
			'value.required'    => '请填写设置分组值',
			'value.max'          => '动态设置分组值长度不得超出10',
			'value.alpha_dash'  => '动态设置分组值包含非常规字符',
			'sort.numeric'    =>'排序必须是数字',
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
			'operation' => '动态设置分组操作', 
			'url' => route('admin.setting_type.index'), 
		];
	}

}
