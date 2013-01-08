<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-29
 * Time: 上午10:57
 * To change this template use File | Settings | File Templates.
 */
if(!defined('NODE_NAME')) define('NODE_NAME', 'name');
if(!defined('NODE_CLASS_NAME')) define('NODE_CLASS_NAME', '类别');

class AI_ID3
{
    private $AttrList = array(); //初始属性表
    private $Values = array(); //值域  对象
    private $Class = array(); //分类结果
    private $Instance = array(); //实例集 json
    public $tree = array();   //决策树

    private $log = array(); //调试日志输出
    private $dbg_c = 0;

    private $class_name = NODE_CLASS_NAME;

    public function init($AttrList, $Values, $Class, $Instance, $tree) {
        $this->AttrList = $AttrList;
        $this->Values = $Values;
        $this->Class = $Class;
        $this->Instance = $Instance;
        $this->tree = $tree;

    }

    public function run() {
        while(!$this->check_completed()) {
//            if (empty($this->AttrList)) {
//                var_dump($this);
//                throw new Exception("AttrList is empty!");
//            }

            $attr = $this->get_minI_attr();
            $this->log[] = $attr;
            $attr_key = array_search($attr, $this->AttrList);
            unset($this->AttrList[$attr_key]);  //删除属性表中的属性

            $this->tree->update_node_attr('name', $attr);

            $this->make_tree($attr);

            if (empty($this->AttrList)) {
                echo '<pre class="brush: php">';
                var_export($this->tree);
                var_export($this->log);
                echo '</pre>';
                exit;
                throw new Exception("AttrList is empty!");
            }
        }
    }

    /**
     * 检查是否可以终止算法
     * @return bool
     */
    private function check_completed() {
        $leaf_nodes = $this->tree->get_leafs();
        $end_flag = true;
        foreach ($leaf_nodes as $n) {
            if(!in_array($n[NODE_NAME], $this->Class)) {
                $end_flag = false;
                break;
            }
        }
        return $end_flag;
    }

    /**
     * 计算实例集子集的熵
     * @param $subset
     * @return float|int
     */
    private function calculate_entropy($subset) {
        $ret = 0;

        $e = array(); //实例数
        foreach($this->Class as $c) { //初始化实例数计数数组
            $e[$c] = 0;
        }
        $e_all = count($subset);

        foreach($subset as $s) { //计算每个属性的实例数
            if (isset($e[$s[$this->class_name]])) {
                $e[$s[$this->class_name]]++;
            }
        }


        foreach($e as $en) { //计算熵
            $t = $en / $e_all;
            if ($t == 0) continue; //log2(0) patch
            $ret+= $t * log($t, 2);

            if ($this->dbg_c == 3)           $this->log[] = var_export($t * log($t, 2), true);
        }

        return -$ret;
    }

    /**
     * 根据规则取出实例集子集
     * @param $attr
     * @param $value
     * @return array
     */
    private function get_subset($attr, $value) {
        $ret = array();
        foreach($this->Instance as $k => $i) {
            if (isset($i[$attr]) && $i[$attr] == $value) {
                $ret[$k] = $i;
            }
        }
        return $ret;
    }

    /**
     * 测试实例集子集是否具有相同的类别
     * @param $subset
     * @return bool|string
     */
    private function has_same_class($subset) {
        $the_class = '';
        foreach($subset as $s) {
            if ($the_class != '' && $the_class != $s[$this->class_name]) {
                return false;
            } else if ($the_class == '') {
                $the_class = $s[$this->class_name];
            }
        }
        return $the_class;
    }

    /**
     * 计算找出当前状态下平均信息量最少的属性名
     * @return mixed
     */
    private function get_minI_attr() {
        $i_avg = array();
        foreach ($this->AttrList as $attr) {
            $i_avg[$attr] = 0; //一个属性的平均信息量
            foreach($this->Values[$attr] as $v) { //计算一个属性的一个值的熵
                $subset = $this->get_subset($attr, $v);
                $this->dbg_c++;
                $subset_I = $this->calculate_entropy($subset);
                $this->log[] = var_export($attr, true);
                $this->log[] = var_export($v, true);
                $this->log[] = var_export($subset_I, true);
                $i_avg[$attr] += count($subset) / count($this->Instance) * $subset_I;
            }
        }

        asort($i_avg);
        return key($i_avg);
    }

    /**
     * 根据指定属性划分生成子一级决策树
     * @param $attr
     */
    private function make_tree($attr) {
        foreach($this->Values[$attr] as $v) {
            $subset = $this->get_subset($attr, $v);

            if($the_class = $this->has_same_class($subset)) {
                $node =array(
                    'name' => $the_class,
                    'arc' => $v
                );
                $this->tree->insert_node($node);

                $this->Instance = array_diff_key($this->Instance, $subset); //更新实例集留下未分类的
            } else {
                $node =array(
                    'name' => 'start',
                    'arc' => $v
                );

                $unresolved = $this->tree->insert_node($node);
            }
        }

        if (isset($unresolved)) {
            $this->tree->goto_index($unresolved);
        }

    }
}
