@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->
					
					
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.role.index') }}">角色(用户组)</a>  &gt;  修改角色
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">修改角色</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->

					<!--为了实现restful路由，form表单会默认构造隐藏表域<input type="hidden" name="_method" value="PUT|DELETE">-->
					<!--表单主体区域 start-->
					<div class="main_form_content">
						<!--form start-->
						{!! Form::open( array('url' => route('admin.role.update', $role->id), 'method' => 'put', 'id' => 'editRoleForm') ) !!}
							<!--tab_content start-->
							<div class="tab_content">

								<div class="tab_pane active">
									<ul>
										<li>
											<label class="description" for="name">角色(用户组)名  <span class="required">(*)</span>  <span class="tips">只能为英文单词，建议首字母大写</span></label>
											<div class="form_item">
												<input type="text" id="name" name="name" autocomplete="off" value="{{ $role->name }}" placeholder="角色(用户组)名">
											</div>
										</li>
										<li>
											<label class="description">关联权限  <span class="required">(*)</span>  <span class="tips">请选择该角色关联的权限</span></label>
											<div class="form_item">
												@foreach($permissions as $per)
												<input type="checkbox" name="permissions[]" value="{{ $per->id }}" {{ ( check_array($cans,'id', $per->id) === true) ? 'checked' : '' }}>
												<label class="choice" for="permissions[]">{{ $per->display_name }}</label>
												@endforeach

											</div>
										</li>
								</div>
								
							</div>
							<!--tab_content end-->
							
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" id="editRoleSubmit" name="submit" value="修改角色">
							</div>
							<!--form_control end-->
						{!! Form::close() !!}
						<!--form end-->
					</div>
					<!--表单主体区域 end-->


@stop

@section('endMainCon')
@parent
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
		@include('scripts.endAjaxForm', ['_sub' => '#editRoleSubmit', '_form' => '#editRoleForm', '_loc' => route('admin.role.index')])
	@stop
