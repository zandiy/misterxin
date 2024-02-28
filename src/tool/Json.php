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

class Json {

    /**
     * 数据编译为json字符串
     * @param array $data
     * @return string
     */
    static public function encode($data) {
        if (!is_array($data)) {
            return $data;
        }

        $array = Url::encode($data);
        $json = json_encode($array);
        $json = str_replace(array('%5C', '%22', '%0D', '%0A', '%09'), array('%5C%5C', '%5C%22', '%5Cr', '%5Cn', '%5Ct'), $json);
        $json = Url::decode($json);

        return $json;
    }

    /**
     * json字符串解码为数组
     * @param string $data
     * @return array
     */
    public static function decode($data) {
        if (is_array($data)) {
            return $data;
        } elseif (is_string($data) && in_array($data[0], ['{', '['])) {
            return (array) json_decode(str_replace(array("\r", "\n", "\t"), array("\\r", "\\n", "\\t"), $data), TRUE);
        } else {
            return $data;
        }
    }

}
