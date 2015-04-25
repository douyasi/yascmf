			<!--左侧导航栏 START-->
			<!--使用模版引擎laytpl-->
<script id="left_sidebar_tpl" type="text/html">
				<ul class="nav_list">
			{%# var i = isNaN(parseInt(d.cur_top))?0:parseInt(d.cur_top);  /*顶级导航索引*/ %}
			{%# for(var m = 0, len = d.list[i].submenu.length; m < len; m++){ %}

				<li>

				{%# if(d.list[i].submenu[m].sub === undefined) { %}
					<a href="{% d.list[i].submenu[m].link %}"><h3>{% d.list[i].submenu[m].name %}</h3></a>
				
				{%# } else{ %}
					<h3>{% d.list[i].submenu[m].name %}<i class="fa fa-angle-down"></i></h3>
					<ul class="submenu">

						{%# for(var n =0, l = d.list[i].submenu[m].sub.length; n < l; n++) { %}

							<li><a href="{% d.list[i].submenu[m].sub[n].sublink %}">{% d.list[i].submenu[m].sub[n].subname %}</a></li>

						{%# } %}

					</ul>
				{%# } %}

				</li>

			{%# } %}
				</ul>
</script>
			<div class="left_sidebar" id="left_sidebar_view">
			</div>
			<!--左侧导航栏 END /-->
<script type="text/javascript">
//假设你得到了这么一段数据
var data = {
	desc: '导航区域',
	list: [
		{
			index: 0,
			anchor: '{{ route('admin.console.index') }}', icon: 'fa-home', title: '控制台', 
			submenu: [
				{link: '{{ route('admin.console.index') }}', name: '概要'},
				{link: '{{ route('admin.cache') }}', name: '重建缓存'}
			]
		},
		{
			index: 1,
			anchor: '{{ route('admin.article.index') }}', icon: 'fa-edit', title: '内容管理', 
			submenu: [
				{link: '{{ route('admin.article.index') }}', name: '文章'},
				{link: '{{ route('admin.page.index') }}', name: '单页'},
				{link: '{{ route('admin.fragment.index') }}', name: '碎片'},
				{link: '{{ route('admin.category.index') }}', name: '分类'},
				{link: '{{ route('admin.tag.index') }}', name: '标签'}
			]
		},
		{
			index: 2,
			anchor: '{{ route('admin.user.index') }}', icon: 'fa-user', title: '用户管理', 
			submenu: [
				{link: '{{ route('admin.me.index') }}', name: '我的账户'},
				{link: '{{ route('admin.user.index') }}', name: '管理型用户'},
				{
					link: '#jsqx', name: '角色权限', sub: [
						{sublink: '{{ route('admin.role.index') }}', subname: '角色(用户组)'},
						{sublink: '{{ route('admin.permission.index') }}', subname: '权限'}
					]
				}
			]
		},
		{
			index: 3,
			anchor: '{{ route('admin.business.index') }}', icon: 'fa-coffee', title: '业务管理', 
			submenu: [
				{link: '{{ route('admin.flow') }}', name: '业务流程'},
			]
		},
		{
			index: 4,
			anchor: '{{ route('admin.system_option.index') }}', icon: 'fa-cog', title: '系统管理',
			submenu: [
				{link: '{{ route('admin.system_option.index') }}', name: '系统配置'},
				{
					link: '#dtszgl', name: '动态设置', sub: [
						{sublink: '{{ route('admin.setting_type.index') }}', subname: '动态设置分组'},
						{sublink: '{{ route('admin.setting.index') }}', subname: '动态设置'}
					]
				},
				{link: '{{ route('admin.system_log.index') }}', name: '系统日志'}
			]
		}
	],
	cur_top:0  //顶级导航高亮索引
};

//这里尝试采用类似Laravel路由别名的方式来维护路由与索引对应关系表map，map可以通过cookies缓存起来
var list = data.list;
var map = {}, i = index = 0;
for(var listIndex in list){
	for(var submenuIndex in list[listIndex]['submenu']){
		map[i] = { 'url': list[listIndex]['submenu'][submenuIndex]['link'], 'index': listIndex };
		i++;
		if(list[listIndex]['submenu'][submenuIndex]['sub'] !== undefined){
			for(var subIndex in list[listIndex]['submenu'][submenuIndex]['sub'])
			{
				map[i] = { 'url': list[listIndex]['submenu'][submenuIndex]['sub'][subIndex]['sublink'], 'index': listIndex };
				i++;
			}
		}
	}
}
for(var mapIndex in map){
	if(map[mapIndex]['url'] === '{{ cur_nav(Route::currentRouteName()) }}' )
	{
		index = map[mapIndex]['index'];
	}
}
console.log(map);

var options =  {open: '{%', close: '%}'};  //设置laytpl模版开闭标签，以避免与Laravel blade标签重合
laytpl.config(options);
var tpl1 = document.getElementById('cmf_top_menu_tpl').innerHTML; //读取模版
//方式一：异步渲染（推荐）
data.cur_top = index;
laytpl(tpl1).render(data, function(render1){
	document.getElementById('cmf_top_menu_view').innerHTML = render1;
});

var tpl2 = document.getElementById('left_sidebar_tpl').innerHTML;

laytpl(tpl2).render(data,function(render2){
	document.getElementById('left_sidebar_view').innerHTML = render2;
});
</script>
