@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->
					
					
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.user.index') }}">用户管理</a>  &gt;  新增管理用户
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">主要内容</a></li>
							<li><a href="javascript:void(0);">通联内容</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->

					<!--表单主体区域 start-->
					<div class="main_form_content">
						<!--form start-->
						{!! Form::open( array('url' => route('admin.user.store'), 'method' => 'post', 'id' => 'addManagerForm') ) !!}
							<!--tab_content start-->
							<div class="tab_content">

								<div class="tab_pane active">
									<ul>
										<li>
											<label class="description" for="title">登录(用户)名  <span class="required">(*)</span>  <span class="tips">只能英文字母与阿拉伯数字组合，长度5-10位；一经提交，将无法修改！</span></label>{{-- 初次添加管理用户时，昵称会与登录名相同 --}}
											<div class="form_item">
												<input type="text" id="username" name="username" autocomplete="off" value="" placeholder="登录名">
											</div>
										</li>
										<li>
											<label class="description">角色（用户组）  <span class="required">(*)</span></label>
											<div class="form_item">
												<select data-placeholder="选择角色（用户组）..." class="chosen-select" style="width:350px;" name="role">
													@foreach ($roles as $role)
														<option value="{{ $role->id }}" {{ ($role->name === 'Demo') ? 'selected':'' }}>{{ (Lang::has('roles.'.$role->name)) ? Lang::get('roles.'.$role->name) : ''}}({{ $role->name }})</option>
													@endforeach
												</select>
											</div>
										</li>
										<li>
											<label class="description" for="title">初始化登录密码  <span class="required">(*)</span>  <span class="tips">建议阿拉伯数字(0-9)、英文大小写字母(a-zA-Z)与特殊符号(~@#%_)混组，长度6-16位</span></label>
											<div class="form_item">
												<input type="password" id="password" name="password" autocomplete="off" value="" placeholder="登录密码">
											</div>
										</li>
										<li>
											<label class="description" for="title">确认登录密码  <span class="required">(*)</span>  <span class="tips">请确认上面输入的登录密码</span></label>
											<div class="form_item">
												<input type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" value="" placeholder="重复上面登录密码">
											</div>
										</li>
										<li>
											<label class="description" for="email">电子邮件  <span class="required">(*)</span>  <span class="tips">用于找回或重置登录密码等操作</span></label>
											<div class="form_item">
												<input type="text" id="email" name="email" autocomplete="off" value="" placeholder="电子邮件地址">
											</div>
										</li>
										<li>
											<label class="description" for="realname">真实姓名  <span class="required">(*)</span>  <span class="tips">用于身份确认，必须为中文，2字以上</span></label>
											<div class="form_item">
												<input type="text" id="realname" name="realname" autocomplete="off" value="" placeholder="真实姓名">
											</div>
										</li>
									</ul>
								</div>
								
								<div class="tab_pane">
									<ul>
										<li>
											<label class="description" for="phone">手机号码  <span class="tips">用于通讯联络，请填写国内真实的手机号码</span></label>
											<div class="form_item">
												<input type="text" id="phone" name="phone" autocomplete="off" value="" placeholder="手机号码">
											</div>
										</li>
										<li>
											<label class="description" for="address">通联地址  <span class="tips">用于通讯联络，请填写真实的通联地址</span></label>
											<div class="form_item">
												<input type="text" id="address" name="address" autocomplete="off" value="" placeholder="常住通联地址">
											</div>
										</li>
									</ul>
								</div>
								
							</div>
							<!--tab_content end-->
							
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" id="addManagerSubmit" name="submit" value="新增管理用户">
							</div>
							<!--form_control end-->
						{!! Form::close() !!}
						<!--form end-->
					</div>
					<!--表单主体区域 end-->

@stop

@section('endMainCon')
@parent
	@include('scripts.endChosen')
	<script src="{{ asset('assets/lib/form/jquery.form.js') }}"></script>{{-- 加载jquery.form插件 --}}
@stop

	

	@section('ajaxForm')
		@include('scripts.endBuildHtml')
		@include('scripts.endAjaxForm', ['_sub' => '#addManagerSubmit', '_form' => '#addManagerForm', '_loc' => route('admin.user.index')])
	@stop
