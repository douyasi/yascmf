<?php

namespace Douyasi\Models;

use Eloquent;

/**
 * 系统日志模型
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class SystemLog extends Eloquent
{

    protected $table = 'system_log';
    
    protected $fillable = array('user_id', 'type', 'url', 'content', 'operator_ip');

     /**
     * 操作用户
     * 模型对象关系：系统日志对应的操作用户
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Douyasi\Models\User', 'user_id', 'id');
    }
}
