@extends('layout._front')

@section('bootstrapContent')
@parent

<div class="container" id="content">
    @inject('article_service', 'Douyasi\Services\ArticleService') {{-- Blade模版里面服务注入 Laravel 5.1 LTS 新增功能 --}}
    <!-- 面包屑导航 -->
    <ul class="breadcrumb">
        <li><a href="{{{ route('home') }}}">首页</a></li>
        <li><a href="{{{ $article_service->getCategorySlug($category->slug, $category->id) }}}"><strong>{{{ $category->name }}}</strong></a></li>
        <li class="active">文章列表</li>
    </ul>

    <div class="row">

        <div class="col-lg-8 col-md-7 col-sm-6">

            <h2>{{ $category->name }}</h2>
            <div class="well well-sm">
                <strong>{{ $category->name }}</strong>  分类下共有 <em class="text-info">{{ $articles->count() }}</em> 篇文章
            </div>

            <div class="list-group">
                @foreach($articles as $art)
                <a href="{{ $article_service->getArticleSlug($art->slug, $art->id, $art->meta->slug, $art->meta->id) }}" class="list-group-item">{{ $art->title }}</a>
                @endforeach
            </div>

            <!-- 分页 -->
            {!! $articles->render() !!}

        </div>
        
        <div class="col-lg-4 col-md-5 col-sm-6">
            <h3>分类</h3>
            <!--
            <div class="well well-sm">
                本博客共有 <strong>3</strong>  个分类
            </div>
            -->
            @include('widgets.bootstrapCategory'){{-- 前台bootstra分类导航 --}}
        </div>

    </div>

</div>




@stop
