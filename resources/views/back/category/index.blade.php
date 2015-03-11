@extends('layout.backend')
@section('main_content')
@parent
					<!--@表单验证等提示信息栏 START-->
					<div class="validation_tips_area" style="display: none;">
					</div>
					<!--@表单验证等提示信息栏 END /-->

					<!--面包屑导航 start-->
					<div class="breadcrumb_nav">
						<a href="{{ route('admin') }}"><i class="fa fa-home fa-fw"></i>Home</a>  &gt;  <a href="{{ route('admin.article.index') }}">内容管理</a>  &gt;  分类

					</div>
					<!--面包屑导航 end-->
					
					<!--cmf主体区域 start-->
					<div class="main_cmf_content">
							<div class="cmf_cont">
								<p>
									<a href="javascript:void(0);" data-url="{{ route('admin.category.create') }}" class="category_add"><i class="fa fa-fw fa-plus-circle" alt="新增" title="新增"></i>新增分类</a>
								</p>
								<table class="yas_table yas_table_noborder">
									<thead>
										<tr>
											<th width="20%">名称</th>
											<th width="20%">操作</th>
											<th width="20%">缩略名</th>
											<th width="20%">文章数</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($categories as $cat)
										<tr>
											<td><a href="javascript:category_edit({{ $cat->id }});">{{ $cat->name }}</a></td>
											<td><a href="javascript:category_edit({{ $cat->id }});"><i class="fa fa-fw fa-pencil" alt="修改" title="修改"></i></a>  <a href=""><i class="fa fa-fw fa-link" alt="查看" title="查看"></i></a>  <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" alt="删除" title="删除" data-id="{{ $cat->id }}"></i></a></td>
											<td class="color_orange">
												@if(empty($cat->slug))
												{{ $cat->id }}
												@else
												{{ $cat->slug }}
												@endif
											</td>
											<td>{{ count( $cat->content()->get() ) }}  </td>
										</tr>
										@endforeach

									</tbody>
								</table>
								<!--对于一般cms来说分类数量较少，故略去分页与批量删除-->
							</div>

					</div>
					<!--cms主体区域 end-->

@stop

@section('endMainCon')
	<script src="{{ asset('assets/lib/layer/layer.min.js') }}"></script>{{-- 加载layer插件 --}}
	<script type="text/javascript">
		function category_edit(id)
		{
			$.layer({
				type : 2,
				shade: [0.5, '#000',true],
				border: [0],
				title: false,
				closeBtn: false,
				shadeClose: true,
				fix: false,
				iframe : {src: '{{ route('admin.category.index') }}' + '/' + id + '/edit'},
				area : ['600px' , '500px'],
				offset : ['', ''],
				success: function(layero){
					//console.log(layero);
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
					location.reload();
				}
			});
		}
	</script>
@stop

@section('layer')
	$('.category_add').click(function(){
		$.layer({
				type : 2,
				shade: [0.5, '#000',true],
				border: [0],
				title: false,
				closeBtn: false,
				shadeClose: true,
				fix: false,
				iframe : {src: '{{ route('admin.category.create') }}'},
				area : ['600px' , '500px'],
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
					location.reload();
				}
			});
	});
@stop

@section('delete_item')

	@include('scripts.endBuildHtml')
	@include('scripts.endDeleteItem', ['_url' => route('admin.category.index')])

@stop
