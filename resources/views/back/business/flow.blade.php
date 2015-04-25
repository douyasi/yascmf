@extends('layout._back')

@section('content-header')
@parent
          <h1>
            业务管理
            <small>业务流程</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">业务管理 - 业务流程</li>
          </ol>
@stop

@section('content')

              <div class="box box-primary">

                <div class="box-header with-border">
                  <h3 class="box-title">业务流程</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <p>您可以在“业务管理”大栏目下建立子模块栏目来进行二次开发。目前版本的导航栏也给出诸多未实现的子栏目链接。</p>
                  <p>有关芽丝二次开发的问题请留意官网相关文档或文章，您也可在 <a href="https://github.com/">GitHub</a> 上对某些问题发出 <a href="https://github.com/douyasi/yascmf/issues">Issue</a> 或者 加Q群 <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=c43a551e4bc0ff5c5051ec8f6d901ab21c1e89e3001d6cf0b0b4a28c0fa4d4f8">260655062</a> 讨论。</p>
                </div><!-- /.box-body -->

              </div>

@stop
