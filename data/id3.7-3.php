<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 13-1-8
 * Time: 下午7:11
 * To change this template use File | Settings | File Templates.
 */

$data_7_3 = new stdClass(); //例7.3的数据

//分类结果
$data_7_3->class = array("N", "P");

//值域
$data_7_3->values = array(
    "身高" => array("矮", "高"),
    "发色" => array("亚麻色", "棕色", "黑色"),
    "眼色" => array("蓝色", "黑色")
);

//初始属性表
$data_7_3->attrlist = array('身高', '发色', '眼色');

//实例集
$data_7_3->instances = array(
    array("身高" => "矮", "发色" => "亚麻色", "眼色" => "蓝色", "类别" => "P"),
    array("身高" => "高", "发色" => "亚麻色", "眼色" => "黑色", "类别" => "N"),
    array("身高" => "高", "发色" => "棕色", "眼色" => "蓝色", "类别" => "P"),
    array("身高" => "矮", "发色" => "黑色", "眼色" => "蓝色", "类别" => "N"),
    array("身高" => "高", "发色" => "黑色", "眼色" => "蓝色", "类别" => "N"),
    array("身高" => "高", "发色" => "亚麻色", "眼色" => "蓝色", "类别" => "P"),
    array("身高" => "高", "发色" => "黑色", "眼色" => "黑色", "类别" => "N"),
    array("身高" => "矮", "发色" => "亚麻色", "眼色" => "黑色", "类别" => "N")
);

return $data_7_3;