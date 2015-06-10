<?php

namespace Douyasi\Extensions;

use Illuminate\Validation\Validator;


/**
 * DouyasiValidator
 * 扩展自定义验证
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class DouyasiValidator extends Validator
{

    /*只允许英文字母组合A-Za-z*/
    public function validateEngAlpha($attribute, $value)
    {
        return preg_match('/^[A-Za-z]+$/', $value);
    }
    
    /*只允许英文字母与阿拉伯数字组合A-Za-z0-9*/
    public function validateEngAlphaNum($attribute, $value)
    {
        return preg_match('/^[A-Za-z0-9]+$/', $value);
    }
    
    /*只允许英文字母、阿拉伯数字与中划线、下划线组合A-Za-z0-9_-*/
    public function validateEngAlphaDash($attribute, $value)
    {
        return preg_match('/^[A-Za-z0-9_-]+$/', $value);
    }
    
    /*只允许全小写化的英文字符串，单词间使用下划线(_)拼接*/
    public function validateLowerCase($attribute, $value)
    {
        return preg_match('/^[a-z_]+$/', $value);
    }

    /*只允许全大写化的英文字符串，单词间使用下划线(_)拼接*/
    public function validateUpperCase($attribute, $value)
    {
        return preg_match('/^[A-Z_]+$/', $value);
    }

    /*验证手机号是否合法，使用正则判定，可能存在遗漏*/
    public function validateMobilePhone($attribute, $value)
    {
        /*
        匹配中国国内手机号正则
        modified by raoyc
        /^13[0-9]{9}|14[57]{1}[0-9]{8}|15[012356789]{1}[0-9]{8}|170[059]{1}[0-9]{8}|18[0-9]{9}|177[0-9]{8}$/

        此正则验证以下手机电话号码段，如后续有扩展请自行增删改
        更新时间：2015-01-07
        http://zh.wikipedia.org/wiki/%E4%B8%AD%E5%8D%8E%E4%BA%BA%E6%B0%91%E5%85%B1%E5%92%8C%E5%9B%BD%E5%A2%83%E5%86%85%E5%9C%B0%E5%8C%BA%E7%A7%BB%E5%8A%A8%E7%BB%88%E7%AB%AF%E9%80%9A%E8%AE%AF%E5%8F%B7%E7%A0%81
        移动： 134[0-8] 135 136 137 138 139 147 150 151 152 157 158 159 182 183 184 187 188
        联通： 130 131 132 145 155 156 185 186
        电信： 133 134[9] 153 177 180 181 189
        虚拟运营商： 1700 1705 1709

        13[0-9]{9}
        14[57]{1}[0-9]{8}
        15[012356789]{1}[0-9]{8}
        170[059]{1}[0-9]{8}
        177[0-9]{8}
        18[0-9]{9}
        */
        return preg_match('/^13[0-9]{9}|14[57]{1}[0-9]{8}|15[012356789]{1}[0-9]{8}|170[059]{1}[0-9]{8}|18[0-9]{9}|177[0-9]{8}$/', $value);
    }

    /*验证url字符串是否属于自己当前域名下*/
    public function validateSelfUrl($attribute, $value)
    {
        $domain = url('');
        return (stripos($value, $domain) === false) ? false: true;
    }

    /**
     * 验证枚举类型
     * 'enum:0,1,-1'
    */
    public function validateEnum($attribute, $value, $parameters)
    {
        $acceptable = $parameters;  //传入的参数$parameters已经数组化
        return ($this->validateRequired($attribute, $value) && in_array($value, $acceptable, true));
    }

    /**
     * 验证外链地址（使用正则）
     * [@stephenhay] 参考 https://mathiasbynens.be/demo/url-regex
     */
    public function validateUrlLink($attribute, $value)
    {
        $regex = '@^(https?|ftp)://[^\s/$.?#].[^\s]*$@iS';
        return preg_match($regex, trim(e($value)));
    }

    /**
     * 验证身份证是否合法，该判定条件有限，只能作为简单的校验
     * 依赖于douyasi/identity-card
     * 如要使用，请在composer require加入：
     *      "douyasi/identity-card": "dev-master"
     * 
     */
    public function validateIdentityCard($attribute, $value)
    {
        $ID = new \Douyasi\IdentityCard\ID;
        return $ID->validateIDCard($value);
    }
}
