<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午9:15
 * To change this template use File | Settings | File Templates.
 */
include(dirname(__FILE__) . '/include/init.php');

if (isset($_GET['show']) && $_GET['show'] == 'id3') {
    $tpl->assign(array('extra_head' => '
        <link rel="stylesheet" type="text/css" href="static/css/shCore.css">
        <link rel="stylesheet" type="text/css" href="static/css/shThemeDefault.css">

        <script type="text/javascript" src="static/js/shCore.js"></script>
        <script type="text/javascript" src="static/js/shBrushPhp.js"></script>
    '));
    $tpl->show("index_id3");
} else {
    $tpl->assign(array('rules' => ExpSys::get_default_rules()));
    $tpl->show("index");
}




