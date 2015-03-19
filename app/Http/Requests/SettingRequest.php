<?php namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\DouyasiRequest;

class SettingRequest extends DouyasiRequest
{

    /**
     * 自定义验证规则rules
     *
     * @param string $type 规则类型，'store'表示存储数据时规则，'update'表示更新数据时规则，'destroy'表示删除数据时规则（极少用到）
     * @return array
     */
    public function rules($type = 'store')
    {
        if ($type === 'update') {
            $id = $this->segment(3) ? $this->segment(3) : 'null';
            $rules = [
                'name'           => 'required|max:20|eng_alpha_dash|unique:settings,name,'.$id.',id,type_id,'.$this->input('type_id'),
                'value'          => 'required|max:10|alpha_dash',
                'status'         => 'boolean',
                'type_id'        => 'required|exists:setting_type,id',
                'sort'           => 'numeric',
            ];
        } else {
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
            'type_id.required'  => '请选择动态设置分组',
            'type_id.exists'    => '不存在该动态设置分组',
            'name.required'   => '请填写动态设置名',
            'name.max'         => '动态设置名长度不要超出20',
            'name.eng_alpha_dash'     => '详细设置名只能为数字、字母、下划线与横杠(0-9A-Za-z_-)组合',
            'name.unique'       => '已存在同名的动态设置',
            'value.required'    => '请填写动态设置值',
            'value.max'          => '动态设置值长度不要超出10',
            'value.alpha_dash'  => '动态设置值包含非常规字符',
            'status.boolean'    => '状态必须是布尔值',
            'sort.numeric'      => '排序必须是数字',
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
            'operation' => '动态设置操作',
            'url' => route('admin.setting.index'),
        ];
    }
}
