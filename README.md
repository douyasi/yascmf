# 芽丝内容管理框架(YASCMF)


> 芽丝内容管理框架( 英文简称 `YASCMF` )， 基于 `Laravel 5` 开发而成，它比较适合拿来做一些小众项目开发。目前框架实现了一个简单的内容管理系统（ `CMS` ），支持多种内容模型，文章、单页、分类、碎片与标签，您现在完全可以拿它来完成一个简单的博客网站。

> YASCMF 已正式发布新版（基于 `Laravel 5` ），目前官方给出一个由其驱动的 [博客演示网站](http://www.yas.so) ，欢迎访问了解。

欢迎加入群交流，官方QQ群：260655062 。

### 更新说明

#### 2015-05-22

修正一些错误，更新 `AdminLTE` 到 `v2.1.1` 。

#### 2015-06-11

更新框架到 `Laravel 5.1 TLS` ，一次升级，永不痛苦！

* 注意：该版数据库表结构有些变化，建议全新安装 `YASCMF` ；  
* 在本系统基础上有二次开发的，请自行备份旧版进行比较，手动升级；
* 源码根目录下提供一个从旧版升级到新版的SQL脚本 `upgrade.sql` ，可以尝试在旧有数据库中执行完成数据库表的升级，**升级前请注意备份相关数据，源码作者不保证不出任何差错**。

#### 2015-07-01

开启 `tag releases`，发布 YASCMF `v5.1.0` 版

* 增加文章推荐位( `flags` )，数据库结构有变动，多出 `yascmf_flags` 表，请重新导入 `yascmf_app.sql`，有二开的请自行比较数据变化，手动升级迁移；
* 增加 `ArticleService` 类，并将内容相关的 `SLUG` 链接生成方法放置于此，模板中使用 `@inject` （Laravel 5.1 LTS新增功能）服务注入，注意本版前台模板（位于 `/resource/front` 目录）文件有较大变化，可查询对比 `commit` 记录；
* 其他一些bug修复，增加自定义扩展标签等

### 安装说明

① 下载源码包：

你可以通过多种方式下载源码（如HTTP下载，Git克隆），下载之后进入源码目录，使用 `composer` 安装PHP依赖，生成 `.env` 配置文件。

Linux 下可执行下面命令：

```bash
git clone https://github.com/douyasi/yascmf.git
cd yascmf
composer install
touch .env
```
Windows 下生成 `.env` 文件可以在命令行输入下面命令：

```bash
echo. > .env
```

② 导入数据库，并修改 `.env` 配置文件：

请将源码包根目录下 `yascmf_app.sql` 导入数据库，默认使用 `UTF-8` 编码，`utf8_unicode_ci`作为排序规则。

请根据数据库与服务器实际情况修改 `.env` 配置文件，这里给出一个示例。

```php
APP_ENV=local
APP_DEBUG=true
APP_KEY=RrQvzbUxaKIlj74s3hOYClGQ71zoVixr

DB_HOST=localhost
DB_DATABASE=yascmf_app
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

③ 服务器绑定域名，并将文档根目录设置为源码包 `public` 目录下，给 `storage` 目录可写权限，如果后台需要上传图片请给 `public\uploads` 可写权限，如果使用 `minify` 来压缩与合并 `CSS` 与 `JS` 静态资源，请给 `public\min\tmp` 可写权限。

④ 访问服务器绑定的域名，如果能访问演示站类似的前台界面，说明您已经安装成功。

⑤ 登录后台，后台使用的帐号与密码均为 `admin`，登入之后，您可以体验一番。

### 界面展示

#### 前台

在线演示网站为：http://www.yas.so 。

![20150426223732.jpg][1]

![20150426223807.jpg][2]

![20150426223857.jpg][3]


#### 后台

新的后台模版基于 [AdminLTE][4] ， 经过本人修改以适配当前系统 。
`AdminLTE` 后台拥有 12 套配色皮肤，响应式布局，支持电脑、平板和手机各个终端。

![20150426223913.jpg][5]

![20150426223938.jpg][6]

![20150426224002.jpg][7]


### 源码学习


通过阅读本源码结合 `Laravel 5`  [中文文档](http://laravel-china.org/docs/5.0)，您能学习、理解或掌握框架自身功能、架构与服务，加强  `Laravel`  的实践操作能力：

① 实现[自定义验证扩展](https://github.com/douyasi/yascmf/blob/master/app/Extensions/DouyasiValidator.php)，如验证国内手机号、身份证证号等；  
② 实现[自定义分页样式扩展](https://github.com/douyasi/yascmf/blob/master/app/Extensions/DouyasiPresenter.php)，不是那种类似 Bootstrap 分页样式；  
③ 了解仓库（Repository）设计模式（注意本系统后台使用了[仓库](https://github.com/douyasi/yascmf/tree/master/app/Repositories)，前台没有）;  
④ 理解 Laravel [事件](https://github.com/douyasi/yascmf/blob/master/app/Handlers/Events/UserEventHandler.php) 以及其[监听触发方法](https://github.com/douyasi/yascmf/blob/master/app/Http/Controllers/AuthorityController.php#L42)；  
⑤ 掌握使用 `Entrust` （[Laravel 5适配版本](https://github.com/Zizaco/entrust/tree/laravel-5)）包来实现角色与权限的控制；  
⑥ 理解 `Http` 层 中间件（`Middleware`） 、 请求（`Request`） 与 控制器（`Controller`） 三者之间的关系；  
⑦ 在控制器中结合 [Request](https://github.com/douyasi/yascmf/blob/master/app/Http/Requests/ArticleRequest.php)  实现[表单验证](https://github.com/douyasi/yascmf/blob/master/app/Http/Controllers/Admin/AdminArticleController.php#L94)；  
⑧ [缓存](https://github.com/douyasi/yascmf/blob/master/app/Cache/DataCache.php#L80)的使用；  
⑨ `Blade` 模版继承、嵌套与[扩展](https://github.com/douyasi/yascmf/blob/master/app/Extensions/DouyasiBlade.php)等；  
⑩ 服务容器、自动注入等概念的了解；  
......

前端方面知识或技术要点：

① `Javascript` 模版引擎   [laytpl](http://sentsin.com/layui/laytpl/)  
② `Ajax` 与 `JSON`  
③  `jQuery` 响应事件及其使用  
④ `CKEditor` 网页编辑器  
⑤ `Bootstrap` 前端框架  
⑥ `JS` 弹窗组件 [Layer](http://sentsin.com/jquery/layer/)  
⑦ `CSS` 与 `JS` 静态资源的压缩与合并（使用 [minify](https://github.com/douyasi/yascmf/blob/master/app/functions.php#L76) ）  
......


###文档

[第三方文档参考](https://github.com/douyasi/yascmf/wiki/%E8%8A%BD%E4%B8%9D%E5%86%85%E5%AE%B9%E7%AE%A1%E7%90%86%E6%A1%86%E6%9E%B6%E9%83%A8%E5%88%86%E6%8A%80%E6%9C%AF%E6%96%87%E6%A1%A3%E5%8F%82%E8%80%83)

关于本源码的文档正在完善中，您可以留意博客分享的文章，或者加群反馈意见或建议。

###联系作者

Email: raoyc <raoyc2009@gmail.com>  
官网：http://douyasi.com | http://www.yas.so  
QQ群：260655062


  [1]: http://douyasi.com/usr/uploads/2015/04/3530676302.jpg
  [2]: http://douyasi.com/usr/uploads/2015/04/2716073848.jpg
  [3]: http://douyasi.com/usr/uploads/2015/04/913925879.jpg
  [4]: https://github.com/almasaeed2010/AdminLTE
  [5]: http://douyasi.com/usr/uploads/2015/04/2937226833.jpg
  [6]: http://douyasi.com/usr/uploads/2015/04/1471181251.jpg 
  [7]: http://douyasi.com/usr/uploads/2015/04/2433451104.jpg
