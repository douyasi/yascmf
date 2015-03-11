@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.setting.index') }}">系统管理</a>  &gt;  修改动态设置
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
						{!! Form::open( array('url' => route('admin.setting.update', $data->id), 'method' => 'put', 'id' => 'editSettingForm') ) !!}
							<!--tab_content start-->
							<div class="tab_content">
								<div class="tab_pane active">
									<ul>
										<li>
											<label class="description" for="name">动态设置名  <span class="required">(*)</span>  <span class="tips">详细设置名称只能是英文字母</span></label>
											<div class="form_item">
												<input type="text" id="name" name="name" autocomplete="off" value="{{ $data->name }}" placeholder="名">
											</div>
										</li>
										<li>
											<label class="description" for="value">动态设置值  <span class="required">(*)</span></label>
											<div class="form_item">
												<input type="text" id="value" name="value" value="{{ $data->value }}" placeholder="值 ">  
											</div>
										</li>
										<li>
											<label class="description">动态设置分组  <span class="required">(*)</span></label>
											<div class="form_item">
												<select data-placeholder="选择动态设置分组" class="chosen-select" style="width:350px;" name="type_id">
													@foreach ($types as $type)
														<option value="{{ $type->id }}" {{ ($data->type_id === $type->id) ? 'selected':'' }}>{{ $type->value }}</option>
													@endforeach
												</select>
											</div>
										</li>
										<li>
											<label class="description" for="status">状态  <span class="tips">状态只能是0或者1</span></label>
											<div class="form_item">
												<input type="radio" name="status" value="0" {{ ($data->status === 0) ? 'checked' : '' }}>
												<label class="choice" for="radiogroup">禁用</label>
												<input type="radio" name="status" value="1" {{ ($data->status === 1) ? 'checked' : '' }}>
												<label class="choice" for="radiogroup">启用</label>
											</div>
										</li>
										<li>
											<label class="description" for="sort">排序<span class="required">(*)</span><span class="tips">排序只能是数字，数字越大排序越靠前</span></label>
											<div class="form_item">
												<input type="text" id="sort" name="sort" value="{{ $data->sort }}" maxlength="6" placeholder="排序">  
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!--tab_content end-->
							
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" id="editSettingSubmit" name="submit" value="修改">
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
	<link href="{{ asset('assets/lib/iCheck/skins/square/red.css') }}" rel="stylesheet">
	<script src="{{ asset('assets/lib/iCheck/icheck.min.js') }}"></script>{{-- 加载icheck插件 --}}
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
		@include('scripts.endAjaxForm', ['_sub' => '#editSettingSubmit', '_form' => '#editSettingForm', '_loc' => route('admin.setting.index')])
	@stop

