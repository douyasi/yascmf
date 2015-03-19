<?php namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\DouyasiRequest;

class CategoryRequest extends DouyasiRequest
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
            $id = $this->segment(3) ? $this->segment(3) : 'NULL';
            $rules = [
                'name'    => 'required|max:20|unique:metas,name,'.$id.',id,type,CATEGORY',
                'slug'    => 'required|max:10|eng_alpha_dash|unique:metas,slug,'.$id.',id,type,CATEGORY',
            ];
        } else {
            $rules = [
                'name'    => 'required|max:20|unique:metas,name,NULL,id,type,CATEGORY',
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
            'name.required'   => '请填写分类名称',
            'name.max'         => '分类名称过长',
            'name.unique'     => '已有同名分类',
            'slug.required'    => '请填写分类缩略名',
            'slug.max'          => '分类缩略名过长',
            'slug.unique'      => '已有同名分类缩略名',
            'slug.eng_alpha_dash'  => '分类缩略名只能数字、字母、下划线与横杠(0-9A-Za-z_-)组合',
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
            'operation' => '分类操作',
            'url' => route('admin.category.index'),
        ];
    }
}
