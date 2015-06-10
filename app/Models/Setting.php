<?php

namespace Douyasi\Models;

use Eloquent;

/**
 * 动态设置模型
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class Setting extends Eloquent
{
    
    protected $table = 'settings';
    
    public $timestamps = false;  //关闭自动更新时间戳

    /**
     * 动态设置分组
     * 模型对象关系：动态设置对应的分组
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function setting_type()
    {
        return $this->belongsTo('Douyasi\Models\SettingType');
    }
}
