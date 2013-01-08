<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午10:01
 * To change this template use File | Settings | File Templates.
 */



/**
 * 从前端提交规则数组中得到标准的规则对象数组
 * @param $rules_array
 * @return array
 */
function convert_rules($rules_array) {
    $rules = array();

    foreach($rules_array as $r) {
        $one_rule = new stdClass();
        $one_rule->name = $r['name'];
        $one_rule->conditions = explode(',', $r['cond']);
        $one_rule->conditions = array_map('trim', $one_rule->conditions);
        $one_rule->results = explode(',', $r['rslt']);
        $one_rule->results = array_map('trim', $one_rule->results);

        $rules[] = $one_rule;
    }

    return $rules;
}



/**
 * 浏览器URL重定向
 * @param string $url  URL
 * @param int $delay 延时
 * @param string $msg 输出信息
 */
function redirect($url, $delay = 0, $msg = '') {
    if (!headers_sent()) {
        if (0 === $delay) {
            header('Location: ' . $url);
        } else {
            header("Content-type: text/plain; charset=UTF-8");
            header("refresh:{$delay};url={$url}");
            echo($msg);
        }
        exit;
    } else {
        $str = "<meta http-equiv='Refresh' content='{$delay};URL={$url}'>";
        if ($delay != 0)
            $str .= $msg;
        exit($str);
    }
}

/**
 * 获取本系统存放的目录 对应的url
 * 当本系统部署在非站点根目录的时候 需要使用本函数获取系统根目录对应url
 * 其后没有斜杠
 */
function get_baseurl() {
    $baseURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

    if (!$host = $_SERVER['HTTP_HOST']) {
        if (!$host = $_SERVER['SERVER_NAME']) {
            $host = !empty($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '';
        }
    }
    $baseURL .= $host. ($_SERVER["SERVER_PORT"] == "80" ? '' : $_SERVER["SERVER_PORT"]);
    $baseURL .= get_basedir(); //去掉root目录和末尾的/index.php
    return $baseURL;
}

/**
 * 获取本系统存放的目录
 * 相对于站点根目录的相对目录
 * 只能是通过统一入口进入的调用
 * 返回的目录路径前面有杠，后面没杠
 * 如果部署在站点根目录，返回空文本
 */
function get_basedir() {
    return substr(dirname($_SERVER['SCRIPT_FILENAME']), strlen($_SERVER['DOCUMENT_ROOT']));
}