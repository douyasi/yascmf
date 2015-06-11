<?php

namespace Douyasi\Repositories;

use Douyasi\Models\Content;
use Douyasi\Models\Meta;

/**
 * 元仓库MetaRepository
 * “Meta”中国大陆一般译为“元”，表示那些对主体事物起到辅助性描述的信息，这里我们把内容的“分类”与“标签”作为元信息
 * 当前“标签”功能暂未完善
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class MetaRepository extends BaseRepository
{

    /**
     * The Content instance.
     *
     * @var Douyasi\Models\Content
     */
    protected $content;

    /**
     * Create a new MetaRepository instance.
     *
     * @param  Douyasi\Models\Meta $meta
     * @param  Douyasi\Models\Content $content
     * @return void
     */
    public function __construct(
        Meta $meta,
        Content $content)
    {
        $this->model = $meta;
        $this->content = $content;
    }

    /**
     * 获取元模型所有类型
     *
     * @return array
     */
    private function getModelTypes()
    {
        return [
            'category', //分类
            'tag', //标签
        ];
    }

    /**
     * 获取所有Meta元数据
     *
     * @param  string $type 元模型类型 分类category,标签tag
     * @return Illuminate\Support\Collection
     */
    public function all($type = 'category')
    {
        if ($type === 'tag') {
            $metas = $this->model->tag()->get();
        } else {
            $metas = $this->model->category()->get();
        }
        return $metas;
    }

    /**
     * 创建或更新Meta分类
     *
     * @param  Douyasi\Models\Meta $meta
     * @param  array $inputs
     * @return Douyasi\Models\Meta
     */
    private function saveCategory($meta, $inputs)
    {
        $meta->name              = e($inputs['name']);
        $meta->description       = e($inputs['description']);
        $meta->type              = 'category';
        if (array_key_exists('slug', $inputs)) {
            $meta->slug = e($inputs['slug']) ;
        }
        $meta->save();
        return $meta;
    }

    /**
     * 侦测当前元（分类|标签）是否有内容（文章|单页）在所使用
     *
     * @param  string $type 元模型类型 分类category,标签tag
     * @param  int $id
     * @return boolean 如果元被内容所使用，则返回true，否则返回false
     */
    public function hasContent($type = 'category', $id)
    {
        if ($type === 'tag') {
            return true;
        } else {
            $content = $this->content->article()->where('category_id', '=', $id)->get();
            if ($content->isEmpty()) {
                return false;
            } else {
                return true;
            }
        }
    }

    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 元资源列表数据
     * 注：暂使用all()返回所有元数据，不进行分页与搜索处理
     *
     * @param  array $data
     * @param  string $type 元类型 分类category,标签tag
     * @param  string $size 分页大小
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $type = 'category', $size = '10')
    {
        return $this->all($type);
    }

    /**
     * 存储元(Meta)
     *
     * @param  array $inputs
     * @param  string $type 元模型类型 分类category,标签tag
     * @return Douyasi\Models\Meta
     */
    public function store($inputs, $type = 'category')
    {
        if ($type === 'category') {
            $meta = new $this->model;
            $meta = $this->saveCategory($meta, $inputs);
        }
        return $meta;
    }

    /**
     * 获取编辑的元(Meta)
     *
     * @param  int $id
     * @param  string $type 元模型类型 分类category,标签tag
     * @return Illuminate\Support\Collection
     */
    public function edit($id, $type = 'category')
    {
        if ($type === 'tag') {
            $meta = $this->model->tag()->findOrFail($id);
        } else {
            $meta = $this->model->category()->findOrFail($id);
        }
        return $meta;
    }

    /**
     * 更新元(Meta)
     *
     * @param  int $id
     * @param  array $inputs
     * @param  string $type 元模型类型 分类category,标签tag
     * @return void
     */
    public function update($id, $inputs, $type = 'category')
    {
        if ($type === 'category') {
            $meta = $this->model->category()->findOrFail($id);
            $meta = $this->saveCategory($meta, $inputs);
        }
    }

    /**
     * 删除元(Meta)
     *
     * @param  string $type 元模型类型 分类category,标签tag
     * @param  int $id
     * @return void
     */
    public function destroy($id, $type = 'category')
    {
        if ($type === 'tag') {
            $meta = $this->model->tag()->findOrFail($id);
        } else {
            $meta = $this->model->category()->findOrFail($id);
        }
        $meta->delete();
    }
    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
