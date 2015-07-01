<?php

namespace Douyasi\Models;

use Eloquent;

/**
 * 推荐位Flag模型
 * 参考织梦(DEDE)CMS，实现简单的文章推荐属性
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class Flag extends Eloquent
{

    protected $table = 'flags';
    public $timestamps = false;  //关闭自动更新时间戳

}
