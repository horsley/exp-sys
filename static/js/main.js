/**
 * Created with JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午10:49
 * To change this template use File | Settings | File Templates.
 */
$(function(){
    var ma = $('#main-area');
    var rl = $('#rules-list').find('tbody'); //规则表格
    var dlg = $('#dlgEdit'); //规则编辑模态窗口
    var btnMod = $('button[name="modifyRule"]');
    var btnDel = $('button[name="delRule"]');
    var btnNext = $('button[name="btnNext"]');
    var title = $('.page-header').find('small');

    //规则选择
    rl.find('td').live('click', function() {
        $(this).parents('tbody').find('.selected').removeClass('selected')
        $(this).parent().addClass('selected');

        if (btnMod.parent().find('.tooltip').length != 0) { //旧错误提示的清除
            btnMod.tooltip('destroy');
        }
        if (btnDel.parent().find('.tooltip').length != 0) { //旧错误提示的清除
            btnDel.tooltip('destroy');
        }
    });

    //添加规则
    $('button[name="addRule"]').live('click', function(){
        dlg.find('.modal-header').find('h3').html('添加规则');
        clearModalData();
        dlg.modal('show');
    });

    //修改规则
    btnMod.live('click', function(){
        if ($(this).parent().find('.tooltip').length != 0) { //旧错误提示的清除
            $(this).tooltip('destroy');
        }
        if (rl.find('.selected').length == 1) {
            dlg.find('.modal-header').find('h3').html('修改规则');
            loadDataFromtr();
            dlg.modal('show');
        } else {
            if ($(this).parent().find('.tooltip').length != 0) {
                $(this).tooltip('destroy');
            }
            $(this).tooltip({
                trigger: 'manual',
                title: '请先在上表点击选中一条规则'
            });
            $(this).tooltip('show');
        }

    });

    //删除规则
    btnDel.live('click', function(){
        if (rl.find('.selected').length == 1) {
            rl.find('.selected').remove(); //并不删除节点，而是变成隐藏，作为删除标记
        } else {
            if ($(this).parent().find('.tooltip').length != 0) {
                $(this).tooltip('destroy');
            }
            $(this).tooltip({
                trigger: 'manual',
                title: '请先在上表点击选中一条规则'
            });
            $(this).tooltip('show');
        }
    });

    //ajax加载默认规则
    $('button[name="loadDef"]').live('click', function(){
        ma.load('ajax.php?action=load_default_rules', function(){
            rl = $('#rules-list').find('tbody');
        });
    });


    //确认修改
    $('button[name="btnEditOK"]').live('click', function(){
        dlg.find('input[name^="rule-"]').each(function(x){
            if ($.trim($(this).val()) == '') {
                $(this).parents('.control-group').addClass('error');
            } else {
                $(this).parents('.control-group').removeClass('error');
            }
        });
        if (dlg.find('.error').length != 0) {
            return false;
        }
        if (dlg.find('.modal-header').find('h3').html() == '修改规则') {
            saveData2tr();
        } else {
            saveData2tr(true);
        }
        dlg.modal('hide');
    });

    //下一步选择事实
    btnNext.live('click', function(){
        if ($('#rules-list').length) {//第一步 -> 第二步
            //提交当前用户选择的规则，本来通过修改、新增和删除标记可以只传输修改部分
            // //但是合并更改太麻烦，索性直接传输这里的所有规则
            var cur_rules = [];

            rl.find('tr:visible').each(function(x){
                cur_rules.push({
                    name: $(this).attr('data-rule-name'),
                    cond: $(this).attr('data-rule-cond'),
                    rslt: $(this).attr('data-rule-rslt')
                })
            });

            ma.load('ajax.php?action=expsys_step2', {rules: cur_rules});

            //工具条转变
            btnDel.hide();
            btnMod.hide();
            $('button[name="loadDef"]').hide();
            $('button[name="addRule"]').hide();
            title.html('初始事实选择');
            return;
        }


        var fl = $('#facts-list');
        var checkboxes = fl.find('input[type="checkbox"]:checked');
        checkboxes.live('change', function() {
            if (btnNext.parent().find('.tooltip').length != 0) {
                btnNext.tooltip('destroy');
            }
        });

        if (fl.length) {//第二步 -> 推理
            var init_facts = [];
            if (checkboxes.length == 0) {
                if ($(this).parent().find('.tooltip').length != 0) {
                    $(this).tooltip('destroy');
                }
                $(this).tooltip({
                    trigger: 'manual',
                    title: '请先选择一些初始事实'
                });
                $(this).tooltip('show');
                return false;
            }  else {
                checkboxes.each(function(){
                   init_facts.push($(this).val());
                });
                ma.load('ajax.php?action=expsys_step3', {facts: init_facts});

                //工具条转变
                $(this).html('重置');
                title.html('推理结果');
                return;
            }
        }
        //重置
        window.location.reload();

    });

    /////////////////id3//////////////////////
    //加载实例
    $('button[name^="id3_ex"]').live('click', function(){
        $('button[name="btnID3"]').tooltip('destroy');
        ma.load('ajax.php?action=load_id3_data', {file: $(this).attr('name')}, function(){
            if (SyntaxHighlighter != 'undefined') {
                SyntaxHighlighter.highlight();
            } else {
                SyntaxHighlighter.all();
            }
        });
    });

    //执行运算
    $('button[name="btnID3"]').live('click', function(){
        var fid = $('input[name="file"]');
        if (fid.length == 0) {
            if ($(this).parent().find('.tooltip').length != 0) {
                $(this).tooltip('destroy');
            }
            $(this).tooltip({
                trigger: 'manual',
                title: '请先选择一组数据'
            });
            $(this).tooltip('show');
            return false;
        } else {
            $(this).tooltip('destroy');
        }
        ma.load('ajax.php?action=run_id3', {file: fid.val()}, function(){
            if (SyntaxHighlighter != 'undefined') {
                SyntaxHighlighter.highlight();
            } else {
                SyntaxHighlighter.all();
            }
        });
    });

    function clearModalData() {
        var the_tr = rl.find('.selected');
        dlg.find('input[name="rule-name"]').val('');
        dlg.find('input[name="rule-cond"]').val('');
        dlg.find('input[name="rule-rslt"]').val('');
    }
    function loadDataFromtr() {
        var the_tr = rl.find('.selected');
        dlg.find('input[name="rule-name"]').val(the_tr.attr('data-rule-name'));
        dlg.find('input[name="rule-cond"]').val(the_tr.attr('data-rule-cond'));
        dlg.find('input[name="rule-rslt"]').val(the_tr.attr('data-rule-rslt'));
    }
    function saveData2tr(add) {
        var the_tr = rl.find('.selected');
        if (add) {
            the_tr = rl.find('tr:first-child').clone().appendTo(rl);
        }
        var name = dlg.find('input[name="rule-name"]').val();
        var cond = dlg.find('input[name="rule-cond"]').val();
        var rslt = dlg.find('input[name="rule-rslt"]').val();

        var modify_flag = false;
        if (the_tr.attr('data-rule-name') != name) {
            the_tr.attr('data-rule-name', name);
            modify_flag = true;
        }
        if (the_tr.attr('data-rule-cond') != cond) {
            the_tr.attr('data-rule-cond',cond);
            modify_flag = true;
        }
        if (the_tr.attr('data-rule-rslt') != rslt) {
            the_tr.attr('data-rule-rslt',rslt);
            modify_flag = true;
        }
        if (modify_flag) {
            //更新显示
            cond = cond.replace(/,/g, ' 且');
            rslt = rslt.replace(/,/g, ' 且');
            the_tr.find('td:first-child').html(name);
            the_tr.find('.cond-field').html(cond);
            the_tr.find('.rslt-field').html(rslt);
        }
    }
});