<?php
namespace Common\Controller;
use Think\Controller;
class BaseController extends Controller {
    
    public function _initialize() {     //全局变量
        $forumList = D("Forum")->getAll();
        $this->assign("forumList",$forumList);
        
        $articleList = D("Article")->getPage();
        $this->assign('articleList',$articleList);// 赋值分页输出
        
        $showPage = D("Article")->showPage();
        $this->assign("showPage",$showPage);
    }
    
    
    public function _empty() {
        var_dump("not found");
    }
    
}