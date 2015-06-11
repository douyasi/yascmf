<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;
use Douyasi\Cache\SettingCache as SettingCache;
use Douyasi\Repositories\SystemLogRepository;

/**
 * 系统日志控制器
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminSystemLogController extends BackController
{

    /**
     * The SettingRepository instance.
     *
     * @var Douyasi\Repositories\SystemLogRepository
     */
    protected $log;

    public function __construct(
        SystemLogRepository $log)
    {
        parent::__construct();
        $this->log = $log;
        
        if (! user('object')->can('manage_system')) {
            $this->middleware('deny403');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = [
            's_operator_realname' => $request->input('s_operator_realname'),
            's_operator_ip' => $request->input('s_operator_ip'),
        ];
        $system_logs = $this->log->index($data);

        $links = page_links($system_logs, $data);

        $ret = SettingCache::cacheSetting('system_operation', 'array');  //以数组键值对方式缓存动态设置

        if ($ret) {
            $sys_op = Cache::get('system_operation');
        } else {
            //缓存数据出错
            return view('exceptions.jump', ['exception' => '数据缓存异常，请联系网站管理员！']);
            die();
        }
        
        return view('back.system_log.index', compact('system_logs', 'sys_op', 'links'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $sys_log = $this->log->getById($id);
        is_null($sys_log) && abort(404);

        if (!Cache::has('system_operation')) {
            $ret = SettingCache::cacheSetting('system_operation', 'array');
            if($ret){
                 $sys_op = Cache::get('system_operation');
            } else {
                //缓存数据出错，抛出异常
                return view('back.exceptions.jump', ['exception' => '数据缓存异常，请联系网站管理员！']);
            }
        } else {
            $sys_op = Cache::get('system_operation');
        }
        
        return view('back.system_log.show', compact('sys_log', 'sys_op'));
    }
}
