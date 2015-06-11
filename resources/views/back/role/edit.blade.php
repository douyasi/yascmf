@extends('layout._back')

@section('content-header')
@parent
          <h1>
            用户管理
            <small>角色</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ route('admin.role.index') }}">用户管理 - 角色</a></li>
            <li class="active">修改角色</li>
          </ol>
@stop

@section('content')

          @if(Session::has('fail'))
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4>  <i class="icon icon fa fa-warning"></i> 提示！</h4>
              {{ Session::get('fail') }}
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

              <h2 class="page-header">修改角色</h2>
              <form method="post" action="{{ route('admin.role.update', $role->id) }}" accept-charset="utf-8">
              <input name="_method" type="hidden" value="put">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>角色(用户组)名 <small class="text-red">*</small>  <span class="text-green small">只能为英文单词，建议首字母大写</span></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name', isset($role) ? $role->name : null) }}" placeholder="角色(用户组)名">
                      </div>
                      <div class="form-group">
                        <label>角色(用户组)展示名 <small class="text-red">*</small> <span class="text-green small">展示名可以为中文</span></label>
                        <input type="text" class="form-control" name="display_name" autocomplete="off" value="{{ Input::old('display_name', isset($role) ? $role->display_name : null) }}" placeholder="角色(用户组)展示名">
                      </div>
                      <div class="form-group">
                        <label>角色(用户组)描述</label>
                        <textarea class="form-control" name="description" cols="45" rows="2" maxlength="200" placeholder="角色(用户组)描述" autocomplete="off">{{ Input::old('description', isset($role) ? $role->description : null) }}</textarea>
                      </div>
                      <div class="form-group">
                        <label>关联权限 <small class="text-red">*</small></label>
                        <div class="input-group">
                          @foreach($permissions as $per)
                          <input type="checkbox" name="permissions[]" value="{{ $per->id }}" {{ ( check_array($cans,'id', $per->id) === true) ? 'checked' : '' }}>
                          <label class="choice" for="permissions[]">{{ $per->display_name }}</label>
                          @endforeach
                        </div>
                      </div>
                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">修改角色</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>

@stop

@section('extraPlugin')

  <!--引入iCheck组件-->
  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

@stop


@section('filledScript')
        <!--启用iCheck响应checkbox与radio表单控件-->
        $('input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          increaseArea: '20%' // optional
        });
@stop
