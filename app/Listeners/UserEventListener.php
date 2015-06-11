<?php

namespace Douyasi\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Log;
use Douyasi\Logger\SystemLogger as SystemLogger;

/**
 * Class UserEventHandler
 * (管理)用户登录/登出等活动事件监听器
 *
 * @package Douyasi\Handlers\Events
 * @author raoyc <raoyc2009@gmail.com>
 */
class UserEventListener
{

    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        //
        $user = $event->user;
        Log::info('user '.$user->nickname.'['.$user->email.'] has login');
        $log = [
            'user_id'=>$user->id,
            'url'=>route('login'),
            'type'=>'manager',
            'content'=>'管理员：'.$user->nickname.'['.$user->email.'] 登录系统。',
        ];
        SystemLogger::write($log);
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
        //
        $user = $event->user;
        Log::info('user '.$user->nickname.'['.$user->email.'] has logout');
        $log = [
            'user_id'=>$user->id,
            'url'=>route('logout'),
            'type'=>'manager',
            'content'=>'管理员：'.$user->nickname.'['.$user->email.'] 登出系统。',
        ];
        SystemLogger::write($log);
    }

    /**
     * Handle user update personal information events.
     */
    public function onUserUpdate($event)
    {
        $user = $event->user;
        Log::info('user '.$user->nickname.'['.$user->email.'] has update his/her personal information');
        $log = [
            'user_id'=>$user->id,
            'url'=>route('admin.me.index'),
            'type'=>'manager',
            'content'=>'管理员：更新了我的账户 - 个人资料。',
        ];
        SystemLogger::write($log);
    }
    
    /**
     * Handle user upload picture file events.
     */
    public function onUserUpload($event)
    {
        $user = $event->user;
        $file = $event->file;
        Log::info('user '.$user->nickname.'['.$user->email.'] uploaded a file:'.$file['original_file_name'].'->'.$file['uploaded_full_file_name']);
        $log = [
            'user_id'=>$user->id,
            'url'=>route('admin.upload'),
            'type'=>'upload',
            'content'=>'管理员：上传了图片文件，图片原始文件名：'.$file['original_file_name'].'，上传之后保存在服务器路径为'.$file['uploaded_full_file_name'].'。',
        ];
        SystemLogger::write($log);
    }
    
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        //这里需申明完整类路径，否则会出现'Class UserEventListener does not exist'错误
        $events->listen('Douyasi\Events\UserLogin', 'Douyasi\Listeners\UserEventListener@onUserLogin');
        $events->listen('Douyasi\Events\UserLogout', 'Douyasi\Listeners\UserEventListener@onUserLogout');
        $events->listen('Douyasi\Events\UserUpdate', 'Douyasi\Listeners\UserEventListener@onUserUpdate');
        $events->listen('Douyasi\Events\UserUpload', 'Douyasi\Listeners\UserEventListener@onUserUpload');
    }
}
