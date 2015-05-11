@extends('layout._back')

@section('content-header')
    @parent
    <h1>
        内容管理
        <small>标签</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li><a href="{{ route('admin.tag.index') }}">标签</a></li>
        <li class="active">修改-标签</li>
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

    <h2 class="page-header">修改新标签</h2>
    {!! Form::open( array('url' => route('admin.tag.update',$data->id), 'method' => 'put', 'id' => 'addArticleForm') ) !!}
    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane active" id="tab_1">
                <div class="form-group">
                    <label>标题 <small class="text-red">*</small></label>
                    <input type="text" class="form-control" name="tag_name" autocomplete="off" value="{{ Input::old('tag_name', isset($data) ? $data->tag_name : null) }}" placeholder="标题">
                </div>
                <div class="form-group">
                    <label>缩略图
                        <a href="javascript:void(0);" class="uploadPic" data-id="thumb">
                            <i class="fa fa-fw fa-picture-o" title="上传"></i>
                        </a>
                        <a href="javascript:void(0);" class="previewPic" data-id="thumb">
                            <i class="fa fa-fw fa-eye" title="预览小图"></i>
                        </a>
                    </label>
                    <input type="text" class="form-control" id="thumb" name="tag_ico" value="{{ Input::old('tag_ico', isset($data) ? $data->tag_ico : null) }}" placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png">
                </div>
            </div><!-- /.tab-pane -->
            <button type="submit" class="btn btn-primary">提交</button>

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
    <!--引入Chosen组件-->
    @include('scripts.endChosen')

@stop


@section('filledScript')
    @include('scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
@stop
