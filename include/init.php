<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午9:13
 * To change this template use File | Settings | File Templates.
 */

//路径常量定义
if(!defined("SYS_ROOT")) define("SYS_ROOT", dirname(dirname(__FILE__)));
if(!defined("SYS_LIB_ROOT")) define("SYS_LIB_ROOT", SYS_ROOT . '/include');
if(!defined("APP_LIB_ROOT")) define("APP_LIB_ROOT", SYS_ROOT . '/library');

//模板文件路径定义
if (!defined('TPL_ROOT_PATH')) define('TPL_ROOT_PATH', SYS_ROOT . '/template');
if (!defined('TPL_FILE_EXT')) define('TPL_FILE_EXT', '.php');

//系统核心库加载
include_once(SYS_LIB_ROOT. '/template.php');

//应用类库加载
include_once(APP_LIB_ROOT . '/RuleLib.class.php');
include_once(APP_LIB_ROOT . '/Translation.class.php');

//应用函数库加载
include_once(APP_LIB_ROOT . '/functions.php');

//全局对象
$t = new Translation();
$t->load();

$rl = new RuleLib();
$rl->load();

$tpl = new Template();