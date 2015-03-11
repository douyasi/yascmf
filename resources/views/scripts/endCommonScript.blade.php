{{-- endCommonScript --}}
<script type="text/javascript">
$(document).ready(function(){
	
	/* 头部管理员操作下拉菜单 √*/
	var timer = null;
	$('.usr_op').hover(
		function(){
			clearTimeout(timer);
			$('.li_usr_op_tips').hide();
			$('.li_usr_op_tips').show();
		},function(){
			timer = setTimeout( function(){$('.li_usr_op_tips').hide();} ,1500);
		}
	);

	/* 左侧导航栏折叠 高亮等特效 √*/
	$('.nav_list > li').click(function(){
		$(this).toggleClass('open');
	});

	/* nav_tabs点击切换特效 √*/
	$('.nav_tabs >ul >li').click(function(){
		$('.nav_tabs >ul >li').removeClass('active');
		$(this).addClass('active');
		$('.tab_content .tab_pane').removeClass('active').eq($(this).index()).addClass('active');
	});

	/*左侧导航高亮 √*/
	{{-- URL::current() --}}
	{{-- Route::currentRouteName() --}}
	$('.submenu>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('li').addClass('active');  //二级链接高亮
	$('.submenu>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('.nav_list>li').addClass('active');  //一级栏目[含二级链接]高亮
	$('.nav_list>li').find('a[href="{{ cur_nav(Route::currentRouteName()) }}"]').closest('.nav_list>li').addClass('active');  //一级栏目[不含二级链接]高亮
	
	@yield('layer') {{-- layer --}}

	@yield('vTips') {{-- validation_tips --}}

	@yield('slug') {{-- slug --}}

	@yield('iCheck') {{-- iCheck --}}

	@yield('delete_item') {{-- js实现DELETE --}}

	@yield('ajaxForm') {{-- ajaxForm提交数据 --}}
});
	</script>
