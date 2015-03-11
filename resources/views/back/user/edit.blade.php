@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->
					
					
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.user.index') }}">管理型用户</a>  &gt;  修改管理型用户
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">修改管理型用户</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->
					<!--表单主体区域 start-->
					<div class="main_form_content">
						
						<!--form start-->
						{!! Form::open( array('url' => route('admin.user.update', $user->id), 'method' => 'put', 'id' => 'updateUserForm') ) !!}
							<!--tab_content start-->
							<div class="tab_content">

								<div class="tab_pane active">
									<ul>
										<li>
											<p>以下展示ID为{{ $user->id }} 的管理员<span class="color_orange">个人资料</span>，您可修改昵称、真实姓名与登录密码等信息。登录密码项留空，则不修改登录密码。</p>
										</li>
										<li>
											<div class="form_item">
												<table class="yas_table yas_table_border">
													<tbody>
														<tr>
															<td>登录名：<span class="text_bold">{{ $user->username }}</span></td>
															<td>昵称：<span class="text_bold">{{ $user->nickname }}</span></td>
														</tr>
														<tr>
															<td>真实姓名：<span class="text_bold">{{ $user->realname }}</span></td>
															<td>电子邮件：<span class="text_bold">{{ $user->email }}</span></td>
														</tr>
														<tr>
															<td>手机号码：<span class="text_bold">{{ $user->phone }}</span></td>
															<td>通联地址：<span class="text_bold">{{ $user->address }}</span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</li>
										<li>
											<label class="description">昵称  <span class="required">(*)</span></label>
											<div class="form_item">
												<input type="text" name="nickname" value="{{ $user->nickname }}" placeholder="昵称">
											</div>
										</li>
										<li>
											<label class="description">真实姓名  <span class="required">(*)</span></label>
											<div class="form_item">
												
												<input type="text" id="realname" name="realname" autocomplete="off" value="{{ $user->realname }}" placeholder="真实姓名">
												
											</div>
										</li>
										<li>
											<label class="description">用户状态：是否锁定</label>
											<div class="form_item">
												<input type="radio" name="is_lock" value="0" {{ ($user->is_lock === 0) ? 'checked' : '' }}>
												<label class="choice" for="radiogroup">否</label>
												<input type="radio" name="is_lock" value="1" {{ ($user->is_lock === 1) ? 'checked' : '' }}>
												<label class="choice" for="radiogroup">是</label>
											</div>
										</li>
										<li>
											<label class="description">角色（用户组）</label>
											<div class="form_item">
												<select data-placeholder="选择角色（用户组）..." class="chosen-select" style="width:350px;" name="role">
													@foreach ($roles as $role)
														<option value="{{ $role->id }}" {{ ($own_role->id === $role->id) ? 'selected':'' }}>{{ (Lang::has('roles.'.$role->name)) ? Lang::get('roles.'.$role->name) : ''}}({{ $role->name }})</option>
													@endforeach
												</select>
											</div>
										</li>
										<li>
											<label class="description">登录密码</label>
											<div class="form_item">
												<input type="password" id="password" name="password" value="" autocomplete="off" placeholder="登录密码">
											</div>
										</li>
										<li>
											<label class="description">确认登录密码</label>
											<div class="form_item">
												<input type="password" id="password_confirmation" name="password_confirmation" value="" autocomplete="off" placeholder="登录密码">
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!--tab_content end-->
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" id="updateUserSubmit" name="submit" value="修改管理型用户">
							</div>
							<!--form_control end-->
						{!! Form::close() !!}
					</div>
					<!--表单主体区域 end-->

@stop

@section('endMainCon')
@parent
	@include('scripts.endChosen')
	<link href="{{ asset('assets/lib/iCheck/skins/square/red.css') }}" rel="stylesheet">
	<script src="{{ asset('assets/lib/iCheck/icheck.min.js') }}"></script>{{-- 加载icheck插件 --}}
	<script src="{{ asset('assets/lib/layer/layer.min.js') }}"></script>{{-- 加载layer插件 --}}
	<script src="{{ asset('assets/lib/form/jquery.form.js') }}"></script>{{-- 加载jquery.form插件 --}}
@stop
	

	@section('iCheck')
		/*iCheck组件*/
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
		increaseArea: '20%' // optional
	});
	@stop


	@section('ajaxForm')
		@include('scripts.endBuildHtml')
		@include('scripts.endAjaxForm', ['_sub' => '#updateUserSubmit', '_form' => '#updateUserForm', '_loc' => route('admin.user.index')])
	@stop
