@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->
					
					
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.system_option.index') }}">系统管理</a>  &gt;  系统配置
					</div>
					<!--面包屑导航 end-->
					
					<!--nav_tabs start-->
					<div class="nav_tabs">
						<ul class="cf">
							<li class="active"><a href="javascript:void(0);">基本配置</a></li>
							<!--  <li><a href="javascript:void(0);">内容配置</a></li>-->
							<li><a href="javascript:void(0);">系统配置</a></li>
						</ul>
					</div>
					<!--nav_tabs end-->

					<!--表单主体区域 start-->
					<div class="main_form_content">
						<!--form start-->

							{!! Form::open( array('url' => route('admin.system_option.index'), 'method' => 'put', 'id' => 'editSystemOptionForm') ) !!}

							<!--tab_content start-->
							<div class="tab_content">
								<p class="color_orange text_bold">请在超级管理员协助下修改系统配置选项，错误或不合理的修改可能会造成系统运行错误。本表单不对数据做任何校验处理，请务必输入正确与合法的数据。</p>
								<div class="tab_pane active">
									<ul>
										<li>
											<label class="description">网站标题[website_title]</label>
											<div class="form_item">
												<input type="text" name="data[website_title]" autocomplete="off" value="{{ $data['website_title'] }}" placeholder="网站标题">
											</div>
										</li>
										<li>
											<label class="description">网站关键词[website_keywords]  <span class="tips">多个关键词之间使用英文逗号( , )隔开</span></label>
											<div class="form_item">
												<input type="text" name="data[website_keywords]" autocomplete="off" value="{{ $data['website_keywords'] }}" placeholder="网站关键词">
											</div>
										</li>
										<li>
											<label class="description">公司全称[company_full_name]</label>
											<div class="form_item">
												<input type="text" name="data[company_full_name]" autocomplete="off" value="{{ $data['company_full_name'] }}" placeholder="公司全称">
											</div>
										</li>
										<li>
											<label class="description">公司简称[company_short_name]</label>
											<div class="form_item">
												<input type="text" name="data[company_short_name]" autocomplete="off" value="{{ $data['company_short_name'] }}" placeholder="公司简称">
											</div>
										</li>
										<li>
											<label class="description">公司电话[company_telephone]</label>
											<div class="form_item">
												<input type="text" name="data[company_telephone]" autocomplete="off" value="{{ $data['company_telephone'] }}" placeholder="公司电话">
											</div>
										</li>
										<li>
											<label class="description">网站备案号[website_icp]</label>
											<div class="form_item">
												<input type="text" name="data[website_icp]" autocomplete="off" value="{{ $data['website_icp'] }}" placeholder="网站备案号">
											</div>
										</li>
										<li>
											<label class="description">后台分页大小[page_size]</label>
											<div class="form_item">
												<select data-placeholder="后台分页大小" class="chosen-select" style="width:350px;" name="data[page_size]" >
													<option value="10" {{ ($data['page_size'] === "10") ? 'selected':'' }}>10</option>
													<option value="15" {{ ($data['page_size'] === "15") ? 'selected':'' }}>15</option>
													<option value="20" {{ ($data['page_size'] === "50") ? 'selected':'' }}>20</option>
													<option value="25" {{ ($data['page_size'] === "25") ? 'selected':'' }}>25</option>
												</select>
											</div>
										</li>
										<li>
											<label class="description" for="picture_watermark">图片水印[picture_watermark]</label>
											<div class="form_item">
												<input type="text" id="picture_watermark" name="data[picture_watermark]" value="{{ $data['picture_watermark'] }}" placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png" readonly="readonly">  <a href="javascript:void(0);" class="uploadPic" data-id="picture_watermark"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic" data-id="picture_watermark"><i class="fa fa-fw fa-eye" title="预览小图"></i></a>
											</div>
										</li>
										<li>
											<label class="description">上传图片是否添加水印[is_watermark]</label>
											<div class="form_item">
												<input type="radio" name="data[is_watermark]" value="0" {{ ($data['is_watermark'] === '0')? 'checked' : '' }}>
												<label class="choice" for="radiogroup">否</label>
												<input type="radio" name="data[is_watermark]" value="1" {{ ($data['is_watermark'] === '1') ? 'checked' : '' }}>
												<label class="choice" for="radiogroup">是</label>
											</div>
										</li>
									</ul>
								</div>
								
								<div class="tab_pane">
									<ul>
										<li>
											<label class="description" for="system_logo">系统LOGO[system_logo]  </label>
											<div class="form_item">
												<input type="text" id="system_logo" name="data[system_logo]" value="{{ $data['system_logo'] }}" placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png" readonly="readonly">  <a href="javascript:void(0);" class="uploadPic" data-id="system_logo"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic" data-id="system_logo"><i class="fa fa-fw fa-eye" title="预览小图"></i></a>
											</div>
										</li>
										<li>
											<label class="description">系统版本号[system_version]</label>
											<div class="form_item">
												<input type="text" name="data[system_version]" autocomplete="off" value="{{ $data['system_version'] }}" placeholder="网站备案号">
											</div>
										</li>
										<li>
											<label class="description">系统开发者[system_author]</label>
											<div class="form_item">
												<input type="text" name="data[system_author]" autocomplete="off" value="{{ $data['system_author'] }}" placeholder="网站备案号">
											</div>
										</li>
										<li>
											<label class="description">系统开发者网站[system_author_website]</label>
											<div class="form_item">
												<input type="text" name="data[system_author_website]" autocomplete="off" value="{{ $data['system_author_website'] }}" placeholder="网站备案号">
											</div>
										</li>
									</ul>
								</div>
								
							</div>
							<!--tab_content end-->
							
							<!--form_control start-->
							<div class="form_buttons">
								<input class="flat_btn yas_green" type="submit" name="submit" id="editSystemOptionSubmit" value="确定">
							</div>
							<!--form_control end-->
						<!--</form>-->
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
		$('.uploadPic').click(function(){
			var ele = $(this).data('id');
			$.layer({
					type : 2,
					shade: [0.5, '#000',true],
					border: [0],
					title: false,
					closeBtn: false,
					shadeClose: true,
					fix: false,
					iframe : {src: '{{ route('admin.upload') }}?from='+ ele},
					area : ['600px' , '250px'],
					offset : ['', ''],
					success: function(layero){
						console.log(layero);
						$(layero['selector'] + ' .xubox_main').css('border-radius','6px');
						$(layero['selector'] + ' .xubox_iframe').css('border-radius','6px');
						/*
						$('#xubox_layer1 .xubox_main').css('border-radius','3px');
						$('#xubox_layer1 .xubox_iframe').css('border-radius','3px');
						*/
					},
					close : function(index){
						layer.closeAll();
					},
					end : function(index){
						//location.reload();
					}
				});
		});
		$('.previewPic').hover(function(){
			var ele = $(this).data('id');
			var pic_url = $.trim($('#'+ele).val());
			if( pic_url.indexOf('{{ url('') }}') === -1){  //如果不是站内域名，不予预览
				tmp = '<div style="max-width: 300px;background-color: #000;"><p style="margin:10px; color: #f00;">没有图片地址，或者图片地址为外链，暂时无法预览！</p></div>';
			}
			else{
				tmp = '<div style="max-width: 300px;"><img src="' + pic_url + '" width="300" /></div>';
			}
			$('#layerPreviewPic').html(tmp);
			$.layer({
				type : 1,
				title : false,
				fix : false,
				border: [0],
				shade: [0],
				offset:['50px' , ''],
				area : ['300px', 'auto'],
				page : {dom : '#layerPreviewPic'}
			});
		});
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
		@include('scripts.endAjaxForm', ['_sub' => '#editSystemOptionSubmit', '_form' => '#editSystemOptionForm', '_loc' => route('admin.system_option.index')])
	@stop
