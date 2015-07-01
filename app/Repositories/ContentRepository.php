<?php

namespace Douyasi\Repositories;

use Douyasi\Models\Content;
use Douyasi\Models\Meta;

/**
 * 内容仓库ContentRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class ContentRepository extends BaseRepository
{

    /**
     * The Meta instance.
     *
     * @var Douyasi\Models\Meta
     */
    protected $meta;

    /**
     * Create a new ContentRepository instance.
     *
     * @param  Douyasi\Models\Content $content
     * @param  Douyasi\Models\Meta $meta
     * @return void
     */
    public function __construct(
        Content $content,
        Meta $meta)
    {
        $this->model = $content;
        $this->meta = $meta;
    }

    /**
     * 获取内容模型所有类型
     *
     * @return array
     */
    private function getModelTypes()
    {
        return [
            'article', //文章
            'page', //单页
            'fragment', //碎片
        ];
    }

    /**
     * 获取所有Meta元数据
     *
     * @param  string $type 元模型类型 分类category,标签tag
     * @return Illuminate\Support\Collection
     */
    public function meta($type = 'category')
    {
        if ($type === 'tag') {
            $metas = $this->meta->tag()->get();
        } else {
            $metas = $this->meta->category()->get();
        }
        return $metas;
    }

    /**
     * 获取特定slug碎片
     *
     * @param  string $slug 碎片slug
     * @return Illuminate\Support\Collection
     */
    public function fragment($slug)
    {
        return $this->model->where('slug', '=', e($slug))->fragment()->first();
    }

    /**
     * 创建或更新内容
     *
     * @param  Douyasi\Models\Content $content
     * @param  array $inputs
     * @param  string $type
     * @param  string|int $user_id
     * @return Douyasi\Models\Content
     */
    private function saveContent($content, $inputs, $type = 'article', $user_id = '0')
    {
        $content->title   = e($inputs['title']);
        $content->content = e($inputs['content']);
        $content->thumb   = e($inputs['thumb']);
        if ($type === 'article') {
            $content->category_id = e($inputs['category_id']);
            $content->type        = 'article';
            $tmp_flag = '';
            /*这里需要对推荐位flag进行处理*/
            if(!empty($inputs['flag']) && is_array($inputs['flag'])) {
                foreach($inputs['flag'] as $flag)
                {
                    if(!empty($flag)){
                        $tmp_flag .= $flag.',';
                    }
                }
                $content->flag = $tmp_flag;
            }
        } elseif ($type === 'page') {
            $content->category_id = 0;
            $content->type        = 'page';
        } elseif ($type === 'fragment') {
            $content->category_id = 0;
            $content->type        = 'fragment';
        }
        if (array_key_exists('is_top', $inputs)) {
            $content->is_top = e($inputs['is_top']);
        }
        if (array_key_exists('outer_link', $inputs)) {
            $content->outer_link = trim(e($inputs['outer_link']));
        }
        if (array_key_exists('slug', $inputs)) {
            $content->slug = e($inputs['slug']) ;
        }
        if ($user_id) {
            $content->user_id = $user_id;
        }

        $content->save();

        return $content;
    }


    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 内容资源列表数据
     *
     * @param  array $data
     * @param  string $type 内容模型类型 文章article,单页page,碎片fragment
     * @param  string $size 分页大小
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $type = 'article', $size = '10')
    {
        if (!ctype_digit($size)) {
            $size = '10';
        }
        if ($type === 'page') {
            $data = array_add($data, 's_title', '');
            $ret = $this->model->page()
                                ->where('title', 'like', '%'.e($data['s_title']).'%')
                                ->paginate($size);
        } elseif ($type === 'fragment') {
            $data = array_add($data, 's_title', '');
            $data = array_add($data, 's_slug', '');
            $ret = $this->model->fragment()
                                ->where('title', 'like', '%'.e($data['s_title']).'%')
                                ->where('slug', 'like', '%'.e($data['s_slug']).'%')
                                ->paginate($size);
        } else {
            $data = array_add($data, 's_title', '');
            $ret = $this->model->article()
                                ->where('title', 'like', '%'.e($data['s_title']).'%')
                                ->with(array('meta'=>function ($query) {
                                    $query->where('type', '=', 'CATEGORY');
                                }))
                                ->paginate($size);
        }
        return $ret;
    }

    /**
     * 存储内容
     *
     * @param  array $inputs
     * @param  string $type 内容模型类型 文章article,单页page,碎片fragment
     * @param  string|int $user_id 管理用户id
     * @return Douyasi\Models\Content
     */
    public function store($inputs, $type = 'article', $user_id = '0')
    {
        $content = new $this->model;
        $types = $this->getModelTypes();
        if (in_array($type, $types)) {
            $content = $this->saveContent($content, $inputs, $type, $user_id);
        }
        return $content;
    }

    /**
     * 获取编辑的内容
     *
     * @param  int $id
     * @param  string $type 内容模型类型 文章article,单页page,碎片fragment
     * @return Illuminate\Support\Collection
     */
    public function edit($id, $type = 'article')
    {
        if ($type === 'page') {
            $content = $this->model->page()->findOrFail($id);
        } elseif ($type === 'fragment') {
            $content = $this->model->fragment()->findOrFail($id);
        } else {
            $content = $this->model->article()->findOrFail($id);
        }
        return $content;
    }

    /**
     * 更新内容
     *
     * @param  int $id
     * @param  array $inputs
     * @param  string $type 内容模型类型 文章article,单页page,碎片fragment
     * @return void
     */
    public function update($id, $inputs, $type = 'article')
    {
        if ($type === 'page') {
            $content = $this->model->page()->findOrFail($id);
            $content = $this->saveContent($content, $inputs, 'page');
        } elseif ($type === 'fragment') {
            $content = $this->model->fragment()->findOrFail($id);
            $content = $this->saveContent($content, $inputs, 'fragment');
        } else {
            $content = $this->model->article()->findOrFail($id);
            $content = $this->saveContent($content, $inputs, 'article');
        }
    }

    /**
     * 删除内容
     *
     * @param  int $id
     * @param  string $type 内容模型类型 文章article,单页page,碎片fragment
     * @return void
     */
    public function destroy($id, $type = 'article')
    {
        if ($type === 'page') {
            $content = $this->model->page()->findOrFail($id);
        } elseif ($type === 'fragment') {
            $content = $this->model->fragment()->findOrFail($id);
        } else {
            $content = $this->model->article()->findOrFail($id);
        }
        $content->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
