<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 13-1-8
 * Time: 下午4:46
 * To change this template use File | Settings | File Templates.
 *
 * @param $result array
 */
?>
<div class="result_log">
    <?=str_replace(PHP_EOL, '<br/>' . PHP_EOL, implode(PHP_EOL, $result)); ?>
</div>