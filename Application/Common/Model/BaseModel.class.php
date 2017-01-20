<?php

namespace Common\Model;
use Think\Model;
use Components\MRedis;
class BaseModel extends Model {
    
    public $cache;
    
    protected $tablePrefix = "";   //表前缀
    protected $tableName = '';     //表名
    
    
    public function _initialize() {
        $this->cache = new Redis();
    }
    
    public function fetchOne($value, $key = "id") {
        $one = $this->cache->one($value);
        if(empty($one)) {
            $one = M($this->tableName,$this->tablePrefix)->where(array($key=>$value))->find();
            $this->cache->set($one);
        }
        return $one;
    }
    
    public function fetchAll() {
        return M($this->tableName,$this->tablePrefix)->select();
    }
    
    public function fetchList() {
        
    }
    
    public function fetchPage($condition = array()) {
        return M($this->tableName,$this->tablePrefix)->where($condition)->page(limit())->select();
    }
    
    public function showPage() {
        $size = C("DEFAULT_PAGE_SIZE");
        $count = M($this->tableName,$this->tablePrefix)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, $size); // 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('first','首页');
        $Page->setConfig('last','尾页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $Page->show(); // 分页显示输出
        return $show;
    }
}

class Redis {
    public $redis;
    public $redisPrefix = "think_";
    public $redisQueue = 2;
    public $isCache = false;
    
    public function __construct() {
        $this->redis = new MRedis();
    }
    
    public function one($id) {
        if(empty($id)) return false;
        $cacheid = $this->redisPrefix . $id;
        return $this->redis->get($cacheid,$this->redisQueue);
    }
    
    public function set($one) {
        $cacheid = $this->redisPrefix . $one['id'];
        $this->redis->set($cacheid,$one,$this->redisQueue);
    }
    
    public function del($id) {
        $cacheid = $this->redisPrefix . $id;
        $this->redis->del($cacheid,$this->redisQueue);
    }
    
    public function update($id,$one) {
        $item = $this->one($id);
        if(empty($item)) return false;
        foreach(array_keys($one) as $v) {
            $item[$v] = $one[$v];
        }
        $this->set($one);
    }
    
}
