@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->
					
					
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.article.index') }}">内容管理</a>  &gt;  撰写新页面
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">主要内容</a></li>
							<li><a href="javascript:void(0);">附加内容</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->

					<!--为了实现restful路由，form表单会默认构造隐藏表域<input type="hidden" name="_method" value="PUT|DELETE">-->
					<!--表单主体区域 start-->
					<div class="main_form_content">
						<!--form start-->
						{!! Form::open( array('url' => route('admin.page.store'), 'method' => 'post', 'id' => 'addPageForm') ) !!}
							<!--tab_content start-->
							<div class="tab_content">

								<div class="tab_pane active">
									<ul>
										<li>
											<label class="description" for="title">标题  <span class="required">(*)</span></label>
											<div class="form_item">
												<input type="text" id="title" name="title" autocomplete="off" value="" placeholder="标题">
											</div>
										</li>
										<li>
											<label class="description" for="thumb">缩略图  <span class="tips">某些前端模版可能需要缩略图</span></label>
											<div class="form_item">
												<input type="text" id="thumb" name="thumb" value="" placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png">  <a href="javascript:void(0);" class="uploadPic"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic"><i class="fa fa-fw fa-eye" title="预览小图"></i></a>
											</div>
										</li>
										<li>
											<label class="description" for="ckeditor">正文  <span class="required">(*)</span>  <span class="tips">CKEditor编辑器</span></label>
											<div class="form_item">
												<textarea id="ckeditor" name="content"></textarea>
											</div>
											@include('scripts.endCKEditor')
										</li>
									</ul>
								</div>
								
								<div class="tab_pane">
									<ul>
										<li>
											<label class="description" for="outer_link">外链地址  <span class="tips">如文章为转载，请在此处填写原始链接地址</span></label>
											<div class="form_item">
												<input type="text" id="outer_link" name="outer_link" value="" placeholder="http://example.com/">
											</div>
										</li>
										<li>
											<label class="description">是否置顶</label>
											<div class="form_item">
												<input type="radio" name="is_top" value="0" checked>
												<label class="choice" for="radiogroup">否</label>
												<input type="radio" name="is_top" value="1">
												<label class="choice" for="radiogroup">是</label>
											</div>
										</li>
									</ul>
								</div>
								
							</div>
							<!--tab_content end-->
							
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" id="publishPageSubmit" name="submit" value="发布页面">
							</div>
							<!--form_control end-->
						{!! Form::close() !!}
						<!--form end-->
					</div>
					<!--表单主体区域 end-->
					<div id="layerPreviewPic" class="fn-hide">
						
					</div>

@stop

@section('endMainCon')
@parent
	@include('scripts.endChosen')
	<link href="{{ asset('assets/lib/iCheck/skins/square/red.css') }}" rel="stylesheet">
	<script src="{{ asset('assets/lib/iCheck/icheck.min.js') }}"></script>{{-- 加载icheck插件 --}}
	<script src="{{ asset('assets/lib/layer/layer.min.js') }}"></script>{{-- 加载layer插件 --}}
	<script src="{{ asset('assets/lib/form/jquery.form.js') }}"></script>{{-- 加载jquery.form插件 --}}
@stop

	@section('layer')
	@include('scripts.endSinglePic')
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
	@include('scripts.endAjaxForm', ['_sub' => '#publishPageSubmit', '_form' => '#addPageForm', '_loc' => route('admin.page.index')])
	@stop
