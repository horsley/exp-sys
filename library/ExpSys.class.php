<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-18
 * Time: 下午9:18
 * To change this template use File | Settings | File Templates.
 */
class ExpSys
{
    private $rules; //当前运行时规则库数组
    private $facts; //当前已知事实数组
    private $logs; //推理日志

    /**
     * 设置运行时规则库数组
     * @param $r
     * @return bool
     */
    public function setRules($r) {
        if (is_array($r) && !empty($r)) {
            $this->rules = $r;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 设置已知事实
     * @param $f
     * @return bool
     */
    public function setFacts($f) {
        if(is_array($f) && !empty($f)) {
            $this->facts = $f;
            return true;
        } else {
            return false;
        }
    }

    public function infer() {

    }

    private function _find_available_rule() {

    }
}
