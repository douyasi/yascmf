@extends('layout._back')

@section('content-header')
@parent
          <h1>
            异常
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">异常</li>
          </ol>
@stop

@section('content')
        <div class="callout callout-danger">
          <h4><i class="icon fa fa-ban"></i> 异常警告：403错误 权限不足</h4>
          <p>您没有权限访问当前页面内容，请联系超级管理员或访问其它页面节点！</p>
        </div>
@stop

