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

class Url {

    /**
     * URL-encodes string
     * @param mixed $code  要进行URL编码的数据
     * @return mixed
     */
    static public function encode($code) {
        if (is_array($code)) {
            foreach ($code as $key => $value) {
                if (is_array($value)) {
                    $code[$key] = self::encode($value);
                } elseif (is_string($value)) {
                    $code[$key] = urlencode($value);
                }
            }
        } else {
            $code = urlencode($code);
        }

        return $code;
    }

    /**
     * URL-decodes string
     * @param mixed $code  要进行URL解码的数据
     * @return mixed
     */
    static public function decode($code) {
        if (is_array($code)) {
            foreach ($code as $key => $value) {
                if (is_array($value)) {
                    $code[$key] = self::decode($value);
                } elseif (is_string($value)) {
                    $code[$key] = urldecode($value);
                }
            }
        } else {
            $code = urldecode($code);
        }

        return $code;
    }

}
