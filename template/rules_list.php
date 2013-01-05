<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午9:31
 * To change this template use File | Settings | File Templates.
 */

?>
<table class="table table-hover" id="rules-list">
    <thead><tr><th>规则名</th><th>条件</th><th>结论</th><th>操作</th></tr></thead>
    <tbody>
    <? foreach($rules as $r): ?>
    <tr id="rn-<?=$r->name?>">
        <td><?=$r->name?></td>
        <td style="clear: both;">
            <div>若动物<br /><? echo implode(" 且<br />", $r->conditions); ?></div>
        </td>
        <td style="clear: both;">
            <div>则动物<br /><? echo implode(" 且<br />", $r->results); ?></div>
        </td>
        <td><div class="rule-operation"><a class="btn rule-modify" href="#">修改</a><a class="btn rule-delete" href="#">删除</a></div></td>
    </tr>
    <? endforeach; ?>
    </tbody>
</table>