<form method="POST" id="facts-form">
    <div>
        <ul class="clearfix">
        <? foreach($facts as $t): ?>
        <li style="float: left; width: 50%;list-style: none;">
            <label class="checkbox">
                <input type="checkbox" name="facts[]" value="<?=md5($t)?>"> <?=$t?> (<?t($t)?>)
            </label>
        </li>
        <? endforeach; ?>
        </ul>
    </div>
</form>