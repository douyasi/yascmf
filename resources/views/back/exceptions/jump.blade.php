<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	@if(isset($rurl))
	<meta http-equiv="refresh" content="2;url={{ $rurl }}">
	@else
	<meta http-equiv="refresh" content="2;url={{ url('') }}">
	@endif
	<title>YASCMF - 异常</title>
	<style type="text/css">
body {
	font-size: 14px;
	line-height: 20px;
	font-family: 'Helvetica Neue', Helvetica, Arial, '\5FAE\8F6F\96C5\9ED1', 'Hiragino Sans GB', sans-serif;
	-webkit-font-smoothing: antialiased;
}
	</style>
</head>
<body>
<noscript>
<style type="text/css">
.noscript{ width:100%;height:100%;overflow:hidden;background:#000;color:#fff;position:absolute;z-index:99999999; background-color:#000;opacity:1.0;filter:alpha(opacity=100);margin:0 auto;top:0;left:0;}
.noscript h1{font-size:36px;margin-top:50px;text-align:center;line-height:40px;}
html {overflow-x:hidden;overflow-y:hidden;}/*禁止出现滚动条*/
.noscript p.error{color:#ff0;text-align:center;}
</style>

<div class="noscript">
<p class="error">{{ $exception }}</p>
<h1>
您的浏览器不支持JavaScript，请启用后重试！
</h1>
</div>
</noscript>
<style type="text/css">
.jump_info{ width:100%;height:100%;overflow:hidden;background:#000;color:#fff;position:absolute;z-index:99999999; background-color:#000;opacity:1.0;filter:alpha(opacity=100);margin:0 auto;top:0;left:0;}
.jump_info p.error{color:#ff0;text-align:center;}
.jump_info p.info{text-align:center;color:#f00;}
.jump_info p a{color:#fff;text-decoration:none;}
</style>
<div class="jump_info">
<p class="error">{{ $exception }}</p>
<p class="info">2秒之后会自动跳转，手动跳转到<a href="{{ route('admin') }}">首页</a></p>
</div>
</body>
</html>



