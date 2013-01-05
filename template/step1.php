<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 13-1-5
 * Time: 下午9:54
 * To change this template use File | Settings | File Templates.
 */include(TPL_ROOT_PATH . '/common_head.php');?>
<body>
<div class="container">
    <div class="page-header">
        <h3>规则库</h3>
    </div>
    <div style="height: 450px; overflow-y: auto;">
        <? include(TPL_ROOT_PATH . "/rules_list.php"); ?>
    </div>
</div>
</body>
</html>