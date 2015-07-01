<?php

/*
|--------------------------------------------------------------------------
| 自定义公共函数库Helper
|--------------------------------------------------------------------------
|
*/

/**
 * 格式化表单校验消息
 *
 * @param  array $messages 未格式化之前数组
 * @return string 格式化之后字符串
 */
function format_message($messages)
{
    $reason = ' ';
    foreach ($messages->all('<span class="text_error">:message</span>') as $message) {
        $reason .= $message.' ';
    }
    return $reason;
}

/**
 * 格式化表单校验消息，并进行json数组化预处理
 *
 * @param  array $messages 未格式化之前数组
 * @param array $json 原始json数组数据
 * @return array
 */
function format_json_message($messages, $json)
{
    $reason = format_message($messages);
    $info = '失败原因为：'.$reason;
    $json = array_replace($json, ['info' => $info]);
    return $json;
}

/**
 * 静态文件cdn部署
 * 如果设置过app.cdn_url参数，则启用它作为静态资源根目录，否则使用默认的app.url作为静态资源根目录
 * 如果cdn_url = 'http://ystatic.cn'
 * 则 cdn('assets/css/style.css', 'v=1.0') 实际表示的路径为 http://ystatic.cn/assets/css/style.css?v=1.0
 *
 * @param string $filepath 静态资源相对路径
 * @param string $q 尾缀符，如 assets/css/style.css?v=1.4.3
 * @return string
 */
function cdn($filepath, $q = '')
{
    $qstring = (is_string($q) && !empty($q)) ? '?'.$q:'';
    if (Config::get('app.cdn_url')) {
        $root = Config::get('app.cdn_url');
        return rtrim($root, '/').'/'.trim($filepath, '/').$qstring;
    } else {
        return app('url')->asset($filepath).$qstring;
    }
}

/**
 * 使用Minify(https://github.com/mrclay/minify)来压缩与拼合静态文件
 * 实现优化部署
 * 示例：
 * minify(array('css/yas_style.css','lib/font-awesome/css/font-awesome.min.css'))
 * http://cmf.yas.so/min/b=assets&f=css/yas_style.css,lib/font-awesome/css/font-awesome.min.css
 *
 * @param array $data 静态资源数组
 * @param string $base 相对基路径
 * @return string
 */
function minify($data, $base='assets')
{
    if (Config::get('app.minify_dir')) {
        $min = Config::get('app.cdn_url');
    } else {
        $min = 'min';
    }
    $static = $min.'/b='.$base.'&f=';
    if (is_array($data)) {
        foreach ($data as $d) {
            $static .= $d.',';
        }
    }
    $static = rtrim($static, ',');
    $static .= '?minify';
    return app('url')->asset($static);
}

/**
 * 文章推荐位 flag html标签化
 * 
 * @param string $flag_str
 * @param array $flags
 * @return string
 */
function flag_tag($flag_str, $flags)
{
    if(empty($flag_str)) {
        return '';
    } else {
        $flags_array = explode(',', rtrim($flag_str, ','));
        $str = '';
        foreach ($flags_array as $flag)
        {
            $str .= '<span class="label label-danger article-flag" title="'.$flags[$flag].'" data-toggle="tooltip" data-placement="bottom">'.$flag.'</span>  ';
        }
        return $str;
    }
}

/**
 * 中文摘要算法
 *
 * @param string $content 正文
 * @return string
 */
function chinese_excerpt($content)
{
    return mb_strimwidth(strip_tags($content), 0, 200, '...');
}

/**
 * 芽丝CMF后台分页helper
 *
 * @param Illuminate\Support\Collection $model
 * @param array $data 追加的参数数组
 * @return string 返回分页
 */
function page_links($model, $data = [])
{
    $presenter = new \Douyasi\Extensions\DouyasiPresenter($model);
    if (empty($data)) {
        $links = $model->render($presenter);
    } else {
        $links = $model->appends($data)->render($presenter);
    }
    return $links;
}

/**
 * 检查 特定数组 特定键名的键值 是否与待比较的值一致
 * 此helper主要用于角色权限特征判断
 *
 * @param array $array 传入的数组
 * @param string $key 待比较的数组键名
 * @param string $value 待比较的值
 * @return boolean 一致则返回true，否则返回false
 */
