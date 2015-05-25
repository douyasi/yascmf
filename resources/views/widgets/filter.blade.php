<div class="filter_wrap">
    <fieldset class="filter_header">
        <ul class="filter_ul">
            <li>所有分类 ></li>
            @if(FilterManager::has('gender'))
                <li class="selected">类别：{{FilterManager::has('gender')}}&nbsp;
                    <a href="{{FilterManager::url('gender',\Toplan\FilterManager\FilterManager::ALL)}}" type="button" class="close">×</a>
                </li>
            @endif
            @if(FilterManager::has('weekdays'))
                <li class="selected">星期：{{FilterManager::has('weekdays')}}&nbsp;
                    <a href="{{FilterManager::url('gender',\Toplan\FilterManager\FilterManager::ALL)}}" type="button" class="close">×</a>
                </li>
            @endif
        </ul>
    </fieldset>

    <fieldset class="fieldset">
        <ul class="filter_ul">
            <li>发布时间：</li>
            <li class="item all @if(FilterManager::isActive('weekdays',\Toplan\FilterManager\FilterManager::ALL)) active @endif">
                <a href="{{FilterManager::url('weekdays',\Toplan\FilterManager\FilterManager::ALL)}}">全部</a>
            </li>
            <li class="item @if(FilterManager::isActive('weekdays','1')) active @endif">
                <a href="{{FilterManager::url('weekdays','1',true)}}">
                    <input type="checkbox" {{FilterManager::isActive('weekdays','1','checked','')}} />&nbsp;周一</a>
            </li>
            <li class="item @if(FilterManager::isActive('weekdays','2')) active @endif">
                <a href="{{FilterManager::url('weekdays','2',true)}}">
                    <input type="checkbox" @if(FilterManager::isActive('weekdays','2')) checked @endif />&nbsp;周二</a>
            </li>
            <li class="item @if(FilterManager::isActive('weekdays','3')) active @endif">
                <a href="{{FilterManager::url('weekdays','3',true)}}">
                    <input type="checkbox" @if(FilterManager::isActive('weekdays','3')) checked @endif />&nbsp;周三</a>
            </li>
            <li class="item @if(FilterManager::isActive('weekdays','4')) active @endif">
                <a href="{{FilterManager::url('weekdays','4',true)}}">
                    <input type="checkbox" @if(FilterManager::isActive('weekdays','4')) checked @endif />&nbsp;周四</a>
            </li>
            <li class="item @if(FilterManager::isActive('weekdays','5')) active @endif">
                <a href="{{FilterManager::url('weekdays','5',true)}}">
                    <input type="checkbox" @if(FilterManager::isActive('weekdays','5')) checked @endif />&nbsp;周五</a>
            </li>
            <li class="item @if(FilterManager::isActive('weekdays','6')) active @endif">
                <a href="{{FilterManager::url('weekdays','6',true)}}">
                    <input type="checkbox" @if(FilterManager::isActive('weekdays','6')) checked @endif />&nbsp;周六</a>
            </li>
            <li class="item @if(FilterManager::isActive('weekdays','7')) active @endif">
                <a href="{{FilterManager::url('weekdays','7',true)}}">
                    <input type="checkbox" @if(FilterManager::isActive('weekdays','7')) checked @endif />&nbsp;周日</a>
            </li>
        </ul>
    </fieldset>
    <fieldset class="fieldset">
        <ul class="filter_ul">
            <li>性别：</li>
            <li class="item all {{FilterManager::isActive('gender',\Toplan\FilterManager\FilterManager::ALL,'active','')}}">
                <a href="{{FilterManager::url('gender',\Toplan\FilterManager\FilterManager::ALL)}}">全部</a>
            </li>
            <li class="item @if(FilterManager::isActive('gender','男')) active @endif">
                <a href="{{FilterManager::url('gender','男')}}">男</a>
            </li>
            <li class="item @if(FilterManager::isActive('gender','女')) active @endif">
                <a href="{{FilterManager::url('gender','女')}}">女</a>
            </li>
        </ul>
    </fieldset>
</div>
