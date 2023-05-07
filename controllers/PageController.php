<?php
namespace app\controllers;

use app\controllers\BaseController;
class PageController extends BaseController {
    public function index() {

        $this->renderView('index');
    }
    public function notfound() {
        $this->renderView('404');
    }
}