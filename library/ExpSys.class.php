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
    private $rules = array(); //当前运行时规则库数组 规则对象参看默认规则库
    private $facts = array(); //当前已知事实数组
    private $logs = array(); //推理日志

    /**
     * 设置运行时规则库数组
     * @param $r
     * @return bool
     */
    public function set_rules($r) {
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
    public function set_facts($f) {
        if(is_array($f) && !empty($f)) {
            $this->facts = $f;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 取出当前事实数组
     * @return array
     */
    public function get_facts() {
        return $this->facts;
    }

    /**
     * 推理过程
     */
    public function infer() {
        while ($r = $this->_find_available_rule()) {
            $this->_apply_rule($r);
        }
    }

    /**
     * 找到一条可用的规则，找到返回规则对象，找不到返回假
     * @return object | bool
     */
    private function _find_available_rule() {
        foreach ($this->rules as $r) {
            if (isset($r->used) && $r->used == true) {  //检查规则是否已经用过
                continue;
            }
            $available = array_diff($r->conditions, $this->facts); //规则的条件与条件库比较是否全部满足
            if (empty($available)) {
                return $r;
            }
        }
        return false;
    }

    /**
     * 应用一条规则（添加规则结果到已知事实库）
     * @param $r 规则对象
     */
    private function _apply_rule($r) {
        $r->used = true;
        $this->facts = array_merge($this->facts, $r->results);
    }
}
