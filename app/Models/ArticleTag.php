<?php namespace Douyasi\Models;

use Eloquent;

/*
 * 标签模型
 */
class ArticleTag extends Eloquent
{
    protected $table ='article_tag';


    public function contents(){
        return $this->belongsToMany('Douyasi\Models\Content');
    }
}
