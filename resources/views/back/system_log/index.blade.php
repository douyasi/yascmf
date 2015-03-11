@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href=""><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.system_option.index') }}">系统管理</a>  &gt;  系统日志
						<!--筛选搜索-->
						<div class="search_box">
							<form action="{{ route('admin.system_log.index') }}" method="get">
								<input type="text" name="s_operator_realname" value="{{ Input::get('s_operator_realname') }}" placeholder="操作者真实姓名">
								<input type="text" name="s_operator_ip" value="{{ Input::get('s_operator_ip','') }}" placeholder="操作者IP">
								<input type="submit" class="flat_btn yas_green" value="搜索">
							</form>
						</div>
						<!--筛选搜索 end-->
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
							<div class="cmf_cont">
								<p>
									<a href=""><i class="fa fa-fw fa-file-excel-o" alt="导出" title="导出"></i>导出系统操作日志</a>
								</p>
								<table class="yas_table yas_table_noborder yas_table_overflow">
									<thead>
										<tr>
											<th width="10%">查阅</th>
											<th width="10%">操作类型</th>
											<th width="10%">操作者</th>
											<th width="10%">操作者IP</th>
											<th width="20%">操作URL</th>
											<th width="30%">操作内容</th>
											<th width="20%">操作时间</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($system_logs as $sys_log)
										<tr>
											<td><a href="{{ route('admin.system_log.index') }}/{{ $sys_log->id }}"> <i class="fa fa-fw fa-link" alt="预览" title="预览"></i></td>
											<td>{{ $sys_op[$sys_log->type] }}</td>
											<td>{{ $sys_log->realname }}</td>
											<td>{{ $sys_log->operator_ip }}</td>
											<td class="overflow-hidden" title="{{ $sys_log->url }}">{{ $sys_log->url }}</td>
											<td class="overflow-hidden" title="{{ $sys_log->content }}">{{ str_limit($sys_log->content, 70, '...') }}</td>
											<td>{{ $sys_log->created_at }}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								
								<div class="yas_page_container">
									{!! $links !!}
								</div>
							</div>
					</div>
					<!--cms主体区域 end-->

@stop






