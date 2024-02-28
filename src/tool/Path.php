<?php
/**
 * mister.xin PHP-CLASS
 *
 * @author      mister.xin <29502954@qq.com>
 * @copyright   (c) http://mister.xin All rights reserved.
 * @link        https://github.com/zandiy/misterxin
 * @license     https://www.apache.org/licenses/LICENSE-2.0
 * @date        2024-2-28
 */
namespace misterxin\tool;

class Path
{
    static private $path = [];

    static public function get($name = 'root')
    {
        if(!isset(self::$path[$name])){
            $root = dirname(__DIR__,5).DIRECTORY_SEPARATOR;
            $arrpath = [
                'root'  => $root,
                'xin'   => __DIR__.DIRECTORY_SEPARATOR
            ];
            $path = $root.$name.DIRECTORY_SEPARATOR;
            self::$path[$name] = $arrpath[$name] ?? $path;
            if(!is_dir(self::$path[$name])) throw new \Exception($path.'目录获取异常');
        }
        return self::$path[$name];
    }
}