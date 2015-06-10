<?php

namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\DouyasiRequest;

class SettingRequest extends Request
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
            $id = $this->segment(3) ? $this->segment(3) : 'null';
            $rules = [
                'name'           => 'required|max:20|eng_alpha_dash|unique:settings,name,'.$id.',id,type_id,'.$this->input('type_id'),
                'value'          => 'required|max:10|alpha_dash',
                'status'         => 'boolean',
                'type_id'        => 'required|exists:setting_type,id',
                'sort'           => 'numeric',
            ];
        }
        //store
        else {
            $rules = [
                'type_id'        => 'required|exists:setting_type,id',
                'name'           => 'required|max:20|eng_alpha_dash|unique:settings,name,null,id,type_id,'.$this->input('type_id'),
                'value'          => 'required|max:10|alpha_dash',
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
            'type_id.required'    => '请选择动态设置分组',
            'type_id.exists'      => '不存在该动态设置分组',
            'name.required'       => '请填写动态设置名',
            'name.max'            => '动态设置名长度不要超出20',
            'name.eng_alpha_dash' => '详细设置名只能为数字、字母、下划线与横杠（0-9A-Za-z_-）组合',
            'name.unique'         => '已存在同名的动态设置',
            'value.required'      => '请填写动态设置值',
            'value.max'           => '动态设置值长度不要超出10',
            'value.alpha_dash'    => '动态设置值包含非常规字符',
            'status.boolean'      => '状态必须是布尔值',
            'sort.numeric'        => '排序必须是数字',
        ];
    }
}
