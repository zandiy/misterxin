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

class Lang {

    static private $lang = [];

    /**
     * 获取语言定义
     * @param string $name  语言定义的key
     * @param array $value  需要替换的变量
     * @return mixed
     */
    static public function get($name = '', $value = null) {
        // 参数为空则返回所有定义
        if (empty($name)) {
            return self::$lang;
        }
        // 获取语言定义,如果$value是数组，则支持变量替换
        if (is_string($name)) {
            $name = strtoupper($name);
            if (is_null($value)) {
                return isset(self::$lang[$name]) ? self::$lang[$name] : $name;
            } elseif (is_array($value)) {
                // 支持变量
                $replace = array_keys($value);
                foreach ($replace as &$v) {
                    $v = '{:' . $v . '}';
                }
                return str_replace($replace, $value, isset(self::$lang[$name]) ? self::$lang[$name] : $name);
            }
        }
        return null;
    }

    /**
     * 设置语言定义
     * @param minxed $name
     * @param string $value
     * @return boolean
     */
    static public function set($name, $value = null) {
        // 语言定义
        if (is_string($name)) {
            self::$lang[$name] = $value;
            return true;
        }
        // 批量定义
        elseif (is_array($name)) {
            self::$lang = array_merge(self::$lang, array_change_key_case($name, CASE_UPPER));
            return true;
        }
        return false;
    }

}
