@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.setting_type.index') }}">系统管理</a>  &gt;  动态设置分组
						<!--筛选搜索-->
						<div class="search_box">
							<form action="{{ route('admin.setting_type.index') }}" method="get">
								<input type="text" name="s_name" value="{{ Input::get('s_name') }}" placeholder="分组名">
								<input type="text" name="s_value" value="{{ Input::get('s_value') }}" placeholder="分组值">
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
									<a href="{{ route('admin.setting_type.create') }}"><i class="fa fa-fw fa-plus-circle" alt="新增" title="新增"></i>新增动态设置分组</a>
								</p>
								<table class="yas_table yas_table_noborder">
									<thead>
										<tr>
											<th width="10%">操作</th>
											<th width="25%">分组名</th>
											<th width="10%">分组值</th>
											<th width="15%">排序</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($types as $type)
										<tr>
											<td><a href="{{ route('admin.setting_type.index') }}/{{ $type->id }}/edit"><i class="fa fa-fw fa-pencil" alt="修改" title="修改"></i></a>  <a href=""><i class="fa fa-fw fa-link" alt="预览" title="预览"></i></a>  <a href="javascript:void();"><i class="fa fa-fw fa-minus-circle delete_item" alt="删除" title="删除" data-id="{{ $type->id }}"></i></a></td>
											<td><a href="{{ route('admin.setting_type.index') }}/{{ $type->id }}">{{ $type->name }}</a></td>
											<td class="color_orange">
											{{ $type->value }}
											</td>
											<td>
											{{ $type->sort }}
											</td>
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


@section('delete_item')
	@include('scripts.endBuildHtml')
	@include('scripts.endDeleteItem', ['_url' => route('admin.setting_type.index')])
@stop
