<?php

namespace Douyasi\Http\Middleware;

use Closure;

/**
 * 芽丝CMF后台管理 权限不足抛出异常响应 中间件
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class PermissionDenied
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return response()->view('back.exceptions.deny', array(), 403);
        return $next($request);
    }
}
