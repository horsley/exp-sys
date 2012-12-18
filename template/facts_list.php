<form method="POST">
    <div>
        <ul class="clearfix">
        <? foreach($facts as $t): ?>
        <li style="float: left; width: 50%;list-style: none;">
            <label class="checkbox">
                <input type="checkbox" name="<?=md5($t)?>"> <?=$t?> (<?t($t)?>)
            </label>
        </li>
        <? endforeach; ?>
        </ul>
    </div>
</form>