<?php

namespace Douyasi\Models;

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

     /**
     * 动态设置
     * 模型对象关系：(动态设置)分组对应的动态设置（一个分组可以有多个设置项）
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function setting()
    {
        return $this->hasMany('Douyasi\Models\Setting', 'type_id', 'id');
    }
}
