            <!-- bootstrap 分类 widget -->
            <ul class="list-group">
            @if(empty($categories))
                <li class="list-group-item">暂无分类</li>
            @else
                @foreach ($categories as $rCat)
                <li class="list-group-item">
                    <span class="badge">{{ $rCat['count'] }}</span>
                    <a href="{{ get_category_slug($rCat['category']->slug, $rCat['category']->id) }}">{{ $rCat['category']->name }}</a>
                </li>
                @endforeach
            @endif
            </ul>
