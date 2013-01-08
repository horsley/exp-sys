
    <div id="facts-list">
        <ul class="clearfix">
        <? foreach($facts as $t): ?>
        <li style="float: left; width: 50%;list-style: none;">
            <label class="checkbox">
                <input type="checkbox" name="facts[]" value="<?=$t?>"
                    <?=in_array($t, array('有毛发', '吃肉', '有黄褐色', '有暗斑点'))? 'checked="checked"':'' //书上例5.6?>>
                <?=$t?>
            </label>
        </li>
        <? endforeach; ?>
        </ul>
    </div>