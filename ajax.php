<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-19
 * Time: 下午12:02
 * To change this template use File | Settings | File Templates.
 */
include(dirname(__FILE__) . '/include/init.php');

if (!isset($_GET['action']) || !in_array($_GET['action'], array('start_infer'))) {
    die("ACTION ERROR!");
}

call_user_func($_GET['action']);

function start_infer() {
    global $rl;

    //取得推理用的事实
    $facts = $rl->get_facts_by_hash($_GET['facts']);

    $ex = new ExpSys();
    $ex->setRules(json_decode($rl->export(true)));
    $ex->setFacts($facts);

}

