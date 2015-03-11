@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->
					
					
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.me.index') }}">我的账户</a>  &gt;  个人资料
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">个人资料</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->
					<!--表单主体区域 start-->
					<div class="main_form_content">
						
						<!--form start-->
						{!! Form::open( array('url' => route('admin.me.update'), 'method' => 'put', 'id' => 'updateMeForm') ) !!}
							<!--tab_content start-->
							<div class="tab_content">

								<div class="tab_pane active">
									<ul>
										<li>
											<p>以下为您作为当前用户的<span class="color_orange">个人资料</span>，您仅可修改个人头像、昵称、真实姓名与登录密码。登录密码项留空，则不修改登录密码。</p>
										</li>
										<li>
											<div class="form_item">
												<table class="yas_table yas_table_border">
													<tbody>
														<tr>
															<td>登录名：<span class="text_bold">{{ $me->username }}</span></td>
															<td>昵称：<span class="text_bold">{{ $me->nickname }}</span></td>
														</tr>
														<tr>
															<td>真实姓名：<span class="text_bold">{{ $me->realname }}</span></td>
															<td>电子邮件：<span class="text_bold">{{ $me->email }}</span></td>
														</tr>
														<tr>
															<td>手机号码：<span class="text_bold">{{ $me->phone }}</span></td>
															<td>通联地址：<span class="text_bold">{{ $me->address }}</span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</li>
										<li>
											<label class="description">昵称  <span class="required">(*)</span></label>
											<div class="form_item">
												<input type="text" name="nickname" value="{{ $me->nickname }}" placeholder="昵称">
											</div>
										</li>
										<li>
											<label class="description">真实姓名  <span class="required">(*)</span></label>
											<div class="form_item">
												
												<input type="text" id="realname" name="realname" autocomplete="off" value="{{ $me->realname }}" placeholder="真实姓名">
												
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
										<li>
											<label class="description">手机号码</label>
											<div class="form_item">
												<input type="text" name="phone" value="{{ $me->phone }}" placeholder="手机号码">
											</div>
										</li>
										<li>
											<label class="description">通联地址</label>
											<div class="form_item">
												
												<input type="text" name="address" value="{{ $me->address }}" placeholder="通联地址">
												
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!--tab_content end-->
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" id="updateMeSubmit" name="submit" value="更新个人资料">
							</div>
							<!--form_control end-->
						{!! Form::close() !!}
					</div>
					<!--表单主体区域 end-->

@stop

@section('endMainCon')
@parent
	<script src="{{ asset('assets/lib/layer/layer.min.js') }}"></script>{{-- 加载layer插件 --}}
	<script src="{{ asset('assets/lib/form/jquery.form.js') }}"></script>{{-- 加载jquery.form插件 --}}
@stop



	@section('ajaxForm')
		@include('scripts.endBuildHtml')
		@include('scripts.endAjaxForm', ['_sub' => '#updateMeSubmit', '_form' => '#updateMeForm', '_loc' => route('admin.me.index')])
	@stop
