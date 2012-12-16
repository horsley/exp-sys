<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-16
 * Time: 下午10:19
 * To change this template use File | Settings | File Templates.
 */
if (!defined("TRAN_DICT_PATH")) define("TRAN_DICT_PATH", dirname(dirname(__FILE__)) . '/data/translations.json');

class Translation
{
    private $dict; //字典（词条集）对象

    /**
     * 加载字典
     * @param string $dict_path 字典文件路径，默认为常量TRAN_DICT_PATH
     * @return bool
     */
    public function load($dict_path = TRAN_DICT_PATH) {
        $tmp_json = json_decode(file_get_contents($dict_path));
        if (!empty($tmp_json)) {
            $this->dict = $tmp_json;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 导出字典
     * @param $return 为真返回字符串，否则直接存到TRAN_DICT_PATH，返回写入字节数（非零）
     * @return int|string
     */
    public function export($return) {
        if ($return) {
            return json_encode($this->dict);
        } else {
            return file_put_contents(TRAN_DICT_PATH, json_encode($this->dict));
        }

    }

    /**
     * 翻译词条
     * @param $term 源词条
     * @return bool 返回翻译，不存在对应词条返回假
     */
    public function translate($term) {
        if ($this->term_exists($term)) {
            return $this->dict->$term;
        } else {
            return false;
        }
    }

    /**
     * 添加词条
     * @param $term 词条
     * @param $translation 翻译
     * @param bool $force 是否强制覆盖现有相同词条的翻译，默认为假
     * @return bool 成功添加新词条返回真，否则返回假
     */
    public function add_term($term, $translation, $force = false) {
        if (!$force && $this->term_exists($term)) {
            return false;
        } else {
            $this->dict->$term = $translation;
            return true;
        }
    }

    /**
     * 修改词条翻译
     * @param $term 词条
     * @param $translation 翻译
     * @param bool $add_if_not_exists 如果词条不存在是否新增，默认为真
     * @return bool
     */
    public function update_term($term, $translation, $add_if_not_exists = true) {
        if ($add_if_not_exists || $this->term_exists($term)) {
            return $this->add_term($term, $translation, true);
        } else {
            return false;
        }
    }

    /**
     * 删除词条
     * @param $term
     * @return bool
     */
    public function del_term($term) {
        if ($this->term_exists($term)) {
            unset($this->dict->$term);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 检查词条是否存在
     * @param $term
     * @return bool
     */
    public function term_exists($term) {
        return !empty($this->dict->$term);
    }
}
