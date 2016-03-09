@extends('layout._back')

@section('content-header')
@parent
          <h1>
            内容管理
            <small>文章</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ route('admin.article.index') }}">内容管理 - 文章</a></li>
            <li class="active">修改文章</li>
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

              <h2 class="page-header">修改文章</h2>
              {!! Form::open( array('url' => route('admin.article.update', $data->id), 'method' => 'put', 'id' => 'editArticleForm') ) !!}
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
                  </ul>

                  <div class="tab-content">
                    {{-- 这里需兼顾初次传入，以及提交过未通过的闪存数据 --}}
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>标题 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="title" autocomplete="off" value="{{ Input::old('title', isset($data) ? $data->title : null) }}" placeholder="标题">
                      </div>
                      <div class="form-group">
                        <label>缩略图  <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i class="fa fa-fw fa-eye" title="预览小图"></i></a></label>
                        <input type="text" class="form-control" id="thumb" name="thumb" value="{{ Input::old('thumb', isset($data) ? $data->thumb : null) }}" placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png">
                      </div>
                      <div class="form-group">
                        <label>网址缩略名 <small class="text-red">*</small></label>
                        <div class="input-group mono url_slug">
                          @if(empty($data->slug))
                          <p>{{ url('') }}/{category}/<input type="text" id="slug" name="slug" autocomplete="off" value="{{ $data->id }}" class="slug" maxlength="30" pattern="[A-z0-9_-]+">.html</p>
                          @else
                          <p>{{ url('') }}/{category}/<input type="text" id="slug" name="slug" autocomplete="off" value="{{ $data->slug }}" class="slug" maxlength="30" pattern="[A-z0-9_-]+">.html</p>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label>分类 <small class="text-red">*</small></label>
                        <div class="input-group">
                          <select data-placeholder="选择文章分类..." class="chosen-select" style="min-width:200px;" name="category_id">
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (Input::old('category_id', isset($data) ? $data->category_id : null)  === $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>标签 <small class="text-red">*</small></label>
                        <br>
                        @foreach ($tags as $tag)
                            <label>
                                <input type="checkbox" value="{{$tag->id}}" name="article_tag[]" {{ in_array($tag->id,(Input::old('tag', isset($tag_arr) ? $tag_arr: null))) ? 'checked' : '' }}>{{$tag->tag_name}}
                            </label>
                        @endforeach
                      </div>
                      <div class="form-group">
                        <label>正文 <small class="text-red">*</small></label>
                        <textarea class="form-control" id="ckeditor" name="content">{{ Input::old('content', isset($data) ? $data->content : null) }}</textarea>
                        @include('scripts.endCKEditor'){{-- 引入CKEditor编辑器相关JS依赖 --}}
                      </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                      <div class="form-group">
                        <label>外链地址</label>
                        <input type="text" class="form-control" name="outer_link" value="{{ Input::old('outer_link', isset($data) ? $data->outer_link : null) }}" placeholder="http://example.com/">
                      </div>
                      <div class="form-group">
                        <label>是否置顶 <small class="text-red">*</small></label>
                        <div class="input-group">
                          <input type="radio" name="is_top" value="0" {{ ((isset($data) ? $data->is_top : 0) === 0) ? 'checked' : '' }}>
                          <label class="choice" for="radiogroup">否</label>
                          <input type="radio" name="is_top" value="1" {{ ((isset($data) ? $data->is_top : 0) === 1) ? 'checked' : '' }}>
                          <label class="choice" for="radiogroup">是</label>
                        </div>
                      </div>
                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">修改文章</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              {!! Form::close() !!}
          <div id="layerPreviewPic" class="fn-hide">
            
          </div>

@stop

@section('extraPlugin')

  <!--引入Layer组件-->
  <script src="{{ asset('plugins/layer/layer.min.js') }}"></script>
  <!--引入iCheck组件-->
  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
  <!--引入Chosen组件-->
  @include('scripts.endChosen')

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

        <!--启用iCheck响应checkbox与radio表单控件-->
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-blue',
          increaseArea: '20%' // optional
        });

        @include('scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
@stop
