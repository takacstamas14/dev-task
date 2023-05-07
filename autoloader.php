<?php

/*
 * Minden osztály betöltése
 */
function load_classes($classname){
    $path = explode("\\",$classname);
    $path_to_file = basedir.'/'.$path[1].'/' . $path[2] . '.php';
    if (file_exists($path_to_file)) {
        require $path_to_file;
    }
}

spl_autoload_register('load_classes');

