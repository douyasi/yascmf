@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.setting.index') }}">系统管理</a>  &gt;  新增动态设置
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
						{!! Form::open( array('url' => route('admin.setting.store'), 'method' => 'post', 'id' => 'addSettingForm') ) !!}
							<!--tab_content start-->
							<div class="tab_content">
								<div class="tab_pane active">
									<ul>
										<li>
											<label class="description" for="name">动态设置名  <span class="required">(*)</span>  <span class="tips">动态设置名只能是英文字母、数字、下划线与横杠（a-zA-Z0-9_-）组合</span></label>
											<div class="form_item">
												<input type="text" id="name" name="name" autocomplete="off" value="" placeholder="动态设置名">
											</div>
										</li>
										<li>
											<label class="description" for="value">动态设置值 <span class="required">(*)</span></label>
											<div class="form_item">
												<input type="text" id="value" name="value" value="" placeholder="动态设置值">  
											</div>
										</li>
										<li>
											<label class="description" for="value">动态设置分组 <span class="required">(*)</span></label>
											<div class="form_item">
												<select data-placeholder="选择动态设置分组" class="chosen-select" style="width:350px;" name="type_id">
													@foreach ($types as $type)
														<option value="{{ $type->id }}" {{ ($type->id == Input::get('s_tid','1')) ? 'selected':'' }}>{{ $type->value }}</option>
													@endforeach
												</select>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!--tab_content end-->
							
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" id="addSettingSubmit" name="submit" value="添加">
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
		@include('scripts.endAjaxForm', ['_sub' => '#addSettingSubmit', '_form' => '#addSettingForm', '_loc' => route('admin.setting.index')])
	@stop
