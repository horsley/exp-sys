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

    /**
     * 加载规则库
     * @param string $rules_path 规则库文件路径，默认为常量RULES_LIB_PATH
     * @return bool
     */
    public function load($rules_path = RULES_LIB_PATH) {
        $tmp_json = json_decode(file_get_contents($rules_path));
        if (!empty($tmp_json)) {
            $this->rules = $tmp_json;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 导出规则库
     * @param $return 为真返回字符串，否则直接存到RULES_LIB_PATH，返回写入字节数（非零）
     * @return int|string
     */
    public function export($return) {
        if ($return) {
            return json_encode($this->rules);
        } else {
            return file_put_contents(RULES_LIB_PATH, json_encode($this->rules));
        }

    }
}
