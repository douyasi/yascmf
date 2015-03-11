@extends('layout.backend')
@section('main_content')
@parent
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  403错误 权限不足
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
						<div class="cmf_cont">
							<div class="tips_text">

								<p class="be_sad"><i class="fa fa-smile-o"></i>  403错误 : 权限不足  </p>
								<div class="fail_mask">
									<p><span class="text_bold text_error">
										您没有权限访问当前页面内容，请联系超级管理员或访问其它页面节点！</span></p>
								</div>
						</div>
					</div>
					<!--cms主体区域 end-->
@stop
