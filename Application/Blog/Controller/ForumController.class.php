<?php
namespace Blog\Controller;
use Common\Controller\BaseController;
class ForumController extends BaseController {
    public function index(){
        $id = I("get.id");
        $model = D("Article")->getPageByForumId($id);
        var_dump($model);
    }
}