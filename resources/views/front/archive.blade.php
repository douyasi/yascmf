@extends('layout._front')

@section('bootstrapContent')
@parent

<div class="container" id="content">
    <!-- 面包屑导航 -->
    <ul class="breadcrumb">
        <li><a href="{{ route('home') }}">首页</a></li>
        <li class="active">归档</li>
    </ul>

    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
            <h2>归档</h2>

            <!-- 按发表年月做出归档START -->
        @if(empty($archives))
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ date('Y-m') }}</h3>
                </div>
                <div class="panel-body">
                    笔者太懒了，一篇文章都没有，大家一起鄙视TA
                </div>
            </div>
        @else
            @foreach($archives as $archive)
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $archive['year_month'] }}</h3>
                </div>
                <div class="panel-body">
                    共发布 <strong>{{ $archive['count'] }}</strong> 文章
                </div>
                <div class="list-group">
                    @inject('article_service', 'Douyasi\Services\ArticleService') {{-- Blade模版里面服务注入 Laravel 5.1 LTS 新增功能 --}}
                    @foreach($archive['articles'] as $art)
                    <a href="{{ $article_service->getArticleSlug($art->slug, $art->id, $art->c_slug, $art->c_id) }}" class="list-group-item">{{ $art->title }}</a>
                    @endforeach
                </div>
            </div>
            @endforeach
        @endif
            <!-- 按发表年月做出归档END -->
        </div>
        
        <div class="col-lg-4 col-md-5 col-sm-6">
            <h2>分类与标签</h2>

            <!-- 分类START -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">分类</h3>
                </div>
                <div class="panel-body">
                    共有  <strong>3</strong>  个文章分类
                </div>
                @include('widgets.bootstrapCategory'){{-- 前台bootstra分类导航 --}}
            </div>
            <!-- 分类END -->
            
            <!-- 标签 -->

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">标签</h3>
                </div>
                <div class="panel-body">
                    共有  <strong>0</strong>  个标签 (标签功能暂未完善)
                    <!--
                    <div class="yas_tags">
                        <a href="#" class="label label-primary">Laravel</a>
                        <a href="#" class="label label-success">新浪</a>
                        <a href="#" class="label label-info">Javascript</a>
                        <a href="#" class="label label-warning">ORM</a>
                        <a href="#" class="label label-danger">阿狸</a>
                        <a href="#" class="label label-info">php</a>
                        <a href="#" class="label label-primary">HTML5</a>
                        
                        <a href="#" class="label label-success">新浪</a>
                        <a href="#" class="label label-info">Javascript</a>
                        <a href="#" class="label label-warning">ORM</a>
                    </div>
                    -->
                </div>
            </div>
            <!-- 标签END -->

        </div>
    </div>
    
</div>

@stop
