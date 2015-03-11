@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.user.index') }}">用户管理</a>  &gt;  角色(用户组)
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
						<form id="form_table" method="post" action="">
							<div class="cmf_cont">
								<p class="text_bold color_orange">请在超级管理员协助下完成新增修改与删除角色（用户组）操作。</p>
								<p>
									<a href="{{ route('admin.role.create') }}"><i class="fa fa-fw fa-plus-circle" alt="新增" title="新增"></i>新增角色(用户组)</a>
								</p>
								<table class="yas_table yas_table_noborder">
									<thead>
										<tr>
											<th width="10%">操作</th>
											<th width="10%">编号</th>
											<th width="20%">角色(用户组)名</th>
											<th width="20%">创建日期</th>
											<th width="20%">更新日期</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($roles as $role)
										<tr>
											<td><a href="{{ route('admin.role.index') }}/{{ $role->id }}/edit"><i class="fa fa-fw fa-pencil" alt="修改" title="修改"></i></a>  <a href=""><i class="fa fa-fw fa-link" alt="预览" title="预览"></i></a>  <a href="javascript:void();"><i class="fa fa-fw fa-minus-circle delete_item" alt="删除" title="删除" data-id="{{ $role->id }}"></i></a></td>
											<td>{{ $role->id }}</td>
											<td class="color_orange">{{ $role->name }}</td>
											<td>{{ $role->created_at }}</td>
											<td>{{ $role->updated_at }}</td>
										</tr>
										@endforeach

									</tbody>
								</table>
								<!--对于一般cms来说角色（用户组）数量较少，故略去分页与批量删除-->
							</div>
						</form>
					</div>
					<!--cms主体区域 end-->
@stop

@section('delete_item')
	@include('scripts.endBuildHtml')
	@include('scripts.endDeleteItem', ['_url' => route('admin.role.index')])
@stop
