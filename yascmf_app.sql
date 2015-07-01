/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50704
Source Host           : localhost:3306
Source Database       : yascmf_app

Target Server Type    : MYSQL
Target Server Version : 50704
File Encoding         : 65001

Date: 2015-07-01 22:02:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yascmf_contents
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_contents`;
CREATE TABLE `yascmf_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `flag` varchar(15) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '推荐位',
  `title` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT '文章/单页/碎片/备忘标题',
  `thumb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文章/单页缩略图',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '文章/单页/碎片/备忘正文',
  `slug` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '网址缩略名，文章、单页与碎片模型有缩略名，其它模型暂无',
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'article' COMMENT '内容类型：article文章模型 page单页模型 fragment碎片模型 memo备忘模型',
  `user_id` int(12) NOT NULL DEFAULT '0' COMMENT '文章编辑用户id',
  `is_top` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否置顶：1置顶，0不置顶',
  `owner_id` int(12) unsigned DEFAULT '0' COMMENT '归属用户id:一般备忘有归属用户id，0表示无任何归属',
  `outer_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '外链地址',
  `category_id` int(10) NOT NULL COMMENT '文章分类id',
  `deleted_at` datetime DEFAULT NULL COMMENT '被软删除时间',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_slug_unique` (`slug`),
  KEY `content_title_index` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='内容数据（文章/单页/碎片/备忘）表';

-- ----------------------------
-- Records of yascmf_contents
-- ----------------------------
INSERT INTO `yascmf_contents` VALUES ('1', '', '你好，世界！', '', '&lt;p&gt;你好，世界！&lt;/p&gt;\n\n&lt;p&gt;芽丝CMF，欢迎您的使用！&lt;/p&gt;\n', null, 'article', '1', '0', '0', null, '1', null, '2015-01-23 15:54:54', '2015-01-23 15:54:54');
INSERT INTO `yascmf_contents` VALUES ('2', '', '关于', '', '&lt;blockquote&gt;\n&lt;p&gt;即使再渺小，也要不顾一切地成长&lt;/p&gt;\n&lt;/blockquote&gt;\n\n&lt;p&gt;笔者目前从事互联网相关编程工作，掌握多种前后端技能，正在努力成长为全栈型码农。&lt;/p&gt;\n\n&lt;p&gt;完整关于介绍，请查阅下面链接：&lt;/p&gt;\n\n&lt;p&gt;&lt;a href=&quot;http://douyasi.com/about.html&quot;&gt;http://douyasi.com/about.html&lt;/a&gt;&lt;/p&gt;\n\n&lt;p&gt;如需反馈问题、提出意见或建议，请通过以下方式联系作者。&lt;/p&gt;\n\n&lt;p&gt;Email：admin#yun-apps&amp;com 或 837454876#qq&amp;com (请将#换成@，&amp;换成.)&lt;/p&gt;\n\n&lt;p&gt;Github：https://github.com/douyasi&lt;/p&gt;\n\n&lt;p&gt;官方QQ群： 260655062&lt;/p&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n', 'about', 'page', '1', '0', '0', null, '0', null, '2015-02-09 15:48:58', '2015-02-10 14:16:00');
INSERT INTO `yascmf_contents` VALUES ('3', '', 'YASCMF', '', '&lt;h1&gt;何为内容管理框架？&lt;/h1&gt;\n\n&lt;p&gt;首先，我们要理解何为框架？ `框架` 就是被构建过的一套基础的环境，比如`Laravel` 框架，就实现 `PHP` `MVC` 三层架构，支持 `PHP` 最新特性，可以很方便地使用 `composer` 来进行包依赖管理等。那内容管理框架也是如此，我们可以拿 **在土地上建房子** 这件事情来作为比喻： **操作系统** ( `OS` ) 与 **特定语言环境** ( `PHP` ) 就是其中的 **土地** ，`Laravel` 框架就是其中的 **地基** 、 **水泥** 与 **砖块** ，而 **内容管理框架** 就是 **房屋设计图** 、 **门窗** 与 **支柱** ，建成的 **房子** 就是最后完成的 **业务系统** 。&lt;/p&gt;\n\n&lt;p&gt;项目开发的目的是为了完成某项特定的业务与需求，项目一旦开展起来，您就会发现，构建一套合理、美观的后台是您要优先考虑的事情，也是很重要的事情。后台页面布局、导航的设计与实现（这里可能更多地涉及到前端知识）很花费时间，在大型的研发公司里面，这些都是由专门的设计与前端团队来负责。而对于一些小公司与不懂前端的后端程序员来说，这些基础构建工作很棘手与繁琐。内容管理框架（ `CMF` ）应运而生，它给您提供一套基础的内容管理后台，以便让您在此基础上快捷（二次）开发，从而更专心地投入到后端编码中。&lt;/p&gt;\n\n&lt;h1&gt;芽丝内容管理框架简介&lt;/h1&gt;\n\n&lt;p&gt;芽丝内容管理框架( 英文简称 `YASCMF` / `yascmf`，后文称 `yascmf` )， 基于 `Laravel 4` 开发而成，它比较适合拿来做一些小众项目开发。目前框架实现了一个简单的内容管理系统（ `CMS` ），支持多种内容模型，文章、单页、分类、碎片与标签，您现在完全可以拿 `yascmf` 来完成一个简单的博客网站。待 `yascmf` 正式上线发布时，官方会给出一个演示博客网站。&lt;/p&gt;\n', 'yascmf', 'page', '1', '0', '0', '', '0', null, '2015-02-09 15:50:45', '2015-03-11 23:48:38');
INSERT INTO `yascmf_contents` VALUES ('4', '', '使用PhantomJS实现网页截图', '', '&lt;blockquote&gt;\n&lt;p&gt;PhantomJS (http://phantomjs.org) 是一个无界面的Webkit内核浏览器，对DOM操作、CSS选择器、JSON、Canvas和SVG等WEB标准有非常快的、原生的支持。总之PhantomJS就是一个有API的浏览器，可以用来进行网页截图、自动化测试等。&lt;/p&gt;\n&lt;/blockquote&gt;\n\n&lt;h2&gt;安装依赖&lt;/h2&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-bash&quot;&gt;//debian/ubuntu\nsudo apt-get install build-essential chrpath libssl-dev libfontconfig1-dev\n//centos\nsudo yum install gcc gcc-c++ make openssl-devel freetype-devel fontconfig-devel&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n\n&lt;h2&gt;下载源码编译安装&lt;/h2&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-bash&quot;&gt;wget https://phantomjs.googlecode.com/files/phantomjs-1.9.2-source.zip\nunzip phantomjs-1.9.2-source.zip &amp;&amp; cd phantomjs-1.9.2\n./build.sh\nsudo cp phantomjs /usr/bin/phantomjs&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n\n&lt;h2&gt;使用PhantomJS截图&lt;/h2&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-bash&quot;&gt;wget https://raw.github.com/ariya/phantomjs/master/examples/rasterize.js\nphantomjs rasterize.js http://douyasi.com dys.png&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;如果中文显示不出来的话说明没有安装对应的字体，debian/ubuntu可以安装xfonts-wqy，centos的话可以安装wqy-bitmapfont(需下载）或者bitmap -fonts和bitmap-fonts-cjk，安装完之后中文应该就可以正常显示了。&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-bash&quot;&gt;sudo aptitude install ttf-wqy-microhei\nsudo apt-get install xfonts-wqy&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n\n&lt;p&gt;本文来自：&lt;a href=&quot;http://solos.so/2013/10/21/%E4%BD%BF%E7%94%A8PhantomJS%E8%BF%9B%E8%A1%8C%E7%BD%91%E9%A1%B5%E6%88%AA%E5%9B%BE/&quot;&gt;http://solos.so/2013/10/21/%E4%BD%BF%E7%94%A8PhantomJS%E8%BF%9B%E8%A1%8C%E7%BD%91%E9%A1%B5%E6%88%AA%E5%9B%BE/&lt;/a&gt;&lt;/p&gt;\n', '4', 'article', '1', '0', '0', null, '5', null, '2015-02-10 13:44:10', '2015-02-10 13:52:47');
INSERT INTO `yascmf_contents` VALUES ('5', '', 'Laravel 4开发人员必用扩展包', '', '&lt;blockquote&gt;\n&lt;p&gt;提供一些Laravel 4开发人员必用扩展包，后续会有补充。Laravel 5 已发布，很多优秀的包都会提供 5 支援的版本。&lt;/p&gt;\n\n&lt;p&gt;参考来源：http://blog.csdn.net/iefreer/article/details/37542395&lt;/p&gt;\n&lt;/blockquote&gt;\n\n&lt;h2&gt;HTML压缩器（Laravel HTML Minify）&lt;/h2&gt;\n\n&lt;p&gt;压缩模版页面空白符，配合gzip，有效减少页面大小，提升页面加载速度。&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-json&quot;&gt;&quot;require&quot;: {\n&quot;fitztrev/laravel-html-minify&quot;: &quot;1.*&quot;\n}&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n\n&lt;p&gt;&lt;a href=&quot;https://github.com/fitztrev/laravel-html-minify&quot;&gt;Laravel HTML Minify&lt;/a&gt;&lt;/p&gt;\n\n&lt;h2&gt;代码生成器（Laravel Generators）&lt;/h2&gt;\n\n&lt;p&gt;使用简单的命令行就可以自动根据代码模板生成Model/View/Controller代码以及模块（Module）。&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-json&quot;&gt;&quot;require-dev&quot;: {\n&quot;way/generators&quot;: &quot;~2.0&quot;\n}&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-bash&quot;&gt;composer update --dev&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;&lt;a href=&quot;https://github.com/JeffreyWay/Laravel-4-Generators&quot;&gt;Laravel-4-Generators&lt;/a&gt;&lt;/p&gt;\n\n&lt;h2&gt;调试栏（Laravel Debug Bar）&lt;/h2&gt;\n\n&lt;p&gt;PHP调试栏项目无疑是一个巨大的成功，你无需到处编写var_dump。Laravel调试栏对该组件作了扩展，包含了路由、视图、事件以及更多信息。这使得调试变得更加简单、快速，提高你的开发效率。&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-json&quot;&gt;&quot;require&quot;: {\n&quot;barryvdh/laravel-debugbar&quot;: &quot;~1.7&quot;\n}&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;&lt;a href=&quot;https://github.com/barryvdh/laravel-debugbar&quot;&gt;Laravel Debug Bar&lt;/a&gt;&lt;/p&gt;\n\n&lt;p&gt;&hellip;&hellip;&lt;/p&gt;\n\n&lt;blockquote&gt;\n&lt;p&gt;完整内容请查阅作者博客：&lt;a href=&quot;http://douyasi.com/laravel/la_packages.html&quot;&gt;http://douyasi.com/laravel/la_packages.html&lt;/a&gt;&lt;/p&gt;\n&lt;/blockquote&gt;\n', '5', 'article', '1', '0', '0', '', '4', null, '2015-02-10 13:51:58', '2015-03-11 23:46:53');
INSERT INTO `yascmf_contents` VALUES ('6', '', '芽丝博客视图文件目录结构', '', '&lt;blockquote&gt;\n&lt;p&gt;Laravel 5 版视图文件位于&nbsp;resources\\views 目录下，本套内容管理框架视图目录结构大致如下。&lt;/p&gt;\n&lt;/blockquote&gt;\n\n&lt;pre&gt;\n&lt;code class=&quot;language-markdown&quot;&gt;|_authority 登录视图文件夹\n    |_login.blade.php 登录页\n    \n|_back 后台视图文件夹\n    |_article 管理文章\n        |_index.blade.php\n        |_edit.blade.php\n        |_show.blade.php\n    |_business\n    |_...\n    \n|_emails    邮件模版文件夹\n    |_password.blade.php 重置密码邮件模版\n       \n|_front    前台视图文件夹\n    |_index.blade.php 前台首页\n    |_page\n        |_yascmf.blade.php 单页模版\n    |_...\n\n|_layout    布局layout文件夹\n    |_base.blade.php 供继承所用的基础layout\n    |_backend.blade.php 后台layout\n    |_frontend.blade.php 前台layout\n    |_layer.blade.php Layer弹窗layout\n\n|_scripts    javascript相关代码碎片文件夹（供嵌入使用）\n    |_endChosen.blade.php 使用chosen插件所使用到javascript代码\n    |_...\n\n|_widgets    通用外挂型组件文件夹\n    |_leftSidebar.blade.php 后台左侧导航通用外挂组件\n    |_topHeadNav.blade.php 后台顶部导航通用外挂组件\n    |_...&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;&lt;strong&gt;`back` 文件夹&lt;/strong&gt;主要放置所有后台视图文件&lt;/p&gt;\n\n&lt;p&gt;&lt;strong&gt;`front` 文件夹&lt;/strong&gt;主要放置所有前台视图文件&lt;/p&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n', '6', 'article', '1', '0', '0', '', '3', null, '2015-02-10 13:58:51', '2015-03-11 23:45:39');
INSERT INTO `yascmf_contents` VALUES ('7', '', '芽丝内容管理框架简介', '', '&lt;blockquote&gt;\n&lt;p&gt;芽丝内容管理框架， 基于 `Laravel 5` 开发而成，它比较适合拿来做一些小众项目开发。目前框架实现了一个简单的内容管理系统（ `CMS` ），支持多种内容模型，文章、单页、分类、碎片与标签，您现在完全可以拿它 来完成一个简单的博客网站，&ldquo;芽丝博客&rdquo;就是它所驱动的博客示例网站。&lt;/p&gt;\n\n&lt;p&gt;芽丝内容管理框架提供了一套基础的内容管理后台，可以很方便地在此基础上进行快捷（二次）开发，从而让您更专心地投入到后端编码中。&lt;/p&gt;\n&lt;/blockquote&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n\n&lt;h2&gt;YASCMF主要特性&lt;/h2&gt;\n\n&lt;ol&gt;\n	&lt;li&gt;使用MIT开源协议，代码托管在 GitHub&lt;/li&gt;\n	&lt;li&gt;基于Laravel 5 开发，支持 PHP5 最新特性，注定灵活快捷，拥有丰富的组件&lt;/li&gt;\n	&lt;li&gt;遵循 RESTFUL 规范，后台数据以 AJAX 方式提交，能比较好地满足用户体验&lt;/li&gt;\n	&lt;li&gt;运用 Entrust&nbsp;包来实现用户角色与权限控制&lt;/li&gt;\n	&lt;li&gt;三级导航，根据当前路由地址自动化高亮，无需从后端传入索引值&lt;/li&gt;\n	&lt;li&gt;选用最新版的&nbsp;CKEditor&nbsp;网页编辑器，适合普通用户使用，未来会开发 markdown 编辑器以供高级用户使用&lt;/li&gt;\n	&lt;li&gt;代码注释完整，结合全中文化的文档、QQ群与社区支持，让你二次开发无忧&lt;/li&gt;\n	&lt;li&gt;官方自带博客演示，让你轻轻松松建立自己博客网站，后期会有更多示例网站&lt;/li&gt;\n&lt;/ol&gt;\n\n&lt;p&gt;更多...请入群交流，官方QQ交流群：&lt;a href=&quot;http://shang.qq.com/wpa/qunwpa?idkey=c43a551e4bc0ff5c5051ec8f6d901ab21c1e89e3001d6cf0b0b4a28c0fa4d4f8&quot;&gt;260655062&lt;/a&gt;&lt;/p&gt;\n\n&lt;p&gt;项目 GitHub 地址：&lt;a href=&quot;https://github.com/douyasi/yascmf&quot;&gt;https://github.com/douyasi/yascmf&lt;/a&gt;&nbsp;。&lt;/p&gt;\n\n&lt;p&gt;&nbsp;&lt;/p&gt;\n', '7', 'article', '1', '0', '0', '', '2', null, '2015-02-10 14:02:22', '2015-03-12 00:06:16');
INSERT INTO `yascmf_contents` VALUES ('8', '', 'Laravel 5 中文文档', '', '&lt;p&gt;Laravel 5已经正式发布，不久前其中文化文档也翻译完毕。&lt;/p&gt;\n\n&lt;p&gt;传送地址： &lt;a href=&quot;http://laravel-china.org/docs/5.0&quot;&gt;http://laravel-china.org/docs/5.0&lt;/a&gt;&lt;/p&gt;\n', '8', 'article', '1', '0', '0', '', '4', null, '2015-02-10 14:05:26', '2015-03-11 23:37:10');
INSERT INTO `yascmf_contents` VALUES ('9', '', 'Javascript获取当前URL相关参数', '', '&lt;pre&gt;\n&lt;code class=&quot;language-javascript&quot;&gt;	var search = window.location.search; //获取url中&quot;?&quot;符后的字串\n	var hash = window.location.hash; //获取url中&quot;#&quot;锚点符\n\n	var parser = document.createElement(&#039;a&#039;);\n	//var parser = {};\n	parser.href = &quot;http://example.com:3000/pathname/?search=test#hash&quot;;\n	parser.protocol; // =&gt; &quot;http:&quot;\n	parser.hostname; // =&gt; &quot;example.com&quot;\n	parser.port;     // =&gt; &quot;3000&quot;\n	parser.pathname; // =&gt; &quot;/pathname/&quot;\n	parser.search;   // =&gt; &quot;?search=test&quot;\n	parser.hash;     // =&gt; &quot;#hash&quot;\n	parser.host;     // =&gt; &quot;example.com:3000&quot;\n	/*\n	hash	 从井号 (#) 开始的 URL（锚）\n	host	 主机名和当前 URL 的端口号\n	hostname	 当前 URL 的主机名\n	href	 完整的 URL\n	pathname	 当前 URL 的路径部分\n	port	 当前 URL 的端口号\n	protocol	 当前 URL 的协议\n	search	 从问号 (?) 开始的 URL（查询部分）\n	*/\n	console.log(search);\n	console.log(hash);&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;相关解析URL的JS类库：&lt;/p&gt;\n\n&lt;p&gt;jquery.url.js&nbsp;&lt;a href=&quot;https://github.com/allmarkedup/purl&quot;&gt;https://github.com/allmarkedup/purl&lt;/a&gt;&nbsp;（不再更新维护）&lt;/p&gt;\n\n&lt;p&gt;URI.js&nbsp;&lt;a href=&quot;https://github.com/medialize/URI.js&quot;&gt;https://github.com/medialize/URI.js&lt;/a&gt;&lt;/p&gt;\n', '9', 'article', '1', '0', '0', '', '1', null, '2015-02-10 14:08:19', '2015-03-11 23:03:06');
INSERT INTO `yascmf_contents` VALUES ('10', '', '芽丝博客上线', '', '&lt;p&gt;芽丝博客已上线，欢迎浏览！&lt;/p&gt;\n\n&lt;p&gt;当前本博客运行的版本为 Laravel 5 适配版本，Github 下载地址：&lt;a href=&quot;https://github.com/douyasi/yascmf&quot;&gt;https://github.com/douyasi/yascmf&lt;/a&gt;&nbsp;。欢迎下载安装，有任何问题可以加群或在 GitHub 发出 Issue 。&lt;/p&gt;\n', '10', 'article', '1', '0', '0', '', '1', null, '2015-02-10 14:20:37', '2015-03-11 23:40:35');

-- ----------------------------
-- Table structure for yascmf_flags
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_flags`;
CREATE TABLE `yascmf_flags` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `attr` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '属性名',
  `attr_full_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT '属性全称名',
  `display_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '展示名',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of yascmf_flags
