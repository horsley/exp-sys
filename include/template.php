<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-11-21
 * Time: 下午3:33
 * To change this template use File | Settings | File Templates.
 */
class Template {
    private $_data = array();
    private $_tpl_name;

    function __construct($tpl_name = '') {
        $this->_tpl_name = $tpl_name;
    }

    /**
     * 模板数据赋值 key会渲染成变量名  value就是变量值
     * @param array $data
     */
    public function assign($data = array()) {
        $this->_data = array_merge($this->_data, $data);
    }

    /**
     * 返回模版渲染之后的内容，失败返回假
     * @param string $tpl_name
     * @return bool|string
     */
    public function fetch($tpl_name = '') {
        if($tpl_name == '' && $this->_tpl_name != '') {
            $tpl_name = $this->_tpl_name;
        }

        $tpl_path = TPL_ROOT_PATH . '/' . $tpl_name . TPL_FILE_EXT;
        if (file_exists($tpl_path)) {
            extract($this->_data, EXTR_SKIP);

            ob_start();
            include $tpl_path;
            $content = ob_get_contents();
            ob_end_clean();

            return $content;
        } else {
            trigger_error('模板文件不存在！');
            return FALSE;
        }
    }

    /**
     * 输出模板
     * @param string $tpl_name
     */
    public function show($tpl_name = '') {
        if($content = $this->fetch($tpl_name)) {
            echo $content;
        }
    }

}