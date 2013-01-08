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

        $this->logs[] = '<h3>初始规则库：</h3>';
        $this->_log('STAT');
        $this->logs[] = '<h3>初始事实：</h3>';
        $this->_log('FACT');

        $this->logs[] = '<h3>推理过程：</h3>';
        while ($r = $this->_find_available_rule()) {
            $this->logs[] = '选择使用规则' . $r->name;
            $this->_apply_rule($r);
        }

        $this->logs[] = '结束推理'.PHP_EOL;
        $this->logs[] = '<h3>最终规则库：</h3>';
        $this->_log('STAT');
        $this->logs[] = '<h3>最终事实：</h3>';
        $this->_log('FACT');
    }

    /**
     * 返回记录数组
     * @return array
     */
    public function get_log() {
        return $this->logs;
    }

    /**
     * 找到一条可用的规则，找到返回规则对象，找不到返回假
     * @return object | bool
     */
    private function _find_available_rule() {
        $rules = array();
        foreach ($this->rules as $r) {
            if (isset($r->used) && $r->used == true || isset($r->skip) && $r->skip == true) {  //检查规则是否已经用过或者跳过
                continue;
            }
            $is_available = array_diff($r->conditions, $this->facts); //规则的条件与条件库比较是否全部满足
            if (empty($is_available)) {
                $rules[]= $r;
            }
        }

        if (empty($rules)) {
            $this->logs[] = '找不到可用规则';
            return false;
        } else {
            if (count($rules) > 1) { //冲突消解
                $sort_assist = array();
                $names = array();
                foreach ($rules as $k => $r) {
                    $sort_assist[$k] = count($r->conditions); //取条件数量作为精确性排序因子
                    $names[] = $r->name;
                }
                $this->logs[] = '找到可用规则：'.implode(', ', $names);
                array_multisort($sort_assist, $rules); //排序
            }
            return array_shift($rules);
        }

    }

    /**
     * 应用一条规则（添加规则结果到已知事实库）
     * @param $r 规则对象
     */
    private function _apply_rule($r) {
        $r->used = true;
        $this->facts = array_merge($this->facts, $r->results);
        $this->logs[] = '得到新事实：' . implode(', ', $r->results);

        foreach($this->rules as $ru) { //智能略过结论以得出的规则
            if (isset($ru->used) && $ru->used == true || isset($ru->skip) && $ru->skip == true) {  //检查规则是否已经用过或者跳过
                continue;
            }
            $is_contained = array_diff($ru->results, $r->results);
            if (empty($is_contained)) {
                $this->logs[] = '标记相同结论的规则' . $ru->name . '为智能略过';
                $ru->skip = true;
            }
        }
        $this->logs[] = '';
    }

    /**
     * 记录日志
     * @param $log
     */
    private function _log($log) {
        if ($log == 'STAT') {// 记录当前全系统状态
            $this->logs[] = $this->_get_rules_stat();
        } else if ($log == 'FACT') {
            $this->logs[] = '动物 ' . implode(', ', $this->facts) . PHP_EOL;
        } else {
            $this->logs[] = $log;
        }
    }

    private function _get_rules_stat() {
        $stat = '';
        foreach($this->rules as $r) {
            $stat .= $r->name . ': ';
            $stat .= '若动物 ' . implode(" 且 ", $r->conditions);
            $stat .= '，则动物 ' . implode(" 且 ", $r->results);
            if (isset($r->used) && $r->used == true) {
                $stat .= ' <strong>已使用</strong> ';
            } else if (isset($r->skip) && $r->skip == true) {
                $stat .= ' <strong>已跳过</strong> ';
            }
            $stat .= PHP_EOL;
        }
        return $stat;
    }

    /**
     * 通过规则对象数组获得事实数组
     * @param $rules
     * @return array
     */
    public static function get_all_facts($rules) {
        $facts_hashtable = new stdClass();
        $facts = array();
        foreach($rules as $rule) {
            foreach($rule->conditions as $f) {
                $f = trim($f);
                $f_hash = md5($f);
                if (empty($facts_hashtable->$f_hash)) {
                    $facts_hashtable->$f_hash = $f;
                    $facts[] = $f;
                }
            }
        }
        return $facts;
    }

    /**
     * 返回默认规则库规则对象数组
     * @return mixed
     */
    public static function get_default_rules() {
        return json_decode(file_get_contents(RULES_LIB_PATH));
    }
}
