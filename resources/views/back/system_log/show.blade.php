@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->
					
					
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.system_option.index') }}">系统管理</a>  &gt;  <a href="{{ route('admin.system_log.index') }}">系统日志</a>  &gt;  系统日志详情
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">查看系统日志</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->
					<!--表单主体区域 start-->
					<div class="main_form_content">
						
						<!--form start-->

							<!--tab_content start-->
							<div class="tab_content">

								<div class="tab_pane active">
									<ul>
										<li>
											<p>以下为本次<span class="color_orange">系统日志详情</span>。</p>
										</li>
										<li>
											<div class="form_item">
												<table class="yas_table yas_table_noborder" width="500">
													<thead>
														<tr>
															<th width="20%">属性项</th>
															<th width="60%">属性值</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>ID</td>
															<td><span class="text_bold">{{ $sys_log->id }}</span></td>
														</tr>
														<tr>
															<td>操作者昵称</td>
															<td><span class="text_bold">{{ $sys_log->user->nickname }}</span></td>
														</tr>
														<tr>
															<td>操作者真实姓名</td>
															<td><span class="text_bold">{{ $sys_log->user->realname }}</span></td>
														</tr>
														<tr>
															<td>操作者IP</td>
															<td><span class="text_bold">{{ $sys_log->operator_ip }}</span></td>
														</tr>
														<tr>
															<td>操作类型</td>
															<td>
																<span class="text_bold">
																@if(empty($sys_op))
																{{ $sys_log->type }}
																@else
																{{ $sys_op[$sys_log->type] }}
																@endif
																</span>
															</td>
														</tr>
														<tr>
															<td>操作URL</td>
															<td><span class="text_bold">{{ $sys_log->url }}</span> </td>
														</tr>
														<tr>
															<td>操作内容</td>
															<td><span class="text_bold">{{ $sys_log->content }}</span></td>
														</tr>

														<tr>
															<td>操作时间</td>
															<td><span class="text_bold">{{ $sys_log->created_at }}</span></td>
														</tr>
														
													</tbody>
												</table>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!--tab_content end-->
							
					</div>
					<!--表单主体区域 end-->

@stop

