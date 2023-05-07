<?php
namespace app\models;
use app\utils\Database;

abstract class BaseModel {
    private $id;
    protected $tablename;
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    // Gyermek osztályokból meghívható függvény, amellyel az adott osztályhoz tartozó táblából az összes rekordot le tudjuk kérni.
    public function getAll() {
        $class = get_class($this);
        $data = Database::query("SELECT * FROM " . $this->tablename);
        $collection = array();
        for ($i = 0; $i < count($data); $i++){
            $obj = new $class();
            foreach ($data[$i] AS $key => $value)
            {
                $obj->$key = $value;
            }
            $collection[] = $obj;
        }
        return $collection;
    }
    // Gyermek osztályokból meghívható függvény, amellyel az adott osztályhoz tartozó táblából az összes rekordot le tudjuk kérni amelyre érvényesül a paraméterekből átadott vizsgálat
    public function getBy($params) {
        $class = get_class($this);
        $data = Database::query("SELECT * FROM " . $this->tablename . " WHERE " . $params[0] . " = " . $params[1]);
        $collection = array();
        for ($i = 0; $i < count($data); $i++){
            $obj = new $class();
            foreach ($data[$i] AS $key => $value)
            {
                $obj->$key = $value;
            }
            $collection[] = $obj;
        }
        return $collection;
    }
}