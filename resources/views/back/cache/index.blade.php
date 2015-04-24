@extends('layout._back')

@section('content-header')
@parent
          <h1>
            控制面板
            <small>重建缓存</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">控制面板 - 重建缓存</li>
          </ol>
@stop

@section('content')
        <div class="callout callout-info">
          <h4><i class="icon fa fa-check"></i> 提示</h4>
          <p>重建缓存成功！</p>
        </div>
@stop
