@extends('layout.backend')
@section('main_content')
@parent
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.console.index') }}">控制台</a>  &gt;  概要
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
						<div class="cmf_cont">
							<p>这是后台概要内容区域。</p>
						</div>
					</div>
					<!--cms主体区域 end-->
@stop
