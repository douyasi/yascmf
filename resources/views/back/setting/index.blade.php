@extends('layout._back')

@section('content-header')
@parent
          <h1>
            系统管理
            <small>动态设置</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">系统管理 - 动态设置</li>
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

              <a href="{{ route('admin.setting.create', array('s_tid' => Request::segment(3))) }}" class="btn btn-primary margin-bottom">新增动态设置</a>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">动态设置列表</h3>
                  <div class="box-tools">
                    <form action="{{ route('admin.setting.index') }}" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_value" value="{{ Input::get('s_value') }}" style="width: 150px;" placeholder="搜索值">
                        <input type="text" class="form-control input-sm pull-right" name="s_name" value="{{ Input::get('s_name') }}" style="width: 150px;" placeholder="搜索名">
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
                        <th>选择</th>
                        <th>操作</th>
                        <th>分组名/值</th>
                        <th>名</th>
                        <th>值</th>
                      </tr>
                      <!--tr-th end-->

                      @foreach ($settings as $set)
                      <tr>

                        <td class="table-operation"><input type="checkbox" value="{{ $set->id }}" name="checkbox[]"></td>
                        <td>
                            <a href="{{ route('admin.setting.index') }}/{{ $set->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>  
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>  
                            <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="{{ $set->id }}"></i></a>
                        </td>
                        <td>
                          <a href="{{ route('admin.setting_type.index') }}/{{ $set->tid }}">{{ $set->tname }}/{{ $set->tvalue }}</a>
                        </td>
                        <td class="text-red">{{ $set->name }}</td>
                        <td class="text-green">{{ $set->value }}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $settings->render() !!}
                </div>

                <!--隐藏型删除表单-->
                <form method="post" action="{{ route('admin.setting.index') }}" accept-charset="utf-8" id="hidden-delete-form">
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
            var action = '{{ route('admin.setting.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
@stop
