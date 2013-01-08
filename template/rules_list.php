<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午9:31
 * To change this template use File | Settings | File Templates.
 *
 * @param $rules
 */

?>

<table class="table table-hover" id="rules-list">
    <thead><tr><th>规则名</th><th>条件</th><th>结论</th></tr></thead>
    <tbody>
    <? foreach($rules as $r): ?>
    <tr data-rule-name="<?=$r->name?>" data-rule-cond="<? echo implode(", ", $r->conditions); ?>" data-rule-rslt="<? echo implode(", ", $r->results); ?>">
        <td><?=$r->name?></td>
        <td>
            <div>若动物 <span class="cond-field"><? echo implode(" 且 ", $r->conditions); ?></span></div>
        </td>
        <td>
            <div>则动物 <span class="rslt-field"><? echo implode(" 且 ", $r->results); ?></span></div>
        </td>
    </tr>
    <? endforeach; ?>
    </tbody>
</table>