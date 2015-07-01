            <!-- bootstrap 分类 widget -->
            <ul class="list-group">
            @if(empty($categories))
                <li class="list-group-item">暂无分类</li>
            @else
                @inject('article_service', 'Douyasi\Services\ArticleService') {{-- Blade模版里面服务注入 Laravel 5.1 LTS 新增功能 --}}
                @foreach ($categories as $rCat)
                <li class="list-group-item">
                    <span class="badge">{{ $rCat['count'] }}</span>
                    <a href="{{ $article_service->getCategorySlug($rCat['category']->slug, $rCat['category']->id) }}">{{ $rCat['category']->name }}</a>
                </li>
                @endforeach
            @endif
            </ul>
