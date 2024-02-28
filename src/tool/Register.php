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

class Register {

    static private $register = [];

    /**
     * 获取变量
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    static public function get($name = '', $default = null) {
        // 无参数时获取所有
        if (empty($name)) {
            return self::$register;
        }
        // 优先执行设置获取或赋值
        if (is_string($name)) {
            if (!strpos($name, '.')) {
                return isset(self::$register[$name]) ? self::$register[$name] : $default;
            }
            // 支持多维数组获取
            $name = explode('.', $name);
            return self::getRecursive(self::$register, $name, $default);
        }
        return null;
    }

    /**
     * 递归的获取变量
     * @param array $register
     * @param array $names
     * @param mixed $default
     * @return mixed
     */
    static private function getRecursive($register, $names, $default = null) {
        if (empty($names)) {
            return $register;
        } else {
            $name = trim(array_shift($names));
            if ($name) {
                if (isset($register[$name])) {
                    return self::getRecursive($register[$name], $names, $default);
                } else {
                    return $default;
                }
            } else {
                return $register;
            }
        }
    }

    /**
     * 设置变量
     * @param mixed $name
     * @param mixed $value
     * @return boolean
     */
    static public function set($name, $value = null) {
        // 配置定义
        if (is_string($name)) {
            self::$register[$name] = $value;
            return true;
        }
        // 批量定义
        elseif (is_array($name)) {
            self::$register = array_merge(self::$register, $name);
            return true;
        }
        return false;
    }

}
