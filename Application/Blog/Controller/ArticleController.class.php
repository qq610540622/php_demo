<?php
namespace Blog\Controller;
use Common\Controller\BaseController;
class ArticleController extends BaseController {
    public function index(){
        $ar = D("Article");
        $b = $ar->getAll();
        $this->display();
    }
    
    public function detail() {
        $id = I("param.id");
        $article = D("Article")->fetchOne($id);
        $this->assign("article",$article);
        $this->display();
    }
}