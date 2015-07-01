@extends('layout._front')

@section('bootstrapContent')

<div class="container" id="content">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
            <ul class="list-unstyled yas_articles">
                <!-- 文章循环START -->
                @inject('article_service', 'Douyasi\Services\ArticleService') {{-- Blade模版里面服务注入 Laravel 5.1 LTS 新增功能 --}}
                @foreach($articles as $art)
                <li class="yas_article_item">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="yas_article_title">
                                <a href="{{ $article_service->getArticleSlug($art->slug, $art->id, $art->meta->slug, $art->meta->id) }}"><h2>{{ $art->title }}</h2></a>
                            </div>
                            <div class="yas_metas yas_tags">
                                <!--标签模型暂未完善-->
                                <!--
                                <p>
                                    <a href="" class="label label-default">Javascript</a>
                                    <a href="#" class="label label-primary">Laravel</a>
                                    <a href="#" class="label label-info">新浪</a>
                                    <a href="#" class="label label-success">Javascript</a>
                                    <a href="#" class="label label-danger">ORM</a>
                                </p>
                                -->
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
                <!-- 文章循环END -->
                
            </ul>
            
            <!--分页-->
            {!! $articles->render() !!}

        </div>

        <!--分类START -->
        <div class="col-lg-4 col-md-5 col-sm-6">
            <!-- 分类，含文章数 -->
            @include('widgets.bootstrapCategory'){{-- 前台bootstra分类导航 --}}
        </div>
        <!--分类END -->

    </div>
</div>
@stop
