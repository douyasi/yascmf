    
    <!-- 前台bootstrap头部导航 -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand">{{ Cache::get('website_title','芽丝博客') }}</a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main" aria-expanded="true">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main" aria-expanded="true" style="">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">首页</a>
                    @inject('article_service', 'Douyasi\Services\ArticleService') {{-- Blade模版里面服务注入 Laravel 5.1 LTS 新增功能 --}}
                    @foreach($topPage as $tPage)
                    <li>
                        <a href="{{ $article_service->getPageSlug($tPage->slug, $tPage->id) }}">{{ $tPage->title }}</a>
                    </li>
                    @endforeach
                    <li><a href="{{ route('archive') }}">归档</a>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download" aria-expanded="false">下载 <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="download">
                            <li><a href="https://github.com/douyasi/yascmf">yascmf源码</a></li>
                            <li class="divider"></li>
                            <li><a href="http://www.yas.so/docs">yascmf手册</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <!--<li><a href="#" target="_blank">芽丝官网</a></li>-->
                    @if(Auth::check())
                        <li><a href="{{ route('admin') }}">后台</a></li>
                        <li><a href="{{ route('logout') }}">退出</a></li>
                    @else
                        <li><a href="{{ route('login') }}">登录</a></li>
                    @endif
                </ul>

            </div>
        </div>
    </div>
