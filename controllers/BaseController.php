<?php

namespace app\controllers;
abstract class BaseController {
    // Nézetek betöltése a views mappából és paraméterek átadása az adott nézetnek.
    public function renderView($file,$param = []) {
        include basedir.'/views/' . $file .'.php';
    }
}