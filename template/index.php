<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-19
 * Time: 上午12:02
 * To change this template use File | Settings | File Templates.
 */
include(TPL_ROOT_PATH . '/common_head.php');?>
<body>
    <div class="container">
        <div></div>
        <div class="progress">
            <div class="bar" style="width: 25%"></div>
        </div>
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
                <div class="well t-center">
                    <div style="padding-bottom: 2em;"><a class="btn btn-primary" id="start-infer"><i class="icon-play icon-white"></i> 开始推理</a></div>
                    <textarea id="infer-result" style="height: 300px;width: 95%;"></textarea>
                </div>
            </div>
            <div id="about"></div>
    </div>



</body>
</html>