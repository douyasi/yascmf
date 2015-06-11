@extends('layout._back')

@section('content-header')
@parent
          <h1>
            用户管理
            <small>管理员</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ route('admin.user.index') }}">用户管理 - 管理员</a></li>
            <li class="active">修改管理员</li>
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
                  <h3 class="box-title">修改管理员资料</h3>
                  <p>以下展示ID为1 的管理员个人资料，您可修改昵称、真实姓名与登录密码等信息。登录密码项留空，则不修改登录密码。</p>
                  <div class="basic_info bg-info">
                     <ul>
                        <li>登录名：<span class="text-primary">{{ $user->username }}</span></li>
                        <li>昵称：<span class="text-primary">{{ $user->nickname }}</span></li>
                        <li>真实姓名：<span class="text-primary">{{ $user->realname }}</span></li>
                        <li>电子邮件：<span class="text-primary">{{ $user->email }}</span></li>
                        <li>手机号码：<b>{{ $user->phone }}</b></li>
                        <li>通联地址：<b>{{ $user->address }}</b></li>
                    </ul>
                  </div>
                </div><!-- /.box-header -->

                <form method="post" action="{{ route('admin.user.update', $user->id) }}" accept-charset="utf-8">
                <input name="_method" type="hidden" value="put">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">
                    <div class="form-group">
                      <label>昵称 <small class="text-red">*</small></label>
                      <input type="text" class="form-control" name="nickname" value="{{ Input::old('nickname', isset($user) ? $user->nickname : null) }}" placeholder="昵称">
                    </div>
                    <div class="form-group">
                      <label>真实姓名 <small class="text-red">*</small></label>
                      <input type="text" class="form-control" name="realname" autocomplete="off" value="{{ Input::old('realname', isset($user) ? $user->realname : null) }}" placeholder="真实姓名">
                    </div>

                    <div class="form-group">
                      <label>用户状态：是否锁定 <small class="text-red">*</small></label>
                      <div class="input-group">
                        <input type="radio" name="is_lock" value="0" {{ ($user->is_lock === 0) ? 'checked' : '' }}>
                        <label class="choice" for="radiogroup">否</label>
                        <input type="radio" name="is_lock" value="1" {{ ($user->is_lock === 1) ? 'checked' : '' }}>
                        <label class="choice" for="radiogroup">是</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>角色（用户组） <small class="text-red">*</small></label>
                      <div class="input-group">
                          <select data-placeholder="选择角色（用户组）..." class="chosen-select" style="min-width:200px;" name="role">
                          @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ ($own_role->id === $role->id) ? 'selected':'' }}>{{ (Lang::has('roles.'.$role->name)) ? Lang::get('roles.'.$role->name) : ''}}({{ $role->name }})</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>登录密码</label>
                      <input type="password" class="form-control" name="password" value="" autocomplete="off" placeholder="登录密码">
                    </div>
                    <div class="form-group">
                      <label>确认登录密码</label>
                      <input type="password" class="form-control" name="password_confirmation" value="" autocomplete="off" placeholder="登录密码">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">修改个人资料</button>
                  </div>
                </form>

              </div>

@stop


@section('extraPlugin')

  <!--引入iCheck组件-->
  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
  <!--引入Chosen组件-->
  @include('scripts.endChosen')

@stop


@section('filledScript')
        <!--启用iCheck响应checkbox与radio表单控件-->
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-blue',
          increaseArea: '20%' // optional
        });
@stop
