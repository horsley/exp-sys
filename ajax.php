<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-19
 * Time: 下午12:02
 * To change this template use File | Settings | File Templates.
 */
include(dirname(__FILE__) . '/include/init.php');

if (!isset($_GET['action']) || !in_array($_GET['action'],
    array('load_default_rules', 'expsys_step2', 'expsys_step3', 'load_id3_data', 'run_id3'))) {
    die("ACTION ERROR!");
}

call_user_func($_GET['action']);

function load_default_rules() {
    global $tpl;
    $tpl->assign(array('rules' => ExpSys::get_default_rules()));
    $tpl->show('rules_list');
}

function expsys_step2() {
    global $tpl;
    $cur_rules = $_POST['rules'];
    $_SESSION['rules'] = $cur_rules;

    $facts = ExpSys::get_all_facts(convert_rules($cur_rules));
    $tpl->assign(array('facts' => $facts));
    $tpl->show('facts_list');
}

function expsys_step3() {

    global $tpl;
    $cur_facts = $_POST['facts'];
    $_SESSION['facts'] = $cur_facts;

    $sys = new ExpSys();
    $sys->set_rules(convert_rules($_SESSION['rules']));
    $sys->set_facts($cur_facts);
    $sys->infer();

    $tpl->assign(array('result' => $sys->get_log()));
    $tpl->show('result');
}

function load_id3_data() {
    global $tpl;
    $data_file = $_POST['file'] == 'id3_ex1' ? 3 : 4;
    $data_file = SYS_ROOT. "/data/id3.7-{$data_file}.php";

    $tpl->assign(array('data_file' => $data_file));
    $tpl->show("id3_showdata");
}

function run_id3() {
    global $tpl;
    $data_file = $_POST['file'] == md5(SYS_ROOT. "/data/id3.7-3.php") ? 3 : 4;
    $data_file = SYS_ROOT. "/data/id3.7-{$data_file}.php";

    //init node
    $tree = new DS_Tree();
    $node = array('name' => 'start');

    //init tree
    $tree->insert_node($node);
    $tree->goto_root();

    //init data
    $data = require($data_file);

    //init id3
    $id3 = new AI_ID3();
    $id3->init($data->attrlist, $data->values, $data->class, $data->instances, $tree);

    $id3->run();

    $output_head = <<<PHP
<?
//这里实在没有什么好办法画出一个数，就以节点数组输出了

\$tree =
PHP;

    $tpl->assign(array('data' => $output_head . $id3->tree->draw_tree()));
    $tpl->show("id3_result");
}
