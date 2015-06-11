@extends('layout._back')

@section('content-header')
@parent
          <h1>
            用户管理
            <small>管理员</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">用户管理 - 管理员</li>
          </ol>
@stop

@section('content')

              @if(Session::has('message'))
                <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                  {{ Session::get('message') }}
                </div>
              @endif

              <a href="{{ route('admin.user.create') }}" class="btn btn-primary margin-bottom">新增管理员</a>

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">管理员列表</h3>
                  <div class="box-tools">
                    <form action="{{ route('admin.user.index') }}" method="get">
                      <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_name" value="{{ Input::get('s_name') }}" style="width: 150px;" placeholder="搜索用户登录名或昵称或真实姓名">
                        <input type="text" class="form-control input-sm pull-right" name="s_phone" value="{{ Input::get('s_phone') }}" style="width: 150px;" placeholder="搜索用户手机号">
                        <div class="input-group-btn">
                          <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover table-bordered">
                    <tbody>
                      <!--tr-th start-->
                      <tr>
                        <th>操作</th>
                        <th>编号</th>
                        <th>登录名 / 昵称</th>
                        <th>真实姓名</th>
                        <th>角色(用户组)</th>
                        <th>状态</th>
                        <th>最后一次登录时间</th>
                      </tr>
                      <!--tr-th end-->
                      @foreach ($users as $user)
                      <tr>
                        <td>
                          <a href="{{ route('admin.user.index') }}/{{ $user->id }}/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>  
                        </td>
                        <td>{{ $user->id }}</td>
                        <td class="text-muted">{{ $user->username }} / {{ $user->nickname }}</td>
                        <td class="text-green">
                          {{ $user->realname }}
                        </td>
                        <td class="text-red">
                          @if(null !== $user->roles->first())  {{-- 某些错误情况下，会造成管理用户没有角色 --}}
                          {{ $user->roles->first()->name }}
                          @else
                          空(NULL)
                          @endif
                        </td>
                        <td class="text-yellow">
                          @if($user->is_lock)
                          锁定
                          @else
                          正常
                          @endif
                        </td>
                        <td>{{ $user->updated_at }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $users->render() !!}
                </div>

                <!--隐藏型删除表单-->
                <form method="post" action="{{ route('admin.user.index') }}" accept-charset="utf-8" id="hidden-delete-form">
                <input name="_method" type="hidden" value="delete">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>

              </div>
@stop


@section('filledScript')
        <!--jQuery 提交表单，实现DELETE删除资源-->
        //jQuery submit form
        $('.delete_item').click(function(){
            var action = '{{ route('admin.article.index') }}';
            var id = $(this).data('id');
            var new_action = action + '/' + id;
            $('#hidden-delete-form').attr('action', new_action);
            $('#hidden-delete-form').submit();
        });
@stop
