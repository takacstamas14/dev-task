<?php
namespace app\controllers;

use app\controllers\BaseController;
use app\models\Advertisements;
use app\models\Users;
use app\utils\Database;

class AdvertisementsController extends BaseController {
    public function index() {
        $data = Database::query("SELECT advertisements.id, title, name FROM advertisements INNER JOIN users ON advertisements.userid = users.id");
        $this->renderView('advertisement_list_all',["data" => $data]);
    }
    public function getAdvertisementsByUserId($request) {
        $userData = (new Users)->getBy(["id",$request["id"]]);
        $data = (new Advertisements)->getBy(["userid",$request["id"]]);
        if($userData) {
            $this->renderView('advertisement_list', ["data" => $data, "userData" => $userData]);
        } else {
            $this->renderView('404');
        }
    }
}