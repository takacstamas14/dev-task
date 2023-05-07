<?php
namespace app\models;
use app\utils\Database;

class Advertisements extends BaseModel {
    protected $title;
    protected $userid;
    protected $tablename = 'advertisements';
    public function __construct() {}
    public function getTitle() { return $this->title; }
    public function setTitle($title) { $this->title = $title; }
    public function getUserid() { return $this->userid; }
    public function setUserid($userid) { $this->userid = $userid; }





}
