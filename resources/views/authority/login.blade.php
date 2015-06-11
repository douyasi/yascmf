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

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
@stop

@section('title') 登录 - YASCMF @stop

@section('meta')
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
    <link href="{{ asset('plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
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

@section('body_attr') class="login-page"@stop

@section('body')

    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>YAS</b>CMF</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">登录开始您的会话</p>
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> 警告!</h4>
            <p>{!! $errors->first('attempt') !!}</p>
        </div>
        @endif

        <form method="post" action="{{ route('login') }}" accept-charset="utf-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" maxlength="20" name="username" placeholder="用户名"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" maxlength="20" name="password" placeholder="登录密码"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="remember"> 记住我
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
            </div><!-- /.col -->
          </div>
        </form>


        <div class="social-auth-links text-center">
          <p>- 或 -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>使用Facebook帐号登录</a>
          <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i>使用Google+帐号登录</a>
        </div><!-- /.social-auth-links -->

        <a href="#">忘记密码</a><br>
        <a href="#" class="text-center">注册</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('afterBody')

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
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
