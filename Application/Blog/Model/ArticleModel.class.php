<?php

namespace Blog\Model;
use Common\Model\BaseModel;
class ArticleModel extends BaseModel {
    
    protected $tablePrefix = "blog_";
    protected $tableName = 'article';
    
    
    function fetchAll() {
        return $this->fetchAll();
    }
    
    public function getPage() {
        return $this->fetchPage();
    }
    
    public function getPageByForumId($id) {
        return $this->fetchPage(array("pid"=>$id));
    }
    
    public function getOne($value, $key = "id") {
        return $this->fetchOne($value,$key);
    }

}
