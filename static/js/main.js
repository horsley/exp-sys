/**
 * Created with JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午10:49
 * To change this template use File | Settings | File Templates.
 */
$(function(){
    $('input[name="facts[]"]').change(function(){
        //已知事实不为空取消提示tooltip
        var chosen_facts = $('#facts-form').serialize();
        if (chosen_facts) {
            $('#start-infer').tooltip('destroy');
        }
    });
    $('#start-infer').click(function(){
        //已知事实为空检查
        var chosen_facts = $('#facts-form').serialize();
        if (!chosen_facts) {
            $(this).tooltip({title: "你尚未选择任何初始事实，无法开始推理！", trigger: 'manual'});
            $(this).tooltip('show');
            return false;
        }

        $.get('ajax.php?action=start_infer', chosen_facts, function(data) {
            $('#infer-result').html(data);
        });

        return false;
    })
});