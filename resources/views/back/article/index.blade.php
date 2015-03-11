@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.article.index') }}">内容管理</a>  &gt;  文章
						<!--筛选搜索-->
						<div class="search_box">
							<form action="{{ route('admin.article.index') }}" method="get">
								<input type="text" name="s_title" value="{{ Input::get('s_title') }}" placeholder="文章标题">
								<input type="submit" class="flat_btn yas_green" value="搜索">
							</form>
						</div>
						<!--筛选搜索 end-->
					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
						<form id="form_table" method="post" action="">
							<div class="cmf_cont">
								<p>
									<a href="{{ route('admin.article.create') }}"><i class="fa fa-fw fa-plus-circle" alt="新增" title="新增"></i>撰写新文章</a>
								</p>
								<table class="yas_table yas_table_noborder">
									<thead>
										<tr>
											<th width="5%">选择</th>
											<th width="10%">操作</th>
											<th width="25%">标题</th>
											<th width="10%">slug</th>
											<th width="15%">分类</th>
											<th width="20%">最后修改时间</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($articles as $art)
										<tr>
											<td class="text_center">
												<input type="checkbox" value="{{ $art->id }}" name="checkbox[]">
											</td>
											<td><a href="{{ route('admin.article.index') }}/{{ $art->id }}/edit"><i class="fa fa-fw fa-pencil" alt="修改" title="修改"></i></a>  <a href=""><i class="fa fa-fw fa-link" alt="预览" title="预览"></i></a>  <a href="javascript:void();"><i class="fa fa-fw fa-minus-circle delete_item" alt="删除" title="删除" data-id="{{ $art->id }}"></i></a></td>
											<td>{{ str_limit($art->title,36) }}</td>
											<td class="color_orange">
												@if(empty($art->slug))
												{{ $art->id }}
												@else
												{{ $art->slug }}
												@endif
											</td>
											<td>
												{{ $art->meta->name }}
											</td>
											<td>{{ $art->updated_at }}</td>
										</tr>
										@endforeach

									</tbody>
								</table>
								<div class="cms_func">
									<div class="form_buttons">
											<input type="checkbox" id="check_all" class="checkall_box" title="全选"><label for="check_all" class="cursor_p">全选</label>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="#"><i class="fa fa-fw fa-remove" alt="删除" title="删除"></i>删除所选</a>
											
									</div>
								</div>
								<div class="yas_page_container">
									{!! $links !!}
								</div>
							</div>
						</form>
					</div>
					<!--cms主体区域 end-->

@stop

@section('endMainCon')
	<link href="{{ asset('assets/lib/iCheck/skins/square/red.css') }}" rel="stylesheet">
	<script src="{{ asset('assets/lib/iCheck/icheck.min.js') }}"></script>
@stop

@section('iCheck')
	/*iCheck组件*/
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-red',
		radioClass: 'iradio_square-red',
		increaseArea: '20%'
	});

	/*响应全选,依赖于iCheck组件*/

	$('input#check_all').on('ifChecked', function(event){
		$('input[name="checkbox[]"]').iCheck('check');
	});
	$('input#check_all').on('ifUnchecked', function(event){
		$('input[name="checkbox[]"]').iCheck('uncheck');
	});
@stop

@section('delete_item')

	@include('scripts.endBuildHtml')
	@include('scripts.endDeleteItem', ['_url' => route('admin.article.index')])

@stop
