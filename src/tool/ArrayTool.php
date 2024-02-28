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

class ArrayTool {

    static public function replace($search, $replace, &$data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    self::replace($search, $replace, $data[$key]);
                } else {
                    $data[$key] = str_replace($search, $replace, $value);
                }
            }
        } else {
            $data = str_replace($search, $replace, $data);
        }
        return $data;
    }

    /**
     * 根据权重获取数组元素
     * @param array $array
     * @param string $weightKey
     * @return array
     */
    static public function weightRandom($array, $weightKey = 'weight') {
        $count = 0;
        foreach ($array as $item) {
            $count += isset($item[$weightKey]) ? $item[$weightKey] : 1;
        }
        $minNum    = 0;
        $maxNum    = 0;
        $randomNum = random_int($minNum, $count);
        foreach ($array as $item) {
            $maxNum += isset($item[$weightKey]) ? $item[$weightKey] : 1;
            if ($minNum < $randomNum && $randomNum <= $maxNum) {
                return $item;
            }
            $minNum += isset($item[$weightKey]) ? $item[$weightKey] : 1;
        }
        return $array[array_rand($array)];
    }

}
