# 芽丝内容管理框架(YASCMF)


> 芽丝内容管理框架( 英文简称 `YASCMF` )， 基于 `Laravel 5` 开发而成，它比较适合拿来做一些小众项目开发。目前框架实现了一个简单的内容管理系统（ `CMS` ），支持多种内容模型，文章、单页、分类、碎片与标签，您现在完全可以拿它来完成一个简单的博客网站。

> YASCMF 已正式发布新版（基于 `Laravel 5` ），目前官方给出一个由其驱动的 [博客演示网站](http://www.yas.so) ，欢迎访问了解。

欢迎加入群交流，官方QQ群：260655062 。

###安装说明

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
```
echo. > .env
```

② 导入数据库，并修改 `.env` 配置文件：

请将源码包根目录下 `yascmf_app.sql` 导入数据库，默认使用 `UTF-8` 编码，`utf8_unicode_ci`作为排序规则。

请根据数据库与服务器实际情况修改 `.env` 配置文件，这里给出一个示例。
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=RrQvzbUxaKIlj74s3hOYClGQ71zoVixr

DB_HOST=localhost
DB_DATABASE=yascmf_app
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=file
SESSION_DRIVER=file
```
③ 服务器绑定域名，并将文档根目录设置为源码包 `public` 目录下，给 `storage` 目录可写权限。

④ 访问服务器绑定的域名，如果能访问演示站类似的前台界面，说明您已经安装成功。

⑤ 登录后台，后台使用的帐号与密码均为 `admin`，登入之后，您可以体验一番。

###源码学习

>    对于有一定PHP基础，但对 `Laravel` （特别是新版5）框架不熟练的人，通过阅读本源码可以学习到啥呢？

下面简单的说下本源项目使用到 `Laravel` 自身一些功能、组件与扩展，您可以对照 `Laravel 5` 中文文档，阅读理解本源码。

####后端框架
① 实现自定义验证扩展，如验证国内手机号、身份证证号等；  
② 实现自定义分页样式扩展，不是那种类似 `Bootstrap` 分页样式的扩展；  
③ 了解仓库（Repository）设计模式；  
④ 理解 `Laravel` 事件（Event）以及其监听触发方法；  
⑤ 掌握使用 `Entrust` （Laravel 5适配版本）包来实现角色与权限的控制；  
⑥ 理解 `Http` 层中间件（Middleware）、请求（Request）与控制器（Controller）三者之间的关系；  
⑦ 缓存的使用；  
⑧ Blade模版继承、嵌套与扩展等；  
⑨ 服务容器、自动注入等概念的了解；  
⑩ ......

如果您对前端也有些了解，那么分析本系统前后台代码，也许您能掌握下面前端知识点：

####前端页面
① JS模版引擎  
② Ajax与Json  
③ jQuery
④ CKEditor 网页编辑器    
⑤ Bootstrap 前端框架  
⑥ JS弹窗组件  
⑦ CSS与JS静态资源的压缩与合并  
⑧ ......

###文档

关于本源码的文档正在完善中，您可以留意博客分享的文章，或者加群反馈意见或建议。

###联系作者

Email: raoyc <raoyc2009@gmail.com>  
官网：http://douyasi.com | http://www.yas.so  
QQ群：260655062