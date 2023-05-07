<?php
namespace app\controllers;

use app\controllers\BaseController;
use app\models\Users;
use app\utils\Database;

class UserController extends BaseController {
    public function index() {
        $data = (new Users)->getAll();
        $this->renderView('users_list', ["data" => $data]);
    }

}