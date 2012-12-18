<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午10:01
 * To change this template use File | Settings | File Templates.
 */

/**
 * 输出词条翻译
 * @param $term
 * @param $return 返回还是直接输出
 * @return string 返回字符串
 */
function t($term, $return = false) {
    global $t;
    if (empty($t)) {
        $t = new Translation();
    }
    $term = trim($term);
    if ($return) {
        return $t->translate($term);
    } else {
        echo $t->translate($term);
    }

}