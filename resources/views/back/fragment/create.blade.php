@extends('layout._back')

@section('content-header')
@parent
          <h1>
            内容管理
            <small>碎片</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ route('admin.page.index') }}">内容管理 - 单页</a></li>
            <li class="active">新增碎片</li>
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

              <h2 class="page-header">新增碎片</h2>
              <form method="post" action="{{ route('admin.fragment.store') }}" accept-charset="utf-8">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>标题 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="title" autocomplete="off" value="{{ Input::old('title') }}" placeholder="标题">
                      </div>
                      <div class="form-group">
                        <label>slug（碎片标识符） <small class="text-red">*</small></label>
                        <div class="input-group mono url_slug">
                          <input type="text" id="slug" name="slug" autocomplete="off" value="{{ Input::old('slug') }}" placeholder="slug" class="slug" maxlength="20" pattern="[A-z0-9_-]+">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>缩略图  <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i class="fa fa-fw fa-eye" title="预览小图"></i></a></label>
                        <input type="text" class="form-control" id="thumb" name="thumb" value="{{ Input::old('thumb') }}" placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png">
                      </div>
                      <div class="form-group">
                        <label>正文 <small class="text-red">*</small></label>
                        <textarea class="form-control" id="ckeditor" name="content">{{ Input::old('content') }}</textarea>
                        @include('scripts.endSimpleCKEditor'){{-- 使用简版CKEditor --}}
                      </div>
                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">新增碎片</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>
          <div id="layerPreviewPic" class="fn-hide">
            
          </div>

@stop

@section('extraPlugin')

  <!--引入Layer组件-->
  <script src="{{ asset('plugins/layer/layer.min.js') }}"></script>

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

        @include('scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
@stop
