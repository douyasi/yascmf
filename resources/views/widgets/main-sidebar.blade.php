{{-- widget.main-sidebar --}}

        <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/20150417113714.jpg') }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{{ user('realname') }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">主导航栏</li>

            <!--含子节点 且当前状态为active 的一级导航节点-->
            <!--控制台 active treeview-->
            @foreach(Cache::get('SideBar'.user('id')) as $k=>$v)
                @if(isset($v[0]))
                    <li class="treeview">
                        <a href="#">
                            <i class="{{$v['icon']}}"></i>
                            <span>{{$k}}</span>
                            <i class="{{$v['message_class']}}">{{$v['notice']}}</i>
                        </a>
                        <ul class="treeview-menu">
                            @foreach($v as $key=>$value)
                                @if( is_array($value))
                                    <li><a href="{{ route($value['route']) }}"><i
                                                    class="{{$value['icon']}}"></i> {{$value['menu_name']}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @else
                            <!--无子节点的一级导航节点-->
                    <li><a href="{{ route($v['route']) }}"><i class='{{$v['icon']}}'></i>
                            <span>{{$v['menu_name']}}</span></a></li>
                @endif
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i>
                        <span>{{$k}}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($v as $key=>$value)
                            <li><a href="{{ route($value['route']) }}"><i
                                            class="fa fa-circle-o"></i> {{$value['menu_name']}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
                        <!--//控制台 active treeview-->

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
