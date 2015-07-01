      {{-- widget.main-sidebar --}}

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('dist/img/20150417113714.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>{{ user('realname') }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="搜索..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">主导航栏</li>
            
            <!--含子节点 且当前状态为active 的一级导航节点-->
            <!--控制台 active treeview-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i>
                <span>控制面板</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.console.index') }}"><i class="fa fa-circle-o"></i> 概述</a></li>
                <li><a href="{{ route('admin.me.index') }}"><i class="fa fa-circle-o"></i> 个人资料</a></li>
                <li><a href="{{ route('admin.cache') }}"><i class="fa fa-circle-o"></i> 重建缓存</a></li>
              </ul>
            </li>
            <!--//控制台 active treeview-->

            <!--内容管理 treeview-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i>
                <span>内容管理</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.article.index') }}"><i class="fa fa-file-o"></i> 文章</a></li>
                <li><a href="{{ route('admin.page.index') }}"><i class="fa fa-file-o"></i> 单页</a></li>
                <li><a href="{{ route('admin.fragment.index') }}"><i class="fa fa-file-o"></i> 碎片</a></li>
                <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-file-o"></i> 分类</a></li>
              </ul>
            </li>
            <!--//内容管理 treeview-->

            <!--无子节点的一级导航节点-->
            <li><a href="#"><i class='fa fa-book'></i> <span>写作</span></a></li>
            <li><a href="{{ route('admin.tag.index') }}"><i class="fa fa-tags"></i> <span>标签</span></a></li>

            <!--讨论 treeview-->
            <li class="treeview">
              <a href="#">
                <i class='fa fa-comments-o'></i>
                <span>讨论</span>
                <small class="label pull-right bg-green">New</small>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-square-o"></i>节点</a></li>
                <li><a href="#"><i class="fa fa-square-o"></i>话题</a></li>
                <li><a href="#"><i class="fa fa-square-o"></i>审核</a></li>
                <li><a href="#"><i class="fa fa-square-o"></i>举报</a></li>
                <li><a href="#"><i class="fa fa-square-o"></i>论友</a></li>
              </ul>
            </li>
            <!--//讨论 treeview-->

            <!--用户管理 treeview-->
            <li class="treeview">
              <a href="#"><i class='fa fa-user'></i>
                <span>用户管理</span>
                <small class="label pull-right bg-red">5</small>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-circle-o"></i>管理员</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>注册用户</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>付费客户</a></li>
                <li><a href="{{ route('admin.role.index') }}"><i class="fa fa-circle-o"></i>角色</a></li>
                <li><a href="{{ route('admin.permission.index') }}"><i class="fa fa-circle-o"></i>权限</a></li>
              </ul>
            </li>
            <!--//用户管理 treeview-->

            <!--业务管理 treeview-->
            <li class="treeview">
              <a href="#"><i class='fa fa-coffee'></i>
                <span>业务管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.flow') }}"><i class="fa fa-sitemap"></i>业务流程</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i>信息 <span class="label label-success pull-right">4</span></a></li>
                <li><a href="#"><i class="fa fa-bell-o"></i>通知 <span class="label label-warning pull-right">10</span></a></li>
                <li><a href="#"><i class="fa fa-flag-o"></i>任务 <span class="label label-danger pull-right">9</span></a></li>
              </ul>
            </li>
            <!--//业务管理 treeview-->

            <!--系统管理 treeview-->
            <li class="treeview">
              <a href="#"><i class='fa fa-cog'></i>
                <span>系统管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('admin.system_option.index') }}"><i class="fa fa-square-o"></i>系统配置</a></li>
                <li><a href="{{ route('admin.setting_type.index') }}"><i class="fa fa-square-o"></i>动态设置分组</a></li>
                <li><a href="{{ route('admin.setting.index') }}"><i class="fa fa-square-o"></i>动态设置</a></li>
                <li><a href="{{ route('admin.system_log.index') }}"><i class="fa fa-square-o"></i>系统日志</a></li>
                <li><a href="#"><i class="fa fa-square-o"></i>邮件日志</a></li>
              </ul>
            </li>
            <!--//系统管理 treeview-->

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
