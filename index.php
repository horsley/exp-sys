<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午9:15
 * To change this template use File | Settings | File Templates.
 */
include(dirname(__FILE__) . '/include/init.php');

if (!isset($_GET['step']) || !in_array($_GET['step'], array(1, 2, 3))) {
    $_GET['step'] = 1;
}

switch ($_GET['step']) {
    case 1:
        $tpl->assign(array('rules' => get_default_rules()));
        $tpl->show("step1");
        break;
}

