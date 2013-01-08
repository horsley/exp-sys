<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 13-1-5
 * Time: 下午9:54
 * To change this template use File | Settings | File Templates.
 */include(TPL_ROOT_PATH . '/common_head.php');?>
<body>
<div class="container step1">
    <div class="page-header">
        <h1>动物推理系统 <small>规则库</small></h1>
    </div>
    <div style="height: 400px; overflow-y: auto; border: 1px #ccc solid" id="main-area">
        <? include(TPL_ROOT_PATH . "/rules_list.php"); ?>
    </div>
    <div class="well well-small action-bar clearfix">
        <button class="btn btn-primary pull-right" name='btnNext'>下一步</button>
        <button class="btn" name='addRule'>添加规则</button>
        <button class="btn" name='modifyRule'>修改规则</button>
        <button class="btn" name='delRule'>删除规则</button>
        <button class="btn" name='loadDef'>恢复默认</button>
    </div>
    <? include(TPL_ROOT_PATH . "/common_footer.php"); ?>
    <div id="dlgEdit" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Modal header</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">规则名</label>
                    <div class="controls"><input name='rule-name' type="text"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">规则条件</label>
                    <div class="controls"><input name='rule-cond' type="text"><span class="help-block">用半角逗号分割多个条件</span></div>
                </div>
                <div class="control-group">
                    <label class="control-label">规则结论</label>
                    <div class="controls"><input name='rule-rslt' type="text"><span class="help-block">用半角逗号分割多个结论</span></div>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">取消</a>
            <button class="btn btn-primary" name="btnEditOK">确定</button>
        </div>
    </div>
</div>
</body>
</html>