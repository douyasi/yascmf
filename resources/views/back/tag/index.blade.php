@extends('layout._back')

@section('content-header')
@parent
          <h1>
            标签
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">标签</li>
          </ol>
@stop

@section('content')

              <div class="box box-primary">

                <div class="box-header with-border">
                  <h3 class="box-title">标签</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <p>等待后续开发...</p>
                </div><!-- /.box-body -->

              </div>

@stop
