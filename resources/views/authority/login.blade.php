@extends('layout.base')

@section('title') 登录 - YASCMF @stop

@section('head_style')
<style type="text/css">
body{font-family:Georgia,Tahoma,"Microsoft YaHei",SimSun;font-size:12px;background:url('{{ asset('assets/img/bg/bg.jpg') }}') no-repeat scroll center center;}
.clearfix:after{content:".";display:block;height:0;clear:both;visibility:hidden;}
a{text-decoration:none;color:#999;}
a:hover{text-decoration:underline;}
img{vertical-align:middle;margin-top:-4px;}
#login_wrapper {width: 960px;margin: 10px auto;}
#login_box{width:420px;margin:15% auto;}
.lb_top{width:420px;height:90px;margin:0 auto;background-color:#1995dc;}
#lb_title{text-align:center;font-weight:bold;font-size:20px;color:#fff;margin:10px;padding:30px;}
.lb_form{width:420px;background-color:#fff;padding-top:20px;padding-bottom:20px;text-align:center;}
#login_form input{display:block;width:200px;margin:20px;padding:5px;color:#000;border:1px solid #333;clear:both;}
input,textarea,select {font-size:12px;font-family:Georgia,"Times New Roman",Times,serif;}
input#sf_submit {display:block;width:120px;font-size:12px;font-weight: bold;text-transform: uppercase;color:#fff;background-color: #1995dc;border:none;cursor:pointer;}
.lb_bottom{width:420px;height:50px;background-color:#1995dc;text-align:center;padding-top:20px;font-size:14px;color:#f0f0f0;}
.lb_bottom a{color:#fff;}
.error{color:#f00;}
</style>
@parent
@stop

@section('body')
	<div id="login_wrapper">
		<div id="login_box">
			<div class="lb_top">
				<div id="lb_title"><a href="{{ url('') }}"><img src="{{ asset('assets/img/yas_logo.png')}}" /></a> - 芽丝CMF</div>
			</div>
			<div class="lb_form" class="clearfix">
				{!! Form::open(array('route' => 'login','id' => 'login_form', 'method' => 'post')) !!}
				
					{!! Form::text('username',null,array('placeholder'=>'请输入用户名', 'class' => 'input_text', 'id' =>'username', 'maxlength'=>20, 'onFocus' => "this.value=(this.value=='UserName')? '' : this.value;")) !!}
					{!! Form::password('password', array('placeholder'=>'请输入用户密码', 'class' => 'input_text', 'id' =>'password', 'maxlength'=>20, 'onFocus' => "this.value=(this.value=='PassWord')? '' : this.value;")) !!}
					{!! Form::submit('登录',array('id' => 'sf_submit')) !!}
				{!! Form::close() !!}
				<!--<form action="" method="post" accept-charset="utf-8" id="login_form">-->
					<!--
					<input type="text" name="username" value="UserName" class="input_text" id="username" maxlength="20" onFocus="this.value=(this.value=='UserName')? '' : this.value;">
					<input type="password" name="password" value="Password" class="input_text" id="password" maxlength="20" onFocus="this.value=(this.value=='Password')? '' : this.value;">
					<input type="submit" name="" value="登录" id="sf_submit">
					-->
				<!--</form>-->
				<p class="error">{!! $errors->first('attempt') !!}</p>
			</div>
			<div class="lb_bottom">
				<p>Copyright &copy; 2011 - {{ date('Y') }} All by <a href="http://douyasi.com/" />Douyasi</a></p>
			</div>
		</div>
	</div>
@stop
