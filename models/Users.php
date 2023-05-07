<?php
namespace app\models;
use app\utils\Database;

class Users extends BaseModel {
    protected $name;
    protected $tablename = 'users';
    public function __construct() {}
    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }





}
