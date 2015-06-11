@extends('layout._back')

@section('content-header')
@parent
          <h1>
            系统管理
            <small>动态设置</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ route('admin.page.index') }}">系统管理 - 动态设置</a></li>
            <li class="active">新增动态设置</li>
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

              <h2 class="page-header">新增动态设置</h2>
              <form method="post" action="{{ route('admin.setting.store') }}" accept-charset="utf-8">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>动态设置名 <small class="text-red">*</small> <span class="text-green small">只能数字、字母、下划线与横杠（0-9a-zA-Z_-）组合</span></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name') }}" placeholder="动态设置名">
                      </div>
                      <div class="form-group">
                        <label>动态设置值 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="value" value="{{ Input::old('value') }}" placeholder="动态设置值">
                      </div>
                      <div class="form-group">
                        <label>动态设置分组 <small class="text-red">*</small></label>
                        <div class="input-group">
                          <select data-placeholder="选择动态设置分组" class="chosen-select" style="min-width:200px;" name="type_id">
                          @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ ($type->id == Input::get('s_tid','1')) ? 'selected':'' }}>{{ $type->value }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">新增动态设置</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>

@stop


@section('extraPlugin')

  <!--引入Chosen组件-->
  @include('scripts.endChosen')

@stop



