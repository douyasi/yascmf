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

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">文章标签列表</h3>
            <div class="box-tools">
                <form action="{{ route('admin.tag.index') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_name" value="{{ Input::get('s_name') }}" style="width: 150px;" placeholder="搜索用户登录名或昵称或真实姓名">
                        <input type="text" class="form-control input-sm pull-right" name="s_phone" value="{{ Input::get('s_phone') }}" style="width: 150px;" placeholder="搜索用户手机号">
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
                            <a href="{{ route('admin.tag.index') }}/{{ $tag->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        </td>
                        <td>{{ $tag->id }}</td>
                        <td class="text-muted">{{ $tag->tag_name}}</td>
                        <td class="text-green">
                            {{ $tag->tag_name }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            {!! $article_tag->render() !!}
        </div>

        <!--隐藏型删除表单-->
        {!! Form::open( array('url' => route('admin.tag.index'), 'method' => 'delete', 'id' => 'hidden-delete-form') ) !!}
        {!! Form::close() !!}

    </div>
@stop


@stop
