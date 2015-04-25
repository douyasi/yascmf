@extends('layout._base')

@section('title') Layer - YASCMF @stop

@section('meta')
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
@stop

@section('head_css')
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('dist/css/yascmf.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('head_js')
    <!--这里使用旧版jQuery-->
    <script type="text/javascript" src="{{ asset('plugins/jQuery/jQuery-1.8.3.min.js') }}"></script>
@stop

@section('body')
    <div class="close_button">{{-- 自定义关闭 按钮 --}}
        <a href="javascript:void(0);" class="avgrund-close">close</a>
    </div>
    <div class="yascmf_layer">
        @section('mainLayerCon')
        @show{{-- layer表单页面主体内容 --}}
    </div>
@stop

@section('afterBody')
@parent
    @section('endChosen')
    @show{{-- chosen下拉选择表单 --}}
    @section('endLayerJS')
    @show{{-- layer响应部分事件JS --}}
@stop
