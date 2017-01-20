<?php
namespace Blog\Controller;
use Common\Controller\BaseController;
class IndexController extends BaseController {
    public function index(){
        $this->display();
    }
}