@extends('layout._back')

@section('content-header')
@parent
          <h1>
            系统管理
            <small>动态设置分组</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">系统管理 - 动态设置分组</li>
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

              <a href="{{ route('admin.setting_type.create') }}" class="btn btn-primary margin-bottom">新增动态设置分组</a>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">动态设置分组列表</h3>
                  <div class="box-tools">
                    <form action="{{ route('admin.setting_type.index') }}" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_value" value="{{ Input::get('s_value') }}" style="width: 150px;" placeholder="搜索分组值">
                        <input type="text" class="form-control input-sm pull-right" name="s_name" value="{{ Input::get('s_name') }}" style="width: 150px;" placeholder="搜索分组名">
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
                        <th>分组名</th>
                        <th>分组值</th>
                        <th>排序</th>
                      </tr>
                      <!--tr-th end-->

                      @foreach ($types as $type)
                      <tr>
                        <td>
                            <a href="{{ route('admin.setting_type.index') }}/{{ $type->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>  
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>  
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="{{ $type->id }}"></i></a>
                        </td>
                        <td><a href="{{ route('admin.setting_type.index') }}/{{ $type->id }}">{{ $type->name }}</a></td>
                        <td class="text-green">
                          {{ $type->value }}
                        </td>
                        <td>{{ $type->sort }}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $types->render() !!}
                </div>

                <!--隐藏型删除表单-->
                <form method="post" action="{{ route('admin.setting_type.index') }}" accept-charset="utf-8">
                <input name="_method" type="hidden" value="delete">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

              </div>
@stop


@section('filledScript')
        <!--jQuery 提交表单，实现DELETE删除资源-->
        //jQuery submit form
        $('.delete_item').click(function(){
            var action = '{{ route('admin.setting_type.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
@stop
