@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.setting_type.index') }}">系统管理</a>  &gt;新增动态设置分组
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">主要内容</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->
					
					<!--cmf主体区域 start-->
					<div class="main_form_content">
						<!--form start-->
						{!! Form::open( array('url' => route('admin.setting_type.store'), 'method' => 'post', 'id' => 'addSettingTypeForm') ) !!}
							<!--tab_content start-->
							<div class="tab_content">
								<div class="tab_pane active">
									<ul>
										<li>
											<label class="description" for="name">动态设置分组名  <span class="required">(*)</span>  <span class="tips">动态设置分组名只能是全小写的英文字母与下划线（a-z_）组合</span></label>
											<div class="form_item">
												<input type="text" id="name" name="name" autocomplete="off" value="" placeholder="动态设置分组名">
											</div>
										</li>
										<li>
											<label class="description" for="value">动态设置分组值 <span class="required">(*)</span>  <span class="tips">动态设置分组值建议为中文</span></label>
											<div class="form_item">
												<input type="text" id="value" name="value" value="" placeholder="动态设置分组值">
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!--tab_content end-->
							
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" id="addSettingTypeSubmit" name="submit" value="添加">
							</div>
							<!--form_control end-->
						{!! Form::close() !!}
						<!--form end-->
					</div>
					<!--cms主体区域 end-->

@stop

@section('endMainCon')
@parent
	@include('scripts.endChosen')
	<script src="{{ asset('assets/lib/form/jquery.form.js') }}"></script>{{-- 加载jquery.form插件 --}}
@stop

	

	@section('ajaxForm')
		@include('scripts.endBuildHtml')
		@include('scripts.endAjaxForm', ['_sub' => '#addSettingTypeSubmit', '_form' => '#addSettingTypeForm', '_loc' => route('admin.setting_type.index')])
	@stop
