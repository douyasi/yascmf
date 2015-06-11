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
            <li class="active">修改分类</li>
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

              <h2 class="page-header">修改分类</h2>
              <form method="post" action="{{ route('admin.category.update', $data->id) }}" accept-charset="utf-8">
              <input name="_method" type="hidden" value="put">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>分类名称 <small class="text-red">*</small> <span class="text-green small">简短为宜</span></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ Input::old('name', isset($data) ? $data->name : null) }}" placeholder="分类名称" maxlength="20">
                      </div>
                      <div class="form-group">
                        <label>分类缩略名 <small class="text-red">*</small> <span class="text-green small">用于创建友好的链接形式</span></label>
                        <div class="input-group mono url_slug">
                          @if(empty($data->slug))
                          <input type="text" id="slug" name="slug" autocomplete="off" value="{{ $data->id }}" class="slug" maxlength="10" pattern="[A-z0-9_-]+" placeholder="分类缩略名">
                          @else
                          <input type="text" id="slug" name="slug" autocomplete="off" value="{{ $data->slug }}" class="slug" maxlength="10" pattern="[A-z0-9_-]+" placeholder="分类缩略名">
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label>分类描述 <small class="text-red">*</small> <span class="text-green small">建议百字以内，有助于网站SEO</span></label>
                        <textarea class="form-control" name="description" cols="45" rows="2" maxlength="200" placeholder="分类描述">{{ Input::old('description', isset($data) ? $data->description : null) }}</textarea>
                      </div>
                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">修改分类</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>
@stop


@section('filledScript')
        <!--缩略名自适应宽度 来自typecho-->
        var slug = $('#slug');

        if (slug.length > 0) {
          var sw = slug.width();
          if (slug.val().length > 0) {
            slug.css('width', 'auto').attr('size', slug.val().length);
          }
          slug.bind('input propertychange', function () {
            var t = $(this), l = t.val().length;
            if (l > 0) {
              t.css('width', 'auto').attr('size', l);
            } else {
              t.css('width', sw).removeAttr('size');
            }
          }).width();
        }
@stop
