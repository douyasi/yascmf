@extends('layout._back')

@section('content-header')
@parent
          <h1>
            内容管理
            <small>分类</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ route('admin.category.index') }}">内容管理 - 分类</a></li>
            <li class="active">新增分类</li>
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

              <h2 class="page-header">新增分类</h2>
              <form method="post" action="{{ route('admin.category.store') }}" accept-charset="utf-8">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>分类名称 <small class="text-red">*</small> <span class="text-green small">简短为宜</span></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name') }}" placeholder="分类名称" maxlength="20">
                      </div>
                      <div class="form-group">
                        <label>分类描述 <small class="text-red">*</small> <span class="text-green small">建议百字以内，有助于网站SEO</span></label>
                        <textarea class="form-control" name="description" cols="45" rows="2" maxlength="200" placeholder="分类描述">{{ Input::old('description') }}</textarea>
                      </div>
                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">新增分类</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>
@stop
