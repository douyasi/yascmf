@extends('layout._base')

@section('hacker_header')
        <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
@stop

@section('title') 注册 - YASCMF @stop

@section('meta')
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
@stop

@section('head_css')
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="{{ asset('lib/font-awesome/4.3.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="{{ asset('lib/ionicons/2.0.1/css/ionicons.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ asset('dist/css/yascmf.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
    <!--
    <link href="{{ asset('dist/css/skins/skin-black.min.css') }}" rel="stylesheet" type="text/css" />
    -->
    <link href="{{ asset('plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css"/>
    <!--layer css-->
    <link href="{{ asset('plugins/layer/skin/layer.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/layer/skin/layer.ext.css') }}" rel="stylesheet" type="text/css"/>
    <!--validation-->>
    <link href="{{ asset('plugins/formvalidation/css/formValidation.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/layer/skin/layer.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/layer/skin/layer.ext.css') }}" rel="stylesheet" type="text/css"/>
    <!--validation-->>
    <link href="{{ asset('plugins/formvalidation/css/formValidation.min.css') }}" rel="stylesheet" type="text/css"/>

    @stop

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

@section('body_attr') class="register-page"@stop

@section('body')

    <div class="register-box">
        <div class="login-logo">
            <a href="#"><b>YAS</b>CMF</a>
        </div><!-- /.login-logo -->
        <div class="register-box-body">
            <p class="register-box-msg">注册开始BLOG之旅</p>
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> 警告!</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(array('route' => 'register', 'method' => 'post','id'=>'defaultForm')) !!}
            <div class="form-group has-feedback">
                <label class="control-label">用户名</label>
                <input type="text" class="form-control" maxlength="20" name="username" placeholder="用户名"
                       value="{{ Input::old('username') }}" autocomplete="off"/>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" maxlength="20" name="password" placeholder="登录密码"/>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" maxlength="20" name="password_confirmation"
                       placeholder="请再次输入登录密码"/>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" maxlength="40" name="email" placeholder="电子邮箱"
                       value="{{ Input::old('email') }}" autocomplete="off"/>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" maxlength="20" name="nickname" placeholder="昵称"
                       autocomplete="off" value="{{ Input::old('nickname') }}"/>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" maxlength="20" name="realname" placeholder="姓名"
                       autocomplete="off" value="{{ Input::old('realname') }}"/>
                <p>{!! $errors->first('attempt') !!}</p>
            </div>
            @endif
            {!! Form::open(array('route' => 'login', 'method' => 'post')) !!}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" maxlength="20" name="username" placeholder="用户名"
                       autocomplete="off"/>
                {!! Form::open(array('route' => 'register', 'method' => 'post')) !!}
                <div class="form-group has-feedback">
                    <label class="control-label">用户名</label>
                    <input type="text" class="form-control" maxlength="20" name="username" placeholder="用户名"
                           value="{{ Input::old('username') }}" autocomplete="off"/>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" maxlength="20" name="password" placeholder="登录密码"/>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" maxlength="20" name="password_confirmation"
                           placeholder="请再次输入登录密码"/>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" maxlength="40" name="email" placeholder="电子邮箱"
                           autocomplete="off"/>
                    <span class="glyphicon glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" maxlength="20" name="nickname" placeholder="昵称"
                           autocomplete="off"/>
                <span class="glyphicon glyphicon glyphicon glyphicon-info-sign form-control-feedback layer_msg"
                      data-msg="这将显示到你的个人资料中"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" maxlength="20" name="realname" placeholder="姓名"
                           autocomplete="off"/>
                    <input type="text" class="form-control" maxlength="40" name="email" placeholder="电子邮箱"
                           value="{{ Input::old('email') }}" autocomplete="off"/>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" maxlength="20" name="nickname" placeholder="昵称"
                           autocomplete="off" value="{{ Input::old('nickname') }}"/>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" maxlength="20" name="realname" placeholder="姓名"
                           autocomplete="off" value="{{ Input::old('realname') }}"/>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat ">注册</button>
                    </div><!-- /.col -->
                </div>
                {!! Form::close() !!}
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
    </div><!-- /.login-box -->
    @stop

    @section('afterBody')

            <!-- jQuery 2.1.3 -->
    <script src="{{ asset('plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <!--layer api-->
    <script src="{{ asset('plugins/layer/layer.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/layer/extend/layer.ext.js') }}" type="text/javascript"></script>
    <!--formValidation -->
    <script src="{{ asset('plugins/formvalidation/js/formValidation.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/formvalidation/js/framework/bootstrap.js')}}" type="text/javascript"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            $("input[name='nickname']").hover(function () {
                var msg = $('.layer_msg').data('msg');
                layer.tips(msg, "input[name='nickname']");
            }, function () {
                layer.closeAll();
            });
            $('#defaultForm').formValidation({
                message: 'This value is not valid',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: '用户名必填'
                            }
                        }
                    }
                }
            });
        });
        $("input[name='nickname']").hover(function () {
            var msg = $('.layer_msg').data('msg');
            layer.tips(msg, "input[name='nickname']");
        }, function () {
            layer.closeAll();
        });
    </script>
@stop

@section('hacker_footer')
@stop
