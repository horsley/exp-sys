<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-19
 * Time: 上午12:02
 * To change this template use File | Settings | File Templates.
 */
include(TPL_ROOT_PATH . '/common_head.php');?>
<body data-spy="scroll" data-target=".navbar">
    <div class="navbar navbar-fixed-top">
        <div id="nav" class="navbar-inner">
            <div class="container">
                <a class="brand" href="#home">动物识别系统</a>
                <ul class="nav">
                    <li class="active"><a href="#rule-lib"><i class="icon-arrow-right"></i> 规则库</a></li>
                    <li><a href="#init-facts"><i class="icon-arrow-right"></i> 初始事实</a></li>
                    <li><a href="#inference"><i class="icon-arrow-right"></i> 进行推理</a></li>
                    <li><a href="#about"><i class="icon-info-sign"></i>关于</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="home">
            <div id="rule-lib">
                <div class="page-header">
                    <h3>规则库</h3>
                </div>
                <div style="height: 450px; overflow-y: auto;">
                    <? include(TPL_ROOT_PATH . "/rules_list.php"); ?>
                </div>
            </div><br /><br /><br />
            <div id="init-facts">
                <div class="page-header">
                    <h3>初始事实</h3>
                </div>
                <div style="height: 450px; overflow-y: auto;">
                    <? include(TPL_ROOT_PATH . "/facts_list.php"); ?>
                </div>
            </div>
            <div id="inference">
                <div class="page-header">
                    <h3>进行推理</h3>
                </div>
            </div>
            <div id="about"></div>
        </div>
    </div>



</body>
</html>