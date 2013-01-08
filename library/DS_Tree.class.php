<?php
/**
 * Created by JetBrains PhpStorm.
 * User: horsley
 * Date: 12-12-29
 * Time: 下午12:06
 * To change this template use File | Settings | File Templates.
 */
if (!defined('NODE_PARENT')) define('NODE_PARENT', 'parent');
if (!defined('NODE_CHILDREN')) define('NODE_CHILDREN', 'children');
if (!defined('NODE_ARC')) define('NODE_ARC', 'arc');

class DS_Tree
{
    private $nodes = array(); //节点数组
    private $current_node_ptr; //当前节点指针（索引值）

    /**
     * 树是否为空
     * @return bool
     */
    public function is_empty() {
        return empty($this->nodes);
    }

    /**
     * 返回节点数量
     * @return int
     */
    public function get_size() {
        return count($this->nodes);
    }

    /**
     * 在当前节点下插入子节点,返回插入的节点ID
     * @param $node
     * @return int
     */
    public function insert_node($node) {
        $node_id = array_push($this->nodes, $node) - 1;
        $new_node = &$this->nodes[$node_id];

        if ($node_id != 0) { //非根节点插入
            $pnode = &$this->nodes[$this->current_node_ptr];
            if (empty($pnode[NODE_CHILDREN])) $pnode[NODE_CHILDREN] = array();
            array_push($pnode[NODE_CHILDREN], $node_id);
            $new_node[NODE_PARENT] = $this->current_node_ptr;
        } else {
            $new_node[NODE_PARENT] = NULL;
        }
        return $node_id;
    }

    /**
     * 更新当前节点的属性值
     * @param $key
     * @param $value
     */
    public function update_node_attr($key, $value) {
        $cur_node = &$this->nodes[$this->current_node_ptr];
        $cur_node[$key] = $value;
    }

    /**
     * 取得当前节点的属性值
     * @param $key
     * @return mixed
     */
    public function get_node_attr($key) {
        return $this->nodes[$key];
    }

    /**
     * 当前节点设置为树的根节点
     */
    public function goto_root() {
        if ($this->get_size() > 0) {
            reset($this->nodes);
            $this->current_node_ptr = key($this->nodes);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 跳到指定索引的节点
     * @param $index
     * @return bool
     */
    public function goto_index($index) {
        if(isset($this->nodes[$index])) {
            $this->current_node_ptr = $index;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 取回当前节点的索引
     * @return mixed
     */
    public function get_index() {
        return $this->current_node_ptr;
    }

    /**
     * 取子节点数
     * @return int
     */
    public function count_children() {
        return count($this->nodes[$this->current_node_ptr][NODE_CHILDREN]);
    }

    /**
     * 取叶子节点
     * @return array
     */
    public function get_leafs() {
        $ret = array();

        foreach($this->nodes as $k => $n) {
            if (empty($n[NODE_CHILDREN]))
                $ret[$k] = $n;
        }
        return $ret;
    }

    /**
     * 输出决策树
     * @return string
     */
    public function draw_tree() { //这里实在没有什么好办法画出一个数，就以节点数组输出了
        return var_export($this->nodes, true);
    }

    /**
     * 返回当前节点下面的一层子节点
     * @return array
     */
    public function get_children() {
        $ret = array();
        $children_id = $this->nodes[$this->current_node_ptr][NODE_CHILDREN];

        foreach($children_id as $k) {
            $ret[$k] = $this->nodes[$k];
        }
        return $ret;
    }
}
