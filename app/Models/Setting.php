<?php namespace Douyasi\Models;

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
     * 此表为复合型的Meta元数据表
     * 根据type不同确定不同内容模型
     * type : CATEGORY 分类
     * type : TAG 标签
     */

    public function setting_type()
    {
        return $this->belongsTo('Douyasi\Models\SettingType');
    }
}
