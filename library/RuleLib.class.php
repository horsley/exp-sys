<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-16
 * Time: 下午11:09
 * To change this template use File | Settings | File Templates.
 */
if (!defined("RULES_LIB_PATH")) define("RULES_LIB_PATH", dirname(dirname(__FILE__)) . '/data/rules.default.json');

class RuleLib
{
    private $rules; //规则数组
    private $facts; //静态事实数组 key=fact-name  value=hash
    private $facts_hashtable; //事实哈希表

    public function __construct() {
        $this->facts_hashtable = new stdClass();
    }

    /**
     * 加载规则库
     * @param string $rules_path 规则库文件路径，默认为常量RULES_LIB_PATH
     * @return bool
     */
    public function load($rules_path = RULES_LIB_PATH) {
        $tmp_json = json_decode(file_get_contents($rules_path));
        if (!empty($tmp_json)) {
            $this->rules = $tmp_json;
            $this->_extract_facts();    //trigger to make hash table for facts
            return true;
        } else {
            return false;
        }
    }

    /**
     * 导出规则库
     * @param $return 为真返回字符串(json)，否则直接存到RULES_LIB_PATH，返回写入字节数（非零）
     * @return int|string
     */
    public function export($return) {
        if ($return) {
            return json_encode($this->rules);
        } else {
            return file_put_contents(RULES_LIB_PATH, json_encode($this->rules));
        }

    }

    /**
     * 返回全部事实的文本数组
     * @return array
     */
    public function get_all_facts() {
        return $this->facts;
    }

    /**
     * 提起规则库中的事实
     */
    private function _extract_facts() {
        foreach($this->rules as $rule) {
            foreach($rule->conditions as $f) {
                $f = trim($f);
                $f_hash = md5($f);
                if (empty($this->facts_hashtable->$f_hash)) {
                    $this->facts_hashtable->$f_hash = $f;
                    $this->facts[] = $f;
                }
            }
        }

    }
}
