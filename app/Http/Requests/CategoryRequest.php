<?php

namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\Request;

class CategoryRequest extends Request
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
        //update
        if($this->segment(3)){
            $id = $this->segment(3);
            $rules = [
                'name'    => 'required|max:20|unique:metas,name,'.$id.',id,type,CATEGORY',
                'slug'    => 'required|max:10|eng_alpha_dash|unique:metas,slug,'.$id.',id,type,CATEGORY',
            ];
        }
        //store
        else{
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
            'name.required'       => '请填写分类名称',
            'name.max'            => '分类名称过长',
            'name.unique'         => '已有同名分类',
            'slug.required'       => '请填写分类缩略名',
            'slug.max'            => '分类缩略名过长',
            'slug.unique'         => '已有同名分类缩略名',
            'slug.eng_alpha_dash' => '分类缩略名只能数字、字母、下划线与横杠（0-9A-Za-z_-）组合',
        ];
    }
}
