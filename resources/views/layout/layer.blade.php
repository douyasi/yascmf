@extends('layout.base')

@section('title') Layer - YASCMF @stop

@section('head_css')
	<link rel="stylesheet" href="{{ asset('assets/css/yas_style.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/lib/font-awesome/css/font-awesome.min.css') }}" />{{-- 可以到此查看fontawesome图标字体：http://fontawesome.io/icons/ --}}
@parent
@stop


@section('head_js')
	<script type="text/javascript" src="{{ asset('assets/js/lib/jquery-1.8.3.min.js') }}"></script>
@stop

@section('body')
	<div class="close_button">{{-- 自定义关闭 按钮 --}}
		<a href="javascript:void(0);" class="avgrund-close">close</a>
	</div>
	<div class="yascmf_layer">
		@section('mainLayerCon')
		@show{{-- layer表单页面主体内容 --}}
	</div>
@stop

@section('afterBody')
@parent
	@section('endChosen')
	@show{{-- chosen下拉选择表单 --}}
	@section('endLayerJS')
	@show{{-- layer响应部分事件JS --}}
@stop
