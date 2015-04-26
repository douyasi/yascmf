@extends('layout._back')

@section('content-header')
@parent
          <h1>
            系统管理
            <small>系统日志</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">系统管理 - 系统日志</li>
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

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">日志列表</h3>
                  <div class="box-tools">
                    <form action="{{ route('admin.page.index') }}" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_operator_realname" value="{{ Input::get('s_operator_realname') }}" style="width: 150px;" placeholder="搜索操作者">
                        <input type="text" class="form-control input-sm pull-right" name="s_operator_ip" value="{{ Input::get('s_operator_ip') }}" style="width: 150px;" placeholder="搜索操作者IP">
                        <div class="input-group-btn">
                          <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <div class="tablebox-controls">
                    <button class="btn btn-default btn-sm"><i class="fa fa-file-excel-o" title="导出为excel文件"></i></button>
                    <button class="btn btn-default btn-sm"><i class="fa fa-file-text-o" title="导出为log文本文件"></i></button>                  </div>
                  <table class="table table-hover table-bordered">
                    <tbody>
                      <!--tr-th start-->
                      <tr>
                        <th>查阅</th>
                        <th>操作类型</th>
                        <th>操作者</th>
                        <th>操作者IP</th>
                        <th>操作URL</th>
                        <th>操作内容</th>
                        <th>操作时间</th>
                      </tr>
                      <!--tr-th end-->

                      @foreach ($system_logs as $sys_log)
                      <tr>
                        <td>
                            <a href="{{ route('admin.system_log.index') }}/{{ $sys_log->id }}"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        </td>
                        <td class="text-red">{{ $sys_op[$sys_log->type] }}</td>
                        <td class="text-green">{{ $sys_log->realname }}</td>
                        <td class="text-yellow">{{ $sys_log->operator_ip }}</td>
                        <td class="overflow-hidden" title="{{ $sys_log->url }}">{{ $sys_log->url }}</td>
                         <td class="overflow-hidden" title="{{ $sys_log->content }}">{{ str_limit($sys_log->content, 70, '...') }}</td>
                        <td>{{ $sys_log->created_at }}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $system_logs->render() !!}
                </div>

              </div>
@stop

