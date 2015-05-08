@extends('layout._base')

@section('hacker_header')
@stop

@section('title') {{ isset($title) ? $title : '前台' }} - {{ Cache::get('website_title','芽丝博客') }} @stop

@section('meta')
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
@stop

@section('head_css')
	<link href="{{ asset('static/themes/simplex/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('static/yas_blog.css') }}" rel="stylesheet">
@stop

@section('head_js')
	<script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
	<link href="http://cdn.bootcss.com/highlight.js/8.0/styles/monokai_sublime.min.css" rel="stylesheet"> 
	<script >hljs.initHighlightingOnLoad();</script>  
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="{{ asset('static/js/html5shiv/dist/html5shiv.js') }}"></script>
		<script src="{{ asset('static/js/respond/dest/respond.min.js') }}"></script>
	<![endif]-->
@stop

@section('body')
	@include('widgets.bootstrapHeader'){{-- 前台bootstrap头部导航 --}}

	@section('bootstrapContent')
	@show{{-- 页面主体内容 --}}

	@include('widgets.bootstrapFooter'){{-- 前台bootstrap页脚 --}}
@stop

@section('afterBody')
	@section('bootstrapJS')
	<script src="{{ asset('static/js/jquery-1.10.2.min.js') }}"></script>
	<script src="{{ asset('static/js/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	@show{{-- 添加一些bootstrap需要加载的JS --}}
	@section('extraSection')
	@show{{-- 用户后期扩展时需要补充的一些代码片段 --}}
@stop

@section('hacker_footer')

@stop
