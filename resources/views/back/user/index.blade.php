@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.user.index') }}">用户管理</a>  &gt;  管理型用户
						<!--筛选搜索-->
						<div class="search_box">
							<form action="{{ route('admin.user.index') }}" method="get">
								<input type="text" name="s_name" value="{{ Input::get('s_name') }}" placeholder="用户登录名或昵称或真实姓名">
								<input type="text" name="s_phone" value="{{ Input::get('s_phone') }}" placeholder="用户手机号">
								<input type="submit" class="flat_btn yas_green" value="搜索">
							</form>
						</div>
						<!--筛选搜索 end-->
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
						<form id="form_table" method="post" action="">
							<div class="cmf_cont">
								<p>
									<a href="{{ route('admin.user.create') }}"><i class="fa fa-fw fa-plus-circle" alt="新增" title="新增"></i>新增管理用户</a>
								</p>
								<table class="yas_table yas_table_noborder">
									<thead>
										<tr>
											<th width="10%">操作</th>
											<th width="10%">编号</th>
											<th width="20%">登录名 / 昵称</th>
											<th width="20%">真实姓名</th>
											<th width="10%">角色(用户组)</th>
											<th width="10%">状态</th>
											<th width="20%">最后一次登录时间</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($users as $user)
										<tr>
											<td><a href="{{ route('admin.user.index') }}/{{{ $user->id }}}/edit"><i class="fa fa-fw fa-pencil" alt="修改" title="修改"></i></a></td>
											<td>{{ $user->id }}</td>
											<td>{{ $user->username }} / {{ $user->nickname }}</td>
											<td class="color_orange">
												{{ $user->realname }}
											</td>
											<td>
												@if(null !== $user->roles->first())  {{-- 某些错误情况下，会造成管理用户没有角色 --}}
												{{ $user->roles->first()->name }}
												@else
												空(NULL)
												@endif
											</td>
											<td>
												@if($user->is_lock)
												锁定
												@else
												正常
												@endif
											</td>
											<td>{{ $user->updated_at }}</td>
										</tr>
										@endforeach

									</tbody>
								</table>
								<div class="yas_page_container">
									{!! $links !!}
								</div>
							</div>
						</form>
					</div>
					<!--cms主体区域 end-->

@stop
