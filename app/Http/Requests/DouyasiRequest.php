<?php namespace Douyasi\Http\Requests;

use Douyasi\Interfaces\IRequest as IRequest;
use Illuminate\Http\Request;

/**
 * DouyasiRequest
 * Laravel 5 的 FormRequest 自动表单验证并不太适合本系统，故扩展请求层，用于控制器端手动验证
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class DouyasiRequest implements IRequest
{

    /**
     * The ContentRepository instance.
     *
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a Request
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 验证数据
     *
     * @param string $type 请求场景类型
     * @return Illuminate\Contracts\Validation\Validator
     */
    public function validate($type = 'store')
    {
        $data = $this->data($type);
        $rules = $this->rules($type);
        $messages = $this->messages();
        $validator = $this->getValidationFactory()->make($data, $rules, $messages);
        return $validator;
    }

    /**
     * 等待验证的数据
     * 默认所有
     *
     * @param string $type 'store'表示存储时传入的数据，'update'表示更新时传入的数据，'destory'表示删除时传入的数据
     * @return array
     */
    public function data($type = 'store')
    {
        return $this->all();
    }

    #********
    #* Request 一些通用方法 START
    #********
    
    /**
     * 获取所有请求数据
     *
     * @return array
     */
    public function all()
    {
        return $this->request->all();
    }

    /**
     * 获取特定请求数据
     *
     * @param  string $key 键名
     * @param  mixed $default 默认键值
     * @return string|array
     */
    public function input($key = null, $default = null)
    {
        return $this->request->input($key, $default);
    }


    /**
     * 获取特定URL分段字符串
     *
     * @param  string $index URL分段索引
     * @param  mixed $default 默认值
     * @return string
     */
    public function segment($index, $default = null)
    {
        return $this->request->segment($index, $default);
    }

    /**
     * 判断是否为ajax请求
     *
     * @return boolean
     */
    public function is_ajax()
    {
        return $this->request->ajax();
    }

    /**
     * 判断是否为特定动作/方法请求
     *
     * @return boolean
     */
    public function is_method($method = 'post')
    {
        return $this->request->isMethod($method);
    }

    #********
    #* Request 一些通用方法 END
    #********

    /**
     * 自定义验证规则messages
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * 自定义验证消息rules
     *
     * @param string $type 规则类型，'store'表示存储数据时规则，'update'表示更新数据时规则，'destroy'表示删除数据时规则（极少用到）
     * @return array
     */
    public function rules($type = 'store')
    {
        return [];
    }


    /**
     * 自定义响应respose
     *
     * @return array 返回的数组将被JSON化作为响应
     */
    public function response()
    {
        return [
            'status' => 0,
            'info' => '失败',
            'operation' => '操作',
            'url' => url('/'),
        ];
    }

    /**
     * 授权状态
     *
     * @return boolean
     */
    public function authorize()
    {
        return false;
    }

    /**
     * 侦测是否通过授权
     *
     * @return boolean
     */
    protected function passesAuthorization()
    {
        if (method_exists($this, 'authorize')) {
            return $this->authorize();
        }
        return true;
    }

    /**
     * 未通过授权时发出的JSON响应
     *
     * @return Response
     */
    protected function failedAuthorization()
    {
        $json = $this->response();
        $json = array_replace($json, ['info' => '失败：<span class="text_error">未授权，请检查当前用户权限！</span>']);
        return response()->json($json);  //返回json响应
    }

    /**
     * 鉴权操作
     *
     * @return mixed Response|boolean 鉴权失败，返回'未授权'JSON响应，否则返回true
     */
    public function make($type = 'store')
    {
        if (!$this->passesAuthorization()) {
            return $this->failedAuthorization();
        } else {
            return true;
        }
    }

    /**
     * Get a validation factory instance.
     *
     * @return \Illuminate\Contracts\Validation\Factory
     */
    protected function getValidationFactory()
    {
        return app('Illuminate\Contracts\Validation\Factory');
    }
}
