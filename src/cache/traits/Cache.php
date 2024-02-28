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

namespace misterxin\cache\traits;

trait Cache {

    /**
     * 获取timeKey,过期时间的key
     * @param string $key
     * @return string
     */
    static public function timeKey($key) {
        return $key . '_time';
    }

    /**
     * 获取lockKey
     * @param string $key
     * @return string
     */
    static public function lockKey($key) {
        return $key . '_lock';
    }

    /**
     * 设置value,用于序列化存储
     * @param mixed $value
     * @return mixed
     */
    static public function setValue($value) {
        if (!is_numeric($value)) {
            $value = serialize($value);
        }
        return $value;
    }

    /**
     * 获取value,解析可能序列化的值
     * @param mixed $value
     * @return mixed
     */
    static public function getValue($value) {
        if (is_null($value) || $value === false) {
            return false;
        }
        if (!is_numeric($value)) {
            $value = unserialize($value);
        }
        return $value;
    }

    /**
     * 处理异常信息
     * @param \Exception $ex
     */
    static public function exception($ex) {
        static $logger = null;
        if (is_null($logger)) {
            if (!class_exists('FileLog')) {
                Cache::import('FileLog.php');
            }
            $logger = new \FileLog('exception');
        }
        $logger->error('Message:' . $ex->getMessage() . "\nTrace:" . $ex->getTraceAsString() . PHP_EOL);
    }

    /**
     * 加载扩展
     * @param string $name
     */
    static public function import($name) {
        require_once(realpath(__DIR__ . '/../') . "/_extensions/" . $name);
    }

}
