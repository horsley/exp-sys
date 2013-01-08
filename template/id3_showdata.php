<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 13-1-8
 * Time: 下午8:00
 * To change this template use File | Settings | File Templates.
 */
if (!isset($data_file)) $data_file = SYS_ROOT. '/data/id3.7-3.php';
?>
<div id="id3_data">
    <pre class="brush: php"><?=htmlspecialchars(file_get_contents($data_file)); ?></pre>
    <input type="hidden" name='file' value="<?=md5($data_file)?>">
</div>