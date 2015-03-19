<?php namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\DouyasiRequest;

class RoleRequest extends DouyasiRequest
{

    /**
     * 自定义验证规则rules
     *
     * @param string $type 规则类型，'store'表示存储数据时规则，'update'表示更新数据时规则，'destroy'表示删除数据时规则（极少用到）
     * @return array
     */
    public function rules($type = 'store')
    {
        $id = $this->segment(3) ? ',' . $this->segment(3) : '';
        $rules = [
            'name' => 'required|eng_alpha|min:3|max:15|unique:roles,name'.$id,
        ];
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
            'name.required'   => '角色名必须存在',
            'name.max'         => '角色名长度不要超出15',
            'name.min'         => '角色名长度不得少于3',
            'name.eng_alpha' => '角色名只能为英文字母组合',
            'name.unique'     => '系统已存在该角色名',
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
            'operation' => '角色操作',
            'url' => route('admin.role.index'),
        ];
    }
}
