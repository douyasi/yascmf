<?php namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\DouyasiRequest;

class FragmentRequest extends DouyasiRequest
{

    /**
     * 自定义验证规则rules
     *
     * @param string $type 规则类型，'store'表示存储数据时规则，'update'表示更新数据时规则，'destroy'表示删除数据时规则（极少用到）
     * @return array
     */
    public function rules($type = 'store')
    {
        $rules = [
            'title'   => 'required|max:80',
            'content' => 'required|min:20',
            'thumb'   => 'self_url',
        ];
        $id = $this->segment(3) ? ',' . $this->segment(3) : '';
        $rules = array_add($rules, 'slug', 'required|max:20|eng_alpha_dash|unique:contents,slug'.$id);
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
            'title.required'   => '请填写碎片标题',
            'title.max'         => '碎片标题过长，建议长度不要超出60',
            'slug.required'    => '请填写slug(碎片标识符)',
            'slug.max'          => 'slug(碎片标识符)过长',
            'slug.unique'      => '已有同名slug',
            'slug.eng_alpha_dash'  => 'slug(碎片标识符)只能数字、字母、下划线与横杠(0-9A-Za-z_-)组合',
            'content.required' => '请填写碎片正文',
            'content.min'      => '碎片正文过短，长度不得少于20',
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
            'operation' => '碎片操作',
            'url' => route('admin.fragment.index'),
        ];
    }
}
