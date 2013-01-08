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
        <h1>ID3归纳学习算法演示 <small>选择实例</small></h1>
    </div>
    <div style="height: 400px; overflow-y: auto; border: 1px #ccc solid" id="main-area">
        <? include(TPL_ROOT_PATH . "/id3_showdata.php"); ?>
    </div>

    <div class="well well-small action-bar clearfix">
        <button class="btn btn-primary pull-right" name='btnID3'>应用算法</button>
        <button class="btn" name='id3_ex1'>例子7.3</button>
        <button class="btn" name='id3_ex2'>例子7.4</button>
    </div>
    <? include(TPL_ROOT_PATH . "/common_footer.php"); ?>

    <style>
        /*.syntaxhighlighter .line {*/
            /*white-space: pre !important;*/
            /*white-space: pre-wrap !important;*/
            /*white-space: -moz-pre-wrap !important;*/
            /*white-space: -pre-wrap !important;*/
            /*white-space: -o-pre-wrap !important;*/
            /*word-wrap: break-word !important;*/
        /*}*/
        .syntaxhighlighter {
            overflow-y: hidden !important;
        }
    </style>
    <script type="text/javascript">
        SyntaxHighlighter.defaults['gutter'] = false;
        SyntaxHighlighter.defaults['toolbar'] = false;
        SyntaxHighlighter.all();
    </script>
</div>
</body>
</html>