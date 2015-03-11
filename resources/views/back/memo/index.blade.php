@extends('layout.backend')
@section('main_content')
@parent
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.business.index') }}">业务管理</a>  &gt;  备忘
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
						<div class="cmf_cont">
							<p><span class="text_bold">请自行开发...</span></p>
						</div>
					</div>
					<!--cms主体区域 end-->
@stop
