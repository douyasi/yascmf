<!--侦测是否启用JavaScript脚本-->
<noscript>
<style type="text/css">
.noscript{ width:100%;height:100%;overflow:hidden;background:#000;color:#fff;position:absolute;z-index:99999999; background-color:#000;opacity:1.0;filter:alpha(opacity=100);margin:0 auto;top:0;left:0;}
.noscript h1{font-size:36px;margin-top:50px;text-align:center;line-height:40px;}
html {overflow-x:hidden;overflow-y:hidden;}/*禁止出现滚动条*/
</style>
<div class="noscript">
<h1>
您的浏览器不支持JavaScript，请启用后重试！
</h1>
</div>
</noscript>

	<!--头部导航区域 START-->
	<div id="top_head_nav">


		<!--logo区域-->
		<div class="cmf_logo">
			<div class="yas_logo"><img src="{{ asset('assets/img/yas_logo.png') }}" width="40" height="40" alt="芽丝CMF" /><span>芽丝CMF</span></div>
		</div>

		

		<!--使用模版引擎laytpl-->
		<ul class="cmf_top_menu" id="cmf_top_menu_view">
		</ul>
		<script id="cmf_top_menu_tpl" type="text/html">
{%# var i = isNaN(parseInt(d.cur_top))?0:parseInt(d.cur_top);  /*顶级导航索引*/ %}
{%# for(var m = 0, len = d.list.length; m < len; m++){ %}
	<li class="{% (m===i)?'current':'' %}">
		<a href="{% d.list[m].anchor %}"><i class="fa fa-fw {% d.list[m].icon %}"></i>  {% d.list[m].title %}</a>
	</li>
{%# } %}
		</script>

		
		<!--管理用户操作区-->
		<div class="cmf_operate">
			<ul>
				<li>
					<a href="{{ route('home') }}"><i class="fa fa-desktop fa-fw" title="前台首页"></i></a>
				</li>
				<li class="usr_op">
					<a href="#"><i class="fa fa-user fa-fw" title="当前用户"></i></a>
					<div class="li_usr_op_tips fn-hide">
						<ul>
							<li>您好，<em>{{ user('nickname') }}</em></li>
							<li><a href="{{ route('admin.me.index') }}">个人资料</a></li>
							<li><a href="{{ route('logout') }}">退出</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>

	</div>
	<!--头部导航区域 END /-->
