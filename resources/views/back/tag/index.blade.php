@extends('layout._back')

@section('content-header')
    @parent
    <h1>
        标签
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">标签</li>
    </ol>
@stop

@section('content')
    <a href="{{ route('admin.tag.create') }}" class="btn btn-primary margin-bottom">添加新标签</a>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> 提示！</h4>
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">标签列表</h3>
            <div class="box-tools">
                <form action="{{ route('admin.tag.index') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_name"
                               value="{{ Input::get('s_name') }}" style="width: 150px;" placeholder="搜索标签名">
                        <h3 class="box-title">文章标签列表</h3>
                        <div class="box-tools">
                            <form action="{{ route('admin.tag.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm pull-right" name="s_name"
                                           value="{{ Input::get('s_name') }}" style="width: 150px;" placeholder="搜索标签名">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-hover table-bordered">
                            <tbody>
                            <!--tr-th start-->
                            <tr>
                                <th>操作</th>
                                <th>编号</th>
                                <th>标签名</th>
                                <th>标签Logo</th>
                            </tr>
                            <!--tr-th end-->
                            @foreach ($article_tag as $tag)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.tag.index') }}/{{ $tag->id }}/edit"><i
                                                    class="fa fa-fw fa-pencil" title="修改"></i></a>
                                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item"
                                                                         title="删除" data-id="{{ $tag->id }}"></i></a>
                                    </td>
                                    <td>{{ $tag->id }}</td>
                                    <td class="text-muted">{{ $tag->tag_name}}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="previewPic" data-id="thumb{{$tag->id}}">
                                            <i class="fa fa-fw fa-eye" title="预览小图"></i>
                                            <li id="thumb{{$tag->id}}" style="display: none"
                                                value="{{$tag->tag_ico}}"></li>
                                        </a>
                                    </td>
                                    <td>{{ $tag->id }}</td>
                                    <td class="text-muted">{{ $tag->tag_name}}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="previewPic" data-id="thumb{{$tag->id}}">
                                            <i class="fa fa-fw fa-eye" title="预览小图"></i>
                                            <li id="thumb{{$tag->id}}" style="display: none"
                                                value="{{$tag->tag_ico}}"></li>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div id="layerPreviewPic" class="fn-hide">

                    </div>
                    <div class="box-footer clearfix">
                        {!! $article_tag->render() !!}
                    </div>

                    <!--隐藏型删除表单-->
                    {!! Form::open( array('url' => route('admin.tag.index'), 'method' => 'delete', 'id' => 'hidden-delete-form') ) !!}
                    {!! Form::close() !!}
                    <div class="box-footer clearfix">
                        {!! $article_tag->render() !!}
                    </div>

                    <!--隐藏型删除表单-->
                {!! Form::open( array('url' => route('admin.tag.index'), 'method' => 'delete', 'id' => 'hidden-delete-form') ) !!}
                {!! Form::close() !!}

            </div>
            @stop


        </div>
        @stop


        @stop
        @section('extraPlugin')

                <!--引入Layer组件-->
        <script src="{{ asset('plugins/layer/layer.min.js') }}"></script>
        <script src="{{ asset('static/js/bootbox.min.js') }}"></script>
        <!--引入iCheck组件-->
        <!--引入Chosen组件-->
        @include('scripts.endChosen')

        @stop


        @section('filledScript')
            @include('scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}

            $('.delete_item').click(function() {
            bootbox.confirm({
            message:  '确定删除该标签么?',
            locale:'zh_CN',
            callback: function (result) {
            if(result){
            var action = '{{ route('admin.tag.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
            }
            }
            })
            });
@stop