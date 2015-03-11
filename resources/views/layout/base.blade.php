<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>@section('title') YASCMF - YASCMF @show{{-- 页面标题 --}}</title>
	<meta name="description" content="{{ isset($description) ? $description : 'YASCMF' }}" />
	<meta name="keywords" content="YASCMF,{{ Cache::get('website_keywords') }}" />
	<meta name="author" content="{{ Cache::get('system_author_website') }}" />
	<meta name="renderer" content="webkit">{{-- 360浏览器使用webkit内核渲染页面 --}}
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />{{-- IE(内核)浏览器优先使用高版本内核 --}}
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">{{-- 移动端页面缩放 --}}

	<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">{{-- favicon --}}

	@section('head_css')
	@show{{-- head区域css样式表 --}}
	
	@section('head_js')
	@show{{-- head区域javscript脚本 --}}
	
	@section('beforeStyle')
	@show{{-- 在内联样式之前填充一些东西 --}}

	@section('head_style')
	@show{{-- head区域内联css样式表 --}}

	@section('afterStyle')
	@show{{-- 在内联样式之后填充一些东西 --}}
</head>
<body>
	@section('beforeBody')
	@show{{--在正文之后填充一些东西 --}}

	@section('body')
	@show{{-- 正文部分 --}}

	@section('afterBody')
	@show{{-- 在正文之后填充一些东西，比如统计代码之类的东东 --}}

</body>
</html>
