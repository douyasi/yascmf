<?php 

namespace Douyasi\Interfaces;

/**
 * 定义DouyasiRequest接口
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
interface IRequest
{

    /**
     * 验证数据
     *
     * @param string $type 请求场景类型
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validate($type);

    /**
     * 等待验证的数据
     *
     * @param string $type 请求场景类型
     * @return array
     */
    public function data($type);

    /**
     * 自定义验证规则rules
     *
     * @param string $type 请求场景类型
     * @return array
     */
    public function rules($type);

    /**
     * 自定义验证消息messages
     *
     * @return array
     */
    public function messages();

    /**
     * 授权状态
     *
     * @return boolean
     */
    public function authorize();


    /**
     * 鉴权操作
     *
     * @return mixed
     */
    public function make();
}
