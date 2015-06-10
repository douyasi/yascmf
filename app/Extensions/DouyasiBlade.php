<?php

namespace Douyasi\Extensions;

use Blade;

/**
 * DouyasiBlade
 * 扩展Blade标签
 * 一般来说，标签都是使用正则来解析的，blade标签解析也是一样的
 *
 * @author raoyc <raoyc2009@gmail.com>
 */
class DouyasiBlade
{

    public static function register()
    {
        
        # @cdn() 调用cdn helper
        Blade::extend(function ($view, $compiler) {
            $pattern = $compiler->createMatcher('cdn');
            return preg_replace($pattern, '$1<?php echo (cdn$2); ?>', $view);
        });
        # @break 用于php循环中，实现break
        Blade::extend(function ($view, $compiler) {
            $pattern = $compiler->createPlainMatcher('break');
            return preg_replace($pattern, '$1<?php break; ?>$2', $view);
        });
        # @continue 用于php循环中，实现continue
        Blade::extend(function ($view, $compiler) {
            $pattern = $compiler->createPlainMatcher('continue');
            return preg_replace($pattern, '$1<?php continue; ?>$2', $view);
        });
        
        /*注册自定义blade标签,并且实现自主解析*/
    }
}
