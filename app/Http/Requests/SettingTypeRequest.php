<?php

namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\Request;

class SettingTypeRequest extends Request
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
    public function rules()
    {
        $id = $this->segment(3) ? ','.$this->segment(3) : '';
        $rules = [
            'name'           => 'required|max:20|lower_case|unique:setting_type,name'.$id,
            'value'          => 'required|max:10|alpha_dash',
        ];
        if ($this->segment(3)) {
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
            'name.required'    => '请填写动态设置分组名',
            'name.max'         => '动态设置分组名长度不得超出20',
            'name.lower_case'  => '动态设置分组名只能为小写英文字母与下划线（a-z_）组合',
            'name.unique'      => '已存在同名的动态设置分组',
            'value.required'   => '请填写设置分组值',
            'value.max'        => '动态设置分组值长度不得超出10',
            'value.alpha_dash' => '动态设置分组值包含非常规字符',
            'sort.numeric'     => '排序必须是数字',
        ];
    }

}