function check_array($array, $key, $value)
{
    $status = false;

    foreach ($array as $arr) {
        if ($arr[$key] === $value) {
            $status = true;
            break;
        } else {
            continue;
        }
    }
    
    return $status;
}

/**
 * 检查 特殊字符串（如逗号分隔值字符串） 是否与待比较的值一致
 * 此helper主要用于文章推荐位特征判断
 *
 * @param string $string 逗号分隔值字符串
 * @param string $value 待比较的值
 * @return boolean 一致则返回true，否则返回false
 */
function check_string($string, $value)
{
    $status = false;
    $csv_array = explode(',', rtrim($string, ','));  //逗号分割值字符串转成数组

    foreach ($csv_array as $csv)
    {
        if ($csv === $value) {
            $status = true;
            break;
        } else {
            continue;
        }
    }

    return $status;
}

/**
 * 获取登录用户信息，用于登录之后页面显示或验证
 *
 * @param string $ret 限定返回的字段
 * @return string|object 返回登录用户相关字段信息或其ORM对象
 */
function user($ret = 'nickname')
{
    if (Auth::check()) {
        switch ($ret) {
            case 'nickname':
                return Auth::user()->nickname;  //返回昵称
                break;
            case 'username':
                return Auth::user()->username;  //返回登录名
                break;
            case 'realname':
                return Auth::user()->realname;  //返回真实姓名
                break;
            case 'id':
                return Auth::user()->id;  //返回用户id
                break;
            case 'user_type':
                return Auth::user()->user_type;  //返回用户类型
                break;
            case 'object':
                return Auth::user();  //返回User对象
                break;
            default:
                return Auth::user()->nickname;  //默认返回昵称
                break;
        }
    } else {
        if($ret === 'object'){
            $user = app()->make('Douyasi\Repositories\UserRepository');
            return $user->manager(1);  //主要为了修正 `php artisan route:list` 命令出错问题
        }
        else{
            return 'No Auth::check()';
        }
    }
}


if (! function_exists('cur_nav')) {
    /**
     * 根据路由$route处理当前导航URL，用于匹配导航高亮
     * $route当前必须满足 三段以上点分 诸如 route('admin.article.index')
     *
     * @param string $route 点分式路由别名
     * @return string 返回经过处理之后路径
     */
    function cur_nav($route = '')
    {
        //explode切分法
        $routeArray = explode('.', $route);
        if ((is_array($routeArray)) && (count($routeArray)>=2)) {
            $route1 = $routeArray[0].'.'.$routeArray[1].'.index';
            $route2 = $routeArray[0].'.'.$routeArray[1];
            if (Route::getRoutes()->hasNamedRoute($route1)) {  //优先判断是否存在尾缀名为'.index'的路由
                return route($route1);
            } else {
                return route($route2);
            }
        } else {
            return route($route);
        }
    }
}

if (! function_exists('fragment')) {
    /**
     * 根据碎片slug获取碎片模型内容
     * 如果$slug真实存在，则默认返回该碎片内容,
     * 否则返回空HTML注释字符串'<!--不存在该碎片-->'
     *
     * @param string $slug 碎片slug（URL SEO化别名）
     * @param string $ret 限定返回的字段
     * @return string 返回碎片相关字段信息
     */
    function fragment($slug, $ret = '')
    {
        $content = app()->make('Douyasi\Repositories\ContentRepository');
        $fragment = $content->fragment($slug);
        if (is_null($fragment)) {
            return '<!--no this fragment-->';
        }  //返回空HTML注释字符串
        else {
            switch ($ret) {
                case 'content':
                    return htmlspecialchars_decode($fragment->content);  //返回碎片
                    break;
                case 'thumb':
                    return $fragment->thumb;  //返回碎片缩略图地址
                    break;
                case 'title':
                    return $fragment->title;  //返回碎片标题
                    break;
                default:
                    return htmlspecialchars_decode($fragment->content);  //默认返回碎片内容
                    break;
            }
        }
    }
}
