<?php

namespace Douyasi\Http\Controllers;

use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Douyasi\Events\UserUpload as UserUpload;
use Validator;
use Douyasi\Cache\SystemOptionCache as SystemOptionCache;
use Douyasi\Cache\DataCache as DataCache;
use Douyasi\Cache\SettingCache as SettingCache;
use Cache;

/**
 * 后台常规控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminController extends CommonController
{

    protected $validatorMessages = array(
        'picture.image'   => '文件类型不允许,请上传常规的图片(bmp|gif|jpg|png)文件',
        'picture.max'    => '文件过大,文件大小不得超出2MB',
    );

    /**
     * 后台首页
     * @return Response
     */
    public function getIndex()
    {
        //跳转至控制台-概要页面
        return redirect()->route('admin.console.index');
    }

    /**
     * 上传文件页面
     *
     * @return Response
     */
    public function getUpload()
    {
        return view('back.upload.create');
    }

    /**
     * 上传图像文件
     * 允许上传的文件为 image mime
     * 上传逻辑直接放在控制器里予以处理，你也可剥离出一些代码到其它类里
     *
     * @return Response
     */
    public function postUpload(Request $request)
    {
        if ($request->ajax()) {
            $json = [
                'status' => 0,
                'info' => '失败原因为：<span class="text_error">不存在待上传的文件</span>',
                'operation'=>'上传图片',
                'url' => '',
            ];
            if ($request->hasFile('picture')) {
                //
                $file = $request->file('picture');
                $data = $request->all();
                $rules = [
                    //'picture'    => 'image|max:2048',
                    'picture'    => 'max:2048',
                ];
                $messages = $this->validatorMessages;
                $validator = Validator::make($data, $rules, $messages);
                if ($validator->passes()) {
                    $realPath = $file->getRealPath();
                    $destPath = 'uploads/content/';
                    $savePath = $destPath.''.date('Ymd', time());
                    is_dir($savePath) || mkdir($savePath);  //如果不存在则创建目录
                    $name = $file->getClientOriginalName();
                    $ext = $file->getClientOriginalExtension();

                    //----------
                    // 因本人生产服务器禁用掉fileinfo扩展特性，故无法通过框架自身Validation 'image'表单验证文件MIME类型，如果您的服务器开启fileinfo扩展可直接使用 'picture' => 'image|max:2048'验证规则
                    // 这里根据客户端上传文件扩展名来验证，存在一定的安全隐患，请将上传目录执行权限去掉
                    //----------

                    $check_ext = in_array($ext, array('jpg', 'png', 'gif', 'bmp'), true);

                    if ($check_ext) {
                        $uniqid = uniqid().'_'.date('s');
                        $oFile = $uniqid.'o.'.$ext;
                        $rFile = $uniqid.'rw300.'.$ext;

                        $fullfilename = url('').'/'.$savePath.'/'.$oFile;  //原始完整路径
                        if ($file->isValid()) {
                            $uploadSuccess = $file->move($savePath, $oFile);  //移动文件
                            
                            $user = user('object');
                            $file = [
                                'original_file_name' => $name,  //添加文件操作信息，原始文件名
                                'uploaded_full_file_name' => $fullfilename,  //添加文件操作信息，上传之后存储在服务器上的原始完整路径
                            ];
                            event(new UserUpload(user('object'), $file));  //触发上传文件事件
                            
                            $oFilePath = $savePath.'/'.$oFile;
                            $rFilePath = $savePath.'/'.$rFile;
                            
                            $json = array_replace($json, ['status' => 1, 'info' => $fullfilename]);
                        } else {
                            $json = array_replace($json, ['status' => 0, 'info' => '失败原因为：<span class="text_error">文件校验失败</span>']);
                        }
                    } else {
                        $json = array_replace($json, ['status' => 0, 'info' => '失败原因为：<span class="text_error">文件类型不允许,请上传常规的图片（bmp|gif|jpg|png）文件</span>']);
                    }
                } else {
                    $json = format_json_message($validator->messages(), $json);
                }
            }
            return response()->json($json);
        } else {
            //非ajax请求抛出异常
            return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
        }
    }


    /**
     * 重建系统缓存
     * 更新内容或者刚安装完本CMS之后，如果数据显示异常，请执行本方法
     *
     * @return Response
     */
    public function getRebuildCache()
    {
        SystemOptionCache::cacheStatic();
        DataCache::rebuildDataCache();
        SettingCache::uncacheSetting();
        return view('back.cache.index');
    }
}
