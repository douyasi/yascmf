<?php namespace Douyasi\Http\Requests;

use Douyasi\Http\Requests\Request;

class TagRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 自定义验证规则rules
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'tag_name'       => 'required|max:80',
            'tag_ico'        => 'required|self_url',
        ];
/*        if($this->segment(3)){
            $id    = $this->segment(3) ? ',' . $this->segment(3) : '';
            $rules = array_add($rules, 'slug', 'required|max:30|eng_alpha_dash|unique:contents,slug'.$id);
        }*/
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
            'tag_name.required'    => '请填写标签名',
            'tag_name.max'         => '文章标题过长，建议长度不要超出60',
            'tag_ico.required'     => '请添加标签logo',
        ];
    }
}
