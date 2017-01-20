<?php

namespace Blog\Model;
use Common\Model\BaseModel;
class ForumModel extends BaseModel {
    protected $tablePrefix = "blog_";   //表前缀
    protected $tableName = 'forum';     //表名
    
    public function getAll() {
        return $this->fetchAll();
    }
    
    public function getOne($value, $key = "id") {
        return $this->fetchOne($value, $key);
    }
}

