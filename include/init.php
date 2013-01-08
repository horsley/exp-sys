<?php
/**
 * 项目入口文件
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午9:13
 * To change this template use File | Settings | File Templates.
 */

//调试报错信息开关
error_reporting(E_ALL);

//路径常量定义
if(!defined("SYS_ROOT")) define("SYS_ROOT", dirname(dirname(__FILE__)));
if(!defined("SYS_LIB_ROOT")) define("SYS_LIB_ROOT", SYS_ROOT . '/include');
if(!defined("APP_LIB_ROOT")) define("APP_LIB_ROOT", SYS_ROOT . '/library');
if(!defined("RULES_LIB_PATH")) define("RULES_LIB_PATH", SYS_ROOT . '/data/rules.default.json');

//模板文件路径定义
if (!defined('TPL_ROOT_PATH')) define('TPL_ROOT_PATH', SYS_ROOT . '/template');
if (!defined('TPL_FILE_EXT')) define('TPL_FILE_EXT', '.php');

//系统核心库加载
include_once(SYS_LIB_ROOT. '/template.php');

//应用函数库加载
include_once(APP_LIB_ROOT . '/functions.php');
include_once(APP_LIB_ROOT . '/ExpSys.class.php');   //专家系统

include_once(APP_LIB_ROOT . '/AI_ID3.class.php');   //ID3
include_once(APP_LIB_ROOT . '/DS_Tree.class.php');  //
//全局对象

$tpl = new Template();

session_start();