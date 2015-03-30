@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->
					
					
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.article.index') }}">内容管理</a>  &gt;  修改碎片
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">主要内容</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->

					<!--为了实现restful路由，form表单会默认构造隐藏表域<input type="hidden" name="_method" value="PUT|DELETE">-->
					<!--表单主体区域 start-->
					<div class="main_form_content">
						<!--form start-->

							{!! Form::open( array('url' => route('admin.fragment.update', $data->id), 'method' => 'put', 'id' => 'editFragmentForm') ) !!}

							<!--tab_content start-->
							<div class="tab_content">

								<div class="tab_pane active">
									<ul>
										<li>
											<label class="description" for="title">标题  <span class="required">(*)</span></label>
											<div class="form_item">
												<input type="text" id="title" name="title" autocomplete="off" value="{{ $data->title }}" placeholder="标题">
											</div>
										</li>
										<li>
											<label class="description" for="title">slug（碎片标识符）  <span class="required">(*)</span>  <span class="tips">英文字母、数字、下划线与横杠（a-zA-Z0-9_-）组合</span></label>
											<div class="form_item mono url_slug">
												<input type="text" id="slug" name="slug" autocomplete="off" value="{{ $data->slug }}" placeholder="slug碎片标识符" maxlength="20">
											</div>
										</li>
										<li>
											<label class="description" for="thumb">缩略图  <span class="tips">某些前端模版可能需要缩略图</span></label>
											<div class="form_item">
												<input type="text" id="thumb" name="thumb" value="{{ $data->thumb }}" placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png">  <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i class="fa fa-fw fa-eye" title="预览小图"></i></a>
											</div>
										</li>
										<li>
											<label class="description" for="ckeditor">正文  <span class="required">(*)</span>  <span class="tips">CKEditor编辑器</span></label>
											<div class="form_item">
												<textarea id="ckeditor" name="content">{{ $data->content }}</textarea>
											</div>
											@include('scripts.endSimpleCKEditor')
										</li>
									</ul>
								</div>
							</div>
							<!--tab_content end-->
							
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" name="submit" id="editFragmentSubmit" value="修改碎片">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input class="flat_btn yas_gray" type="reset" name="reset" value="重置">
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
	<script src="{{ asset('assets/lib/layer/layer.min.js') }}"></script>{{-- 加载layer插件 --}}
	<script src="{{ asset('assets/lib/form/jquery.form.js') }}"></script>{{-- 加载jquery.form插件 --}}
@stop

	@section('layer')
		@include('scripts.endSinglePic')
	@stop




	@section('ajaxForm')

		@include('scripts.endBuildHtml')
		@include('scripts.endAjaxForm', ['_sub' => '#editFragmentSubmit', '_form' => '#editFragmentForm', '_loc' => route('admin.fragment.index')])

	@stop

	@section('slug')
	 // 缩略名自适应宽度 来自typecho
	var slug = $('#slug');

	if (slug.length > 0) {
		var sw = slug.width();
		if (slug.val().length > 0) {
			slug.css('width', 'auto').attr('size', slug.val().length);
		}
		slug.bind('input propertychange', function () {
			var t = $(this), l = t.val().length;
			if (l > 0) {
				t.css('width', 'auto').attr('size', l);
			} else {
				t.css('width', sw).removeAttr('size');
			}
		}).width();
	}

	@stop
