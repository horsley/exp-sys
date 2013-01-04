<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午9:15
 * To change this template use File | Settings | File Templates.
 */
include(dirname(__FILE__) . '/include/init.php');

$tpl->assign(array(
    'rules' => json_decode($rl->export(true)),
    'facts' => $rl->get_all_facts()
));
$tpl->show("index");
