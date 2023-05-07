<?php

define('basedir',__DIR__); // A projekt fő mappája
define('baseurl','/rabit'); // Az alap URL címe a rendszernek pl. localhost/rabit....
include basedir.'/autoloader.php';
use app\utils\Router;

// A rendszer útvonalainak definiálása

Router::addRoute("/","app\\controllers\\PageController@index");
Router::addRoute("/users","app\\controllers\\UserController@index");
Router::addRoute("/user/{id}","app\\controllers\\AdvertisementsController@getAdvertisementsByUserId");
Router::addRoute("/advertisements","app\\controllers\\AdvertisementsController@index");
Router::addRoute("/404","app\\controllers\\PageController@notfound");

// Ha a megadott URL címen talál ilyen oldalt a rendszer akkor betölti a megadott kontrollerhez tartozó függvényt, ami kirendereli a nézetet.
Router::initRouting();