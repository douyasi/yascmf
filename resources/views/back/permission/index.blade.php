@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.user.index') }}">用户管理</a>  &gt;  权限
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
						
							<div class="cmf_cont">
								<p class="text_bold color_orange">权限影响系统安全与稳定，错误或不合理的修改可能会影响系统业务与逻辑，故在此屏蔽掉权限 增、删、改 功能。<br />开发者可通过阅读 Laravel <a href="https://github.com/Zizaco/entrust/tree/laravel-5">Entrust</a> 文档，结合本内容管理框架实际，来完成相关（二次）开发任务。</p>
								<table class="yas_table yas_table_noborder">
									<thead>
										<tr>
											<th width="10%">操作</th>
											<th width="10%">编号</th>
											<th width="20%">权限标识串</th>
											<th width="20%">权限展示名</th>
											<th width="20%">创建日期</th>
											<th width="20%">更新日期</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($permissions as $per)
										<tr>
											<td> - </td>
											<td>{{ $per->id }}</td>
											<td class="color_orange">{{ $per->name }}</td>
											<td>{{ $per->display_name }}</td>
											<td>{{ $per->created_at }}</td>
											<td>{{ $per->updated_at }}</td>
										</tr>
										@endforeach

									</tbody>
								</table>
							</div>
					</div>
					<!--cms主体区域 end-->

@stop
