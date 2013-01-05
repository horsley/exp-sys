<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午10:01
 * To change this template use File | Settings | File Templates.
 */

/**
 * 返回默认规则库规则对象数组
 * @return mixed
 */
function get_default_rules() {
    return json_decode(file_get_contents(RULES_LIB_PATH));
}