	{{-- 
		ajax form template:
			$_sub为绑定点击事件元素的id或class名;
			$_loc为成功之后跳转url;
			$_form为表单元素的id或类名.
	--}}
	// ajax form拦截提交事件 
	$('{{ $_sub }}').click(function(){
		var options = {
			dataType: 'json',
			timeout: 3000,
			success: function (data) {
				var html = build_html(data.status,data.info,data.operation);
				$('.validation_tips_area').html(html).css('display','block');
				setTimeout( function(){$('.validation_tips_area').fadeOut('slow');},2000);
				if(data.status === 1)  //成功
				{
					var url = data.url;
					var hostname = window.location.hostname;
					var re = url.indexOf(hostname);
					if(re != -1)
					{
						window.location = url;
					}
					else{
						window.location = '{{ $_loc }}';
					}
				}
			},
			error: function(){
				var html = build_html(0, '失败：服务器端异常', '操作');
				$('.validation_tips_area').html(html).css('display','block');
				setTimeout( function(){$('.validation_tips_area').fadeOut('slow');},2000);
				//setTimeout("location.reload()",1000);
			}
		};
		$('{{ $_form }}').ajaxForm(options);

	});
