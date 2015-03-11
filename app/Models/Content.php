<?php namespace Douyasi\Models;

use Eloquent;

/**
 * 内容模型
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class Content extends Eloquent {
	protected $table = 'contents';
	
	/**
	 * 此表为复合型的内容数据表
	 * 根据type不同确定不同内容模型
	 * type : article 文章模型
	 * type : page 单页模型
	 * type : fragment 碎片模型
	 * type : memo 备忘模型
	 */
	
	//范围查询
	public function scopeArticle($query)
	{
		return $query->where('type', '=', 'article');
	}

	public function scopePage($query)
	{
		return $query->where('type', '=', 'page');
	}

	public function scopeFragment($query)
	{
		return $query->where('type', '=' , 'fragment');
	}

	public function scopeMemo($query)
	{
		return $query->where('type', '=' , 'memo');
	}

	//分类
	public function meta()
	{
		//模型名 外键 本键
		return $this->hasOne('Douyasi\Models\Meta','id','category_id');
	}


	//标签 [复杂度较高]
	public function tag(){

	}

}