-- ----------------------------
INSERT INTO `yascmf_flags` VALUES ('1', 'l', 'link', '链接', '可用于友情链接');
INSERT INTO `yascmf_flags` VALUES ('2', 'f', 'flash', '幻灯', '可用于页面幻灯片模型');
INSERT INTO `yascmf_flags` VALUES ('3', 's', 'scrolling', '滚动', '可用于页面滚动效果的文章');
INSERT INTO `yascmf_flags` VALUES ('4', 'h', 'hot', '热门', '可用于页面推荐性文章');

-- ----------------------------
-- Table structure for yascmf_metas
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_metas`;
CREATE TABLE `yascmf_metas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'meta名',
  `thumb` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'meta缩略图',
  `slug` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'meta缩略名',
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'category' COMMENT 'meta类型: [category]-分类，[tag]-标签',
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'meta描述',
  `count` int(10) unsigned DEFAULT '0' COMMENT 'meta被使用的次数',
  `sort` int(6) unsigned DEFAULT '0' COMMENT 'meta排序，数字越大排序越靠前',
  PRIMARY KEY (`id`),
  KEY `name_index` (`name`),
  KEY `slug_index` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='META元数据（分类|标签） 表';

-- ----------------------------
-- Records of yascmf_metas
-- ----------------------------
INSERT INTO `yascmf_metas` VALUES ('1', '默认', null, 'default', 'category', '默认', '0', '0');
INSERT INTO `yascmf_metas` VALUES ('2', '软件', null, 'soft', 'category', '收录个人开发的软件或脚本', '0', '0');
INSERT INTO `yascmf_metas` VALUES ('3', '文档', null, 'docs', 'category', '这里收录自己开发过程中所撰写的文档', '0', '0');
INSERT INTO `yascmf_metas` VALUES ('4', 'Laravel', null, 'laravel', 'category', '分享一些Laravel相关文章', '0', '0');
INSERT INTO `yascmf_metas` VALUES ('5', 'Javascript', null, 'javascript', 'category', '前端Javascript相关知识', '0', '0');
INSERT INTO `yascmf_metas` VALUES ('6', '测试', null, null, 'category', '测试内容', '0', '0');

