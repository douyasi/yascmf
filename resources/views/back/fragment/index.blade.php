@extends('layout._back')

@section('content-header')
@parent
          <h1>
            内容管理
            <small>碎片</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">内容管理 - 碎片</li>
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

              <a href="{{ route('admin.fragment.create') }}" class="btn btn-primary margin-bottom">新增碎片</a>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">碎片列表</h3>
                  <div class="box-tools">
                    <form action="{{ route('admin.fragment.index') }}" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_title" value="{{ Input::get('s_title') }}" style="width: 150px;" placeholder="搜索碎片标题">
                        <input type="text" class="form-control input-sm pull-right" name="s_slug" value="{{ Input::get('s_slug') }}" style="width: 150px;" placeholder="搜索碎片slug">
                        <div class="input-group-btn">
                          <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="box-tips clearfix">
                    <p>
                      <b>碎片</b>一般为简短内容片段，可在模版中直接调用，blade模版中调用方法为 <code>
                        &#123;&#123; fragment($slug,$ret='') &#125;&#125;</code>  或  <code>&#123;!! fragment($slug,$ret='') !!&#125;</code>，具体查阅说明文档。
                    </p>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <div class="tablebox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o" title="全选/反全选"></i></button>
                    <button class="btn btn-default btn-sm"><i class="fa fa-trash-o" title="删除"></i></button>
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh" title="刷新"></i></button>
                  </div>
                  <table class="table table-hover table-bordered">
                    <tbody>
                      <!--tr-th start-->
                      <tr>
                        <th>选择</th>
                        <th>操作</th>
                        <th>标题</th>
                        <th>slug（碎片标识符）</th>
                        <th>创建时间</th>
                        <th>最后修改时间</th>
                      </tr>
                      <!--tr-th end-->

                      @foreach ($fragments as $fra)
                      <tr>
                        <td class="table-operation"><input type="checkbox" value="{{ $fra->id }}" name="checkbox[]"></td>
                        <td>
                            <a href="{{ route('admin.fragment.index') }}/{{ $fra->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>  
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>  
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="{{ $fra->id }}"></i></a>
                        </td>
                        <td class="text-muted">{{ str_limit($fra->title,36) }}</td>
                        <td class="text-green">
                          @if(empty($fra->slug))
                          {{ $fra->id }}
                          @else
                          {{ $fra->slug }}
                          @endif
                        </td>
                        <td>{{ $fra->created_at }}</td>
                        <td>{{ $fra->updated_at }}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $fragments->render() !!}
                </div>

                <!--隐藏型删除表单-->
                <form method="post" action="{{ route('admin.fragment.index') }}" accept-charset="utf-8" id="hidden-delete-form">
                <input name="_method" type="hidden" value="delete">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

              </div>
@stop

@section('extraPlugin')
<!--引入iCheck组件-->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
@stop

@section('filledScript')
        <!--启用iCheck响应checkbox与radio表单控件-->
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.table-operation input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $(".table-operation input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            //Check all checkboxes
            $(".table-operation input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });

        <!--jQuery 提交表单，实现DELETE删除资源-->
        //jQuery submit form
        $('.delete_item').click(function(){
            var action = '{{ route('admin.fragment.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
@stop
