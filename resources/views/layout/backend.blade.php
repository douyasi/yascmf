@extends('layout.base')

@section('title') 后台 - YASCMF @stop

@section('head_css')
	<link rel="stylesheet" href="{{ asset('assets/css/yas_style.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css') }}" />
	<!--<link rel="stylesheet" href="{{ minify(array('css/yas_style.css','lib/font-awesome/css/font-awesome.min.css')) }}" />-->{{-- 使用minify来拼合css --}}
@parent
@stop

@section('head_js')
	<script type="text/javascript" src="{{ asset('assets/js/lib/jquery-1.8.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/lib/laytpl.js') }}"></script>
	<!--<script type="text/javascript" src="{{ minify(array('js/lib/jquery-1.8.3.min.js','js/lib/laytpl.js')) }}"></script>-->{{-- 使用minify来拼合js --}}
@parent
@stop

@section('body')
	
	@include('widgets.topHeadNav'){{-- 头部导航区域 --}}
	
	<!--main container START-->
	<div class="main_container" id="main_container">
		<div class="main_container_inner">
		
			@include('widgets.leftSidebar'){{-- 左侧导航栏 --}}

			<!--右侧内容区域 START-->
			<div class="right_main_content">

				<div class="main_content clearfix">
					
					@section('main_content')
					@show{{-- 页面主体内容 --}}

				</div>
				
				<div class="yas_footer">
					&copy; Copyright 2011-{{ date('Y') }} designed &amp; developed by <a href="{{{ Cache::get('system_author_website') }}}">{{ Cache::get('system_author') }}</a>
				</div>

			</div>
			<!--右侧内容区域 END /-->
		</div>

	</div>

	<!--main container END /-->
@stop

@section('afterBody')
@parent
	@section('endMainCon')
	@show{{-- main container之后添加一些应用JS --}}
	@include('scripts.endCommonScript')
	@section('extraSection')
	@show{{-- 补充额外的一些代码 --}}
@stop
