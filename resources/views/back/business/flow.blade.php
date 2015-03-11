@extends('layout.backend')
@section('main_content')
@parent
					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.business.index') }}">业务管理</a>  &gt;  业务流程
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
						<div class="cmf_cont">
							<p>您可以在“业务管理”大分类下建立子模块栏目来进行二次开发。</p>
							<p>有关芽丝二次开发的问题请留意官网相关文档或文章，您也可在 <a href="https://github.com/">GitHub</a> 上对某些问题发出 <a href="https://github.com/douyasi/yascmf/issues">Issue</a> 。</p>
							<p>这里展示下我开发的某线下CRM系统模块栏目导航：</p>
							<img src="{{ asset('assets/img/demo.jpg') }}" />
						</div>
					</div>
					<!--cms主体区域 end-->
@stop
