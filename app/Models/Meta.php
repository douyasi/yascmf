<?php namespace Douyasi\Models;

use Eloquent;

/**
 * 元模型
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class Meta extends Eloquent
{
    
    protected $table = 'metas';
    
    public $timestamps = false;  //关闭自动更新时间戳

    /**
     * 此表为复合型的Meta元数据表
     * 根据type不同确定不同内容模型
     * type : CATEGORY 分类
     * type : TAG 标签
     */
    public function scopeCategory($query)
    {
        return $query->where('type', '=', 'CATEGORY');
    }

    public function scopeTag($query)
    {
        return $query->where('type', '=', 'TAG');
    }

    public function content()
    {
        return $this->belongsTo('Douyasi\Models\Content', 'id', 'category_id');
    }
}
