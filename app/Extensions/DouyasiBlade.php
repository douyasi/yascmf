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
        # @datetime($var) : Laravel official example (官方帮助示例)
        Blade::directive('datetime', function($expression) {
            return "<?php echo with{$expression}->format('m/d/Y H:i'); ?>";
        });

        # @cdn($var, ...) : 使用 helper 函数
        Blade::directive('cdn', function($expression) {
            return "<?php echo cdn{$expression}; ?>";
        });

        # @break : 用于php循环中，实现break
        Blade::extend(function ($view, $compiler) {
            $pattern = self::createPlainMatcher('break');
            return preg_replace($pattern, '$1<?php break; ?>$2', $view);
        });

        # @continue : 用于php循环中，实现continue
        Blade::extend(function ($view, $compiler) {
            $pattern = self::createPlainMatcher('continue');
            return preg_replace($pattern, '$1<?php continue; ?>$2', $view);
        });

        # @raw_define : 用于模版里面，变量定义赋值，可结合 @inject 模版注入之后，调用注入对象方法
        # @raw_define('content', '$article->content', ['1'])
        Blade::directive('raw_define', function($expression) {
            return self::compilerRawDefine($expression);
        });
        /*注册自定义blade标签,并且实现自主解析*/
    }

    public static function createMatcher($function)
    {
        return '/(?<!\w)(\s*)@'.$function.'(\s*\(.*\))/';
    }

    public static function createPlainMatcher($function)
    {
        return '/(?<!\w)(\s*)@'.$function.'(\s*)/';
    }

    public static function compilerRawDefine($expression)
    {
        $pattern = '/\(\'(.*?)\'\,\s*\'(.*?)\'\,\s*\[(.*)\]\)/';
        $ret = preg_match($pattern, $expression, $match);
        if($ret === 0) {
            return '';
        } else {
            return "<?php $".trim($match[1])." = ".trim($match[2])."(".$match[3]."); ?>";
        }
    }
}
