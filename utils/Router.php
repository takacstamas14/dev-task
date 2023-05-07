<?php
namespace app\utils;
abstract class Router {
    private static $_url = [];
    // URL-ek tömb feltöltésére szolgáló függvény
    public static function addRoute($route, $dest) {
        self::$_url[$route] = $dest;
    }
    // index.phpból meghívott függvény amely az adott link szerint indítja az oldalak betöltését
    public static function initRouting()
    {
        $url = isset($_GET["url"]) ? "/".$_GET["url"] : "";
        if($url == "")
        {
            $url = "/";
        }
        $routeRegexes = [];
        // Regex ellenőrzéssel végignézem az összes urlt amely beregisztrálásra került, vizsgálom a {} jelek között lévő változókat
        foreach (self::$_url as $route => $dest) {
            $parts = [];
            $partsRegex = '`(.+?){(.+?)}`';
            preg_match($partsRegex, $route, $parts);
            // Ha van {} jelek közé írt változó akkor a $routeRegexes tömböt feltöltöm ezekkel az adatokkal
            if(count($parts) > 0) {
                $routeRegexes[] = [
                    'path' => $parts[1],
                    'varName' => $parts[2],
                    'routeRegex' => "`($parts[1])(.+)`",
                    'savedUrl' => $route
                ];
            } else {
                $routeRegexes[] = [
                    'path' => $route,
                    'varName' => "",
                    'routeRegex' => "",
                    'savedUrl' => $route,
                ];
            }
        }
        $urlMatch = null;
        // Az előbb összeállított tömbbön végigmegyek, és kiegészítem az értékkel amit az URLben adtam át.
        foreach ($routeRegexes as $routeRegex) {
            if($routeRegex['routeRegex'] != "") {
                if (preg_match($routeRegex['routeRegex'], $url, $urlMatch)) {
                    $routeRegex['varValue'] = $urlMatch['2'];
                    $urlMatch = $routeRegex;
                    break;
                }
            } else {
                    if($routeRegex["path"] == $url) {
                        $routeRegex['varValue'] = "";
                        $urlMatch = $routeRegex;
                        break;
                    }
            }
        }
        // Ha van találat akkor a callController függvény segítségével meghívom az adott controller adott osztályát, ami kezeli a megjelenítendő nézetet.
        // Ha nincs találat akkor a 404-es oldalra irányít a rendszer amelyet a PageController notfound függvénye kezel.
        if (!empty($urlMatch)) {
            $variableName = $urlMatch['varName'];
            $variableValue = $urlMatch['varValue'];
            if($variableName != "")
            {
                $request = [
                    $variableName => $variableValue
                ];
                self::callController(self::$_url[$urlMatch['savedUrl']],$request);
            } else {
                self::callController(self::$_url[$urlMatch['savedUrl']]);
            }
        } else {
            self::callController(self::$_url["/404"]);
        }
    }
    // A függvény a regisztrált URL címek közül a "dest" paraméter alapján szétválogatja, hogy melyik controller melyik függvénye fogja kezelni a nézetet.
    // Ha van értéke a $requestParamnak tehát az URL címből adunk át a függvénynek értéket, akkor azt is átadjuk az adott függvény paraméterébe.
    private static function callController($dest, $requestParam = false)
    {
        $goto = explode("@", $dest);
        $controller = $goto[0];
        $action = $goto[1];
        $class = $controller;
        $obj = new $class;
        if($requestParam)
        {
            return $obj->$action($requestParam);
        }
        return $obj->$action();
    }
}