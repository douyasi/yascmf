@extends('layout._base')

@section('hacker_header')
<!--
 __     __         _____   _____  __  __  ______ 
 \ \   / / /\     / ____| / ____||  \/  ||  ____|
  \ \_/ / /  \   | (___  | |     | \  / || |__   
   \   / / /\ \   \___ \ | |     | |\/| ||  __|  
    | | / ____ \  ____) || |____ | |  | || |     
    |_|/_/    \_\|_____/  \_____||_|  |_||_|     
                                                 
    ASCII text from http://patorjk.com/software/taag/#p=display&h=1&v=0&f=Big&t=YASCMF
    Template from https://almsaeedstudio.com/
    modified by raoyc<raoyc2009@gmail.com>
-->
@stop

@section('title') 后台 - YASCMF @stop

@section('meta')
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('head_css')
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('lib/font-awesome/4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset('lib/ionicons/2.0.1/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('dist/css/yascmf.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
    <!--
    <link href="{{ asset('dist/css/skins/skin-black.min.css') }}" rel="stylesheet" type="text/css" />
    -->
    <link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
    <!--
    <link href="{{ asset('plugins/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
    -->
@stop

@section('head_js')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="{{ asset('lib/html5shiv/3.7.2/html5shiv.js') }}"></script>
        <script src="{{ asset('lib/respond.js/1.4.2/respond.min.js') }}"></script>
    <![endif]-->
@parent
@stop

@section('body_attr') class="skin-black sidebar-mini"@stop

@section('body')

<!--侦测是否启用JavaScript脚本-->
<noscript>
<style type="text/css">
.noscript{ width:100%;height:100%;overflow:hidden;background:#000;color:#fff;position:absolute;z-index:99999999; background-color:#000;opacity:1.0;filter:alpha(opacity=100);margin:0 auto;top:0;left:0;}
.noscript h1{font-size:36px;margin-top:50px;text-align:center;line-height:40px;}
html {overflow-x:hidden;overflow-y:hidden;}/*禁止出现滚动条*/
</style>
<div class="noscript">
<h1>
您的浏览器不支持JavaScript，请启用后重试！
</h1>
</div>
</noscript>

<!--wrapper start-->
    <div class="wrapper">

      @include('widgets.main-header')

      @include('widgets.main-sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          @section('content-header')
          @show{{-- 内容导航头部 --}}

        </section>

        <!-- Main content -->
        <section class="content">

          @section('content')
          @show{{-- 内容主体区域 --}}

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          后台模版基于 <a href="https://github.com/almasaeed2010/AdminLTE">AdminLTE</a> ， 经过 <a href="http://raoyc.com">raoyc</a> 修改以适配当前系统 。
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2011-{{ date('Y') }} <a href="{{ Cache::get('system_author_website', 'http://douyasi.com') }}">{{ Cache::get('system_author','豆芽丝') }}</a></strong>  芽丝内容管理框架(<code>YASCMF</code>)  版本: v1.0
      </footer>

@stop

@section('afterBody')
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">

        @include('widgets.control-sidebar')

      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/app.min.js') }}" type="text/javascript"></script>

    <!-- Slimscroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    
    @section('extraPlugin')
    @show{{-- 引入额外依赖JS插件 --}}

    
    <script type="text/javascript">
      $(document).ready(function(){
          <!--highlight main-sidebar-->
          {{-- URL::current() --}}
          {{-- Route::currentRouteName() --}}

          $('ul.treeview-menu>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('li').addClass('active');  //二级链接高亮
          $('ul.treeview-menu>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('li.treeview').addClass('active');  //一级栏目[含二级链接]高亮
          $('.sidebar-menu>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('li').addClass('active');  //一级栏目[不含二级链接]高亮

          @section('filledScript')
          @show{{-- 在document ready 里面填充一些JS代码 --}}
      });
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/yascmf.js') }}" type="text/javascript"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->

      @section('extraSection')
      @show{{-- 补充额外的一些东东，不一定是JS，可能是HTML --}}

@stop


@section('hacker_footer')
<!--
______                            _              _                                     _
| ___ \                          | |            | |                                   | |
| |_/ /___ __      __ ___  _ __  | |__   _   _  | |      __ _  _ __  __ _ __   __ ___ | |
|  __// _ \\ \ /\ / // _ \| '__| | '_ \ | | | | | |     / _` || '__|/ _` |\ \ / // _ \| |
| |  | (_) |\ V  V /|  __/| |    | |_) || |_| | | |____| (_| || |  | (_| | \ V /|  __/| |
\_|   \___/  \_/\_/  \___||_|    |_.__/  \__, | \_____/ \__,_||_|   \__,_|  \_/  \___||_|
                                          __/ |
                                         |___/
-->
@stop
