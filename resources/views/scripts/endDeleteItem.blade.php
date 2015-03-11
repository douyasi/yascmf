	
	{{--
		ajax delete item template: 
			$_url: 向该url发起删除请求.
	--}}

	$('.delete_item').click(function(){
		var id = $(this).data('id');
		$.ajax({
				type: "POST",
				url: "{{ $_url }}" + '/' + id,
				data: "_method=DELETE&_token={{ csrf_token() }}",
				success: function(msg){
					var html = build_html(msg.status,msg.info,msg.operation);
					$('.validation_tips_area').html(html).css('display','block');
					setTimeout( function(){$('.validation_tips_area').fadeOut('slow');},2000);
					setTimeout("location.reload()",1000);
				},
				error: function(){
					var html = build_html(0, '失败：服务器端异常', '删除');
					$('.validation_tips_area').html(html).css('display','block');
					setTimeout( function(){$('.validation_tips_area').fadeOut('slow');},2000);
					//setTimeout("location.reload()",1000);
				}
		});
	});

