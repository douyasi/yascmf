@extends('layout.layer')

@section('head_style'){{-- layer 表单样式 --}}
	<style type="text/css">
		.close_button{
			margin-bottom: 25px;
		}
		.yascmf_layer{
			width: 560px;
			margin: 0 20px;
		}
		/*覆写部分样式,以便适合弹窗*/
		.yascmf_layer .validation_tips_area{
			width: 500px;
		}
		.yascmf_layer ul li label.description,{
			line-height: 20px !important;
		}
		.yascmf_layer ul li .form_item {
			line-height: 20px !important;
			margin: 5px 0;
		}
		.yascmf_layer p.tips_text{
			color: #083;
			font-size: 12px;
			line-height: 20px;
			margin: 5px 0;
		}
		.avgrund-close {
			display: block;
			color: #555;
			font-size: 14px;
			text-decoration: none;
			text-transform: uppercase;
			position: absolute;
			top: 6px;
			right: 10px;
		}
	</style>
@stop

@section('mainLayerCon')
@parent
	<div class="validation_tips_area" style="display: none;">
	</div>

{!! Form::open( array('url' => route('admin.category.update', $data->id), 'method' => 'put', 'id' => 'editCategoryForm') ) !!}
	<div class="category_edit_form">{{-- 表单数据项目 --}}
		<ul>
			<li>
				<label class="description" for="name">分类名称  <span class="required">(*)</span></label>
				<div class="form_item">
					<input type="text" id="name" name="name" autocomplete="off" value="{{ $data->name }}" placeholder="分类名称" maxlength="20">
					<p class="tips_text" >分类名称简短为宜，中文不要多于8个字.</p>
				</div>
			</li>
			<li>
				<label class="description" for="slug">分类缩略名  </label>
				<div class="form_item">
					@if(empty($data->slug))
					<input type="text" id="slug" name="slug" autocomplete="off" value="{{ $data->id }}" placeholder="分类缩略名" maxlength="10">
					@else
					<input type="text" id="slug" name="slug" autocomplete="off" value="{{ $data->slug }}" placeholder="分类缩略名" maxlength="10">
					@endif
					<p class="tips_text" >分类缩略名用于创建友好的链接形式,建议使用字母,数字,下划线和横杠组合.</p>
				</div>
			</li>
			<li>
				<label class="description" for="description">分类描述  </label>
				<div class="form_item">
					<textarea id="description" name="description" cols="45" rows="2" maxlength="200" placeholder="分类描述">{{ $data->description }}</textarea>
					<p class="tips_text">添加分类描述有助于网站SEO,建议100字词以内.</p>
				</div>
			</li>
			
		</ul>
		<div class="form_buttons">
			<input class="flat_btn yas_green" type="submit" id="editCategorySubmit" value="修改分类">
		</div>
	</div>
{!! Form::close() !!}
@stop

@section('endLayerJS')
<script src="{{ asset('assets/lib/layer/layer.min.js') }}"></script>{{-- 加载layer插件 --}}
<script src="{{ asset('assets/lib/form/jquery.form.js') }}"></script>{{-- 加载jquery.form插件 --}}
<script type="text/javascript">

	//比如在iframe中关闭自身
	var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引
	$('.avgrund-close').on('click', function(){
		parent.layer.close(index); //执行关闭
	});

	// 缩略名自适应宽度 来自typecho
	var slug = $('#slug');
	if (slug.length > 0) {
		var sw = slug.width();
		if (slug.val().length > 0) {
			slug.css('width', 'auto').attr('size', slug.val().length);
		}
		slug.bind('input propertychange', function () {
			var t = $(this), l = t.val().length;
			if (l > 0) {
				t.css('width', 'auto').attr('size', l);
			} else {
				t.css('width', sw).removeAttr('size');
			}
		}).width();
	}

	@include('scripts.endBuildHtml')

	// ajax form拦截提交事件
	$('#editCategorySubmit').click(function(){
		var options = {
			dataType: 'json',
			timeout: 3000,
			success: function (data) {
					var html = build_html(data.status,data.info,data.operation);
					$('.validation_tips_area').html(html).css('display','block');
					setTimeout( function(){$('.validation_tips_area').fadeOut('slow');},2000);
					if(data.status === 1)  //成功
					{
						setTimeout("parent.location.reload()",1000);
					}
			},
			error: function(){
				var html = build_html(0, '失败：服务器端异常', '操作');
				$('.validation_tips_area').html(html).css('display','block');
				setTimeout( function(){$('.validation_tips_area').fadeOut('slow');},2000);
				setTimeout("location.reload()",1000);
			}
		};
		$('#editCategoryForm').ajaxForm(options);
	});
</script>
@stop


