<?php namespace Douyasi\Models;

use Eloquent;

/**
 * 动态设置类型模型
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class SettingType extends Eloquent
{
    
    protected $table = 'setting_type';
    
    public $timestamps = false;  //关闭自动更新时间戳

    public function setting()
    {
        return $this->hasMany('Douyasi\Models\Setting', 'type_id', 'id');
    }
}
