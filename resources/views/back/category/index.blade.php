@extends('layout._back')

@section('content-header')
@parent
          <h1>
            内容管理
            <small>分类</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">内容管理 - 分类</li>
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

              @if(Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                  {{ Session::get('message') }}
                </div>
              @endif

              <a href="{{ route('admin.category.create') }}" class="btn btn-primary margin-bottom">新增分类</a>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">分类列表</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover table-bordered">
                    <tbody>
                      <!--tr-th start-->
                      <tr>
                        <th>名称</th>
                        <th>操作</th>
                        <th>缩略名</th>
                        <th>文章数</th>
                      </tr>
                      <!--tr-th end-->

                      @foreach ($categories as $cat)
                      <tr>
                        <td class="text-muted">{{ $cat->name }}</td>
                        <td>
                            <a href="{{ route('admin.category.index') }}/{{ $cat->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>  
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="查看"></i></a>  
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="{{ $cat->id }}"></i></a>
                        </td>
                        <td class="text-green">
                          @if(empty($cat->slug))
                          {{ $cat->id }}
                          @else
                          {{ $cat->slug }}
                          @endif
                        </td>
                        <td class="text-red">{{ count( $cat->content()->get() ) }}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div><!-- /.box-body -->

                <!--分类一般来说较少，故移除分页-->

                <!--隐藏型删除表单-->
                <form method="post" action="{{ route('admin.category.index') }}" accept-charset="utf-8" id="hidden-delete-form">
                <input name="_method" type="hidden" value="delete">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

              </div>
@stop


@section('filledScript')
        <!--jQuery 提交表单，实现DELETE删除资源-->
        //jQuery submit form
        $('.delete_item').click(function(){
            var action = '{{ route('admin.category.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
@stop
