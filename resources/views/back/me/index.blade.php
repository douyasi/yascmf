@extends('layout._back')

@section('content-header')
@parent
          <h1>
            控制面板
            <small>个人资料</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">控制面板 - 个人资料</li>
          </ol>
@stop

@section('content')

            @if(Session::has('message'))
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                {{ Session::get('message') }}
              </div>
            @endif

            @if($errors->any())
              <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> 警告！</h4>
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
              </div>
            @endif

              <div class="box box-primary">

                <div class="box-header with-border">
                  <h3 class="box-title">修改个人资料</h3>
                  <p>以下为您作为当前用户的个人资料，您仅可修改个人头像、昵称、真实姓名与登录密码。登录密码项留空，则不修改登录密码。</p>
                  <div class="basic_info bg-info">
                     <ul>
                        <li>登录名：<span class="text-primary">{{ $me->username }}</span></li>
                        <li>昵称：<span class="text-primary">{{ $me->nickname }}</span></li>
                        <li>真实姓名：<span class="text-primary">{{ $me->realname }}</span></li>
                        <li>电子邮件：<span class="text-primary">{{ $me->email }}</span></li>
                        <li>手机号码：<b>{{ $me->phone }}</b></li>
                        <li>通联地址：<b>{{ $me->address }}</b></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->

                <form method="post" action="{{ route('admin.me.update') }}" accept-charset="utf-8">
                <input name="_method" type="hidden" value="put">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                    <div class="form-group">
                      <label>昵称 <small class="text-red">*</small></label>
                      <input type="text" class="form-control" name="nickname" value="{{ $me->nickname }}" placeholder="昵称">
                    </div>
                    <div class="form-group">
                      <label>真实姓名 <small class="text-red">*</small></label>
                      <input type="text" class="form-control" name="realname" autocomplete="off" value="{{ $me->realname }}" placeholder="真实姓名">
                    </div>
                    <div class="form-group">
                      <label>登录密码</label>
                      <input type="password" class="form-control" name="password" value="" autocomplete="off" placeholder="登录密码">
                    </div>
                    <div class="form-group">
                      <label>确认登录密码</label>
                      <input type="password" class="form-control" name="password_confirmation" value="" autocomplete="off" placeholder="登录密码">
                    </div>
                    <div class="form-group">
                      <label>手机号码</label>
                      <input type="text" class="form-control" name="phone" value="{{ $me->phone }}" placeholder="手机号码">
                    </div>
                    <div class="form-group">
                      <label>通联地址</label>
                      <input type="text" class="form-control" name="address" value="{{ $me->address }}" placeholder="通联地址">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">修改个人资料</button>
                  </div>
                </form>

              </div>

@stop