-- ----------------------------
-- Table structure for yascmf_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_password_resets`;
CREATE TABLE `yascmf_password_resets` (
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `token` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '会话token',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of yascmf_password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for yascmf_permissions
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_permissions`;
CREATE TABLE `yascmf_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限名',
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限展示名',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='权限信息表';

-- ----------------------------
-- Records of yascmf_permissions
-- ----------------------------
INSERT INTO `yascmf_permissions` VALUES ('1', 'manage_contents', '管理内容', null, '2014-12-22 02:30:59', '2014-12-22 02:30:59');
INSERT INTO `yascmf_permissions` VALUES ('2', 'manage_users', '管理用户', null, '2014-12-22 02:30:59', '2014-12-22 02:30:59');
INSERT INTO `yascmf_permissions` VALUES ('3', 'manage_system', '管理系统', null, '2015-02-04 09:40:56', '2015-02-04 09:40:59');

-- ----------------------------
-- Table structure for yascmf_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_permission_role`;
CREATE TABLE `yascmf_permission_role` (
  `permission_id` int(10) unsigned NOT NULL COMMENT '权限id',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色id',
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='权限与用户组角色对应关系表';

-- ----------------------------
-- Records of yascmf_permission_role
-- ----------------------------
INSERT INTO `yascmf_permission_role` VALUES ('1', '2');
INSERT INTO `yascmf_permission_role` VALUES ('1', '3');
INSERT INTO `yascmf_permission_role` VALUES ('2', '1');
INSERT INTO `yascmf_permission_role` VALUES ('2', '2');
INSERT INTO `yascmf_permission_role` VALUES ('3', '1');
INSERT INTO `yascmf_permission_role` VALUES ('3', '2');

-- ----------------------------
-- Table structure for yascmf_relationships
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_relationships`;
CREATE TABLE `yascmf_relationships` (
  `cid` int(10) unsigned NOT NULL COMMENT '内容数据id',
  `mid` int(10) unsigned NOT NULL COMMENT 'meta元数据id',
  PRIMARY KEY (`cid`,`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='内容与元数据关系联系表[考虑查询复杂度，目前只存储文章单页跟标签的关系]';

-- ----------------------------
-- Records of yascmf_relationships
-- ----------------------------

-- ----------------------------
-- Table structure for yascmf_roles
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_roles`;
CREATE TABLE `yascmf_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色名',
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色展示名',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '角色描述',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户组角色表';

-- ----------------------------
-- Records of yascmf_roles
-- ----------------------------
INSERT INTO `yascmf_roles` VALUES ('1', 'Founder', '创始人', null, '2014-12-22 02:30:59', '2014-12-22 02:30:59');
INSERT INTO `yascmf_roles` VALUES ('2', 'Admin', '超级管理员', null, '2014-12-22 02:30:59', '2014-12-22 02:30:59');
INSERT INTO `yascmf_roles` VALUES ('3', 'Editor', '编辑', null, '2015-02-04 17:12:22', '2015-02-04 17:12:22');
INSERT INTO `yascmf_roles` VALUES ('4', 'Demo', '演示', null, '2015-02-04 17:13:03', '2015-02-04 17:13:03');

-- ----------------------------
-- Table structure for yascmf_role_user
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_role_user`;
CREATE TABLE `yascmf_role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id_foreign` (`role_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of yascmf_role_user
-- ----------------------------
INSERT INTO `yascmf_role_user` VALUES ('1', '2');

-- ----------------------------
-- Table structure for yascmf_settings
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_settings`;
CREATE TABLE `yascmf_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '设置项名',
  `value` text COLLATE utf8_unicode_ci COMMENT '设置项值',
  `status` tinyint(3) DEFAULT '1' COMMENT '状态 0未启用 1启用 其它数字表示异常',
  `type_id` int(12) DEFAULT '0' COMMENT '设置所属类型id 0表示无任何归属类型',
  `sort` int(6) unsigned DEFAULT '0' COMMENT '设置排序，数字越大排序越靠前',
  PRIMARY KEY (`id`),
  KEY `setting_name_index` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='动态设置表';

-- ----------------------------
-- Records of yascmf_settings
-- ----------------------------
INSERT INTO `yascmf_settings` VALUES ('1', 'default_setting', '默认设置', '1', '1', '999');
INSERT INTO `yascmf_settings` VALUES ('2', 'system', '系统', '1', '2', '0');
INSERT INTO `yascmf_settings` VALUES ('3', 'manager', '管理员', '1', '2', '0');
INSERT INTO `yascmf_settings` VALUES ('4', 'content', '内容', '1', '2', '0');
INSERT INTO `yascmf_settings` VALUES ('5', 'upload', '上传', '1', '2', '0');
INSERT INTO `yascmf_settings` VALUES ('6', 'article', '文章', '1', '3', '0');
INSERT INTO `yascmf_settings` VALUES ('7', 'page', '单页', '1', '3', '0');
INSERT INTO `yascmf_settings` VALUES ('8', 'fragment', '碎片', '1', '3', '0');
INSERT INTO `yascmf_settings` VALUES ('9', 'memo', '备忘', '1', '3', '0');
INSERT INTO `yascmf_settings` VALUES ('10', 'Founder', '创始人', '1', '4', '0');
INSERT INTO `yascmf_settings` VALUES ('11', 'Admin', '超级管理员', '1', '4', '0');
INSERT INTO `yascmf_settings` VALUES ('12', 'Editor', '编辑', '1', '4', '0');
INSERT INTO `yascmf_settings` VALUES ('13', 'Demo', '演示', '1', '4', '0');

-- ----------------------------
-- Table structure for yascmf_setting_type
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_setting_type`;
CREATE TABLE `yascmf_setting_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '设置类型项名',
  `value` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '设置类型项值',
  `sort` int(6) unsigned DEFAULT '0' COMMENT '设置类型排序，数字越大排序越靠前',
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_type_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='动态设置类型表';

-- ----------------------------
-- Records of yascmf_setting_type
-- ----------------------------
INSERT INTO `yascmf_setting_type` VALUES ('1', 'default', '默认', '0');
INSERT INTO `yascmf_setting_type` VALUES ('2', 'system_operation', '系统操作类型', '0');
INSERT INTO `yascmf_setting_type` VALUES ('3', 'content_type', '内容类型', '0');
INSERT INTO `yascmf_setting_type` VALUES ('4', 'role_type', '角色类型', '0');

-- ----------------------------
-- Table structure for yascmf_system_log
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_system_log`;
CREATE TABLE `yascmf_system_log` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT '系统日志id',
  `user_id` int(12) DEFAULT '0' COMMENT '用户id（为0表示系统级操作，其它一般为管理型用户操作）',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'system' COMMENT '操作类型',
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT '-' COMMENT '操作发起的url',
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '操作内容',
  `operator_ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '操作者ip',
  `deleted_at` datetime DEFAULT NULL COMMENT '被软删除时间',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='系统日志表';

-- ----------------------------
-- Records of yascmf_system_log
-- ----------------------------

-- ----------------------------
-- Table structure for yascmf_system_options
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_system_options`;
CREATE TABLE `yascmf_system_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '配置选项名',
  `value` text COLLATE utf8_unicode_ci COMMENT '配置选项值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `system_option_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='系统配置选项表';

-- ----------------------------
-- Records of yascmf_system_options
-- ----------------------------
INSERT INTO `yascmf_system_options` VALUES ('1', 'website_keywords', '芽丝博客,芽丝,CMF,内容管理框架');
INSERT INTO `yascmf_system_options` VALUES ('2', 'company_address', '');
INSERT INTO `yascmf_system_options` VALUES ('3', 'website_title', '芽丝博客');
INSERT INTO `yascmf_system_options` VALUES ('4', 'company_telephone', '800-168-8888');
INSERT INTO `yascmf_system_options` VALUES ('5', 'company_full_name', '芽丝内容管理框架');
INSERT INTO `yascmf_system_options` VALUES ('6', 'website_icp', '');
INSERT INTO `yascmf_system_options` VALUES ('7', 'system_version', 'yascmf_alpha_1.0');
INSERT INTO `yascmf_system_options` VALUES ('8', 'page_size', '10');
INSERT INTO `yascmf_system_options` VALUES ('9', 'system_logo', 'http://cmf.yas.so/assets/img/yas_logo.png');
INSERT INTO `yascmf_system_options` VALUES ('10', 'picture_watermark', 'http://cmf.yas.so/assets/img/yas_logo.png');
INSERT INTO `yascmf_system_options` VALUES ('11', 'company_short_name', '芽丝博客');
INSERT INTO `yascmf_system_options` VALUES ('12', 'system_author', '豆芽丝');
INSERT INTO `yascmf_system_options` VALUES ('13', 'system_author_website', 'http://douyasi.com');
INSERT INTO `yascmf_system_options` VALUES ('14', 'is_watermark', '0');

-- ----------------------------
-- Table structure for yascmf_users
-- ----------------------------
DROP TABLE IF EXISTS `yascmf_users`;
CREATE TABLE `yascmf_users` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户登录名',
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户密码',
  `nickname` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户屏显昵称，可以不同用户登录名',
  `email` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户邮箱',
  `realname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户真实姓名',
  `pid` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户身份证号',
  `pid_card_thumb1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '身份证证件正面（印有国徽图案、签发机关和有效期限）照片',
  `pid_card_thumb2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '身份证证件反面（印有个人基本信息和照片）照片',
  `avatar` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户个人图像',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '固定/移动电话',
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系地址',
  `emergency_contact` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '紧急联系人信息',
  `servicer_id` int(12) DEFAULT '0' COMMENT '专属客服id，（为0表示其为无专属客服的管理用户）',
  `deleted_at` datetime DEFAULT NULL COMMENT '被软删除时间',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改更新时间',
  `is_lock` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否锁定限制用户登录，1锁定,0正常',
  `user_type` enum('visitor','customer','manager') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'visitor' COMMENT '用户类型：visitor 游客, customer 投资客户, manager 管理型用户',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '确认码',
  `confirmed` tinyint(1) DEFAULT '0' COMMENT '是否已通过验证 0：未通过 1：通过',
  `remember_token` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Laravel 追加的记住令牌',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username_unique` (`username`),
  UNIQUE KEY `user_email_unique` (`email`),
  UNIQUE KEY `user_pid_unique` (`pid`),
  KEY `user_nickname_index` (`nickname`),
  KEY `user_realname_index` (`realname`),
  KEY `user_phone_index` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of yascmf_users
-- ----------------------------
INSERT INTO `yascmf_users` VALUES ('1', 'admin', '$2y$10$J7LHukU1OvdKS0HjHyP67OckaKXwci9vV6iqOCpN65x8X7MDgMNlu', 'Admin', 'admin@example.com', '芽丝', null, null, null, null, null, null, null, null, null, '2014-12-22 02:30:59', '2015-04-26 19:26:04', '0', 'manager', '161590b511f23a7aca43e785ba037d4f', '1', 'GFdBArEXF5jmURqJwsiVfNjZg2AmmR4kBX0Wtgw9djGZgsO6D3G8XZGMTxg9');
