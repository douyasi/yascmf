<?php

namespace Douyasi\Repositories;

use Douyasi\Models\SystemLog;

/**
 * 系统配置仓库SystemOptionRepository
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class SystemLogRepository extends BaseRepository
{

    /**
     * The SystemLog instance.
     *
     * @var Douyasi\Models\SystemLog
     */
    protected $log;

    /**
     * Create a new SystemLogRepository instance.
     *
     * @param  Douyasi\Models\SystemLog $log
     * @return void
     */
    public function __construct(
        SystemLog $log)
    {
        $this->model = $log;
    }


    /**
     * 系统日志资源列表数据
     *
     * @param  array $data
     * @param  array|string $extra
     * @param  string $size 分页大小
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $extra = '', $size = '10')
    {
        if (!ctype_digit($size)) {
            $size = '10';
        }
        $data = array_add($data, 's_operator_realname', '');
        $data = array_add($data, 's_operator_ip', '');
        return $this->model->join('users', 'system_log.user_id', '=', 'users.id')
                          ->select('system_log.*', 'users.realname')
                          ->where('users.realname', 'like', '%'.e($data['s_operator_realname']).'%')
                          ->where('operator_ip', 'like', '%'.e($data['s_operator_ip']).'%')
                          ->orderBy('created_at', 'desc')
                          ->paginate($size);
    }

    #********
    #* 空写未使用的接口函数update与edit START
    #********
    public function edit($id = 0, $extra = ''){
        return;
    }
    public function update($id = 0, $inputs = [], $extra = ''){
        return;
    }
    #********
    #* 空写未使用的接口函数update与edit END
    #********

}
