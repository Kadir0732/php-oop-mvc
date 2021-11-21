<?php
require_once "./sys/urlParser/concretes/UrlParser.php";
require_once "./sys/router/abstracts/RouterManager.php";

class Router implements RouterManager
{
    static $notFindPage = true;
    static function router($routerUrl, $routerControler, $routerRequestMethod)
    {
        $urlParser = new UrlParser();
        $parseUrl = $urlParser->urlParse();
        $routerPaths = array_filter(explode("/", $routerUrl));
        $routerUrlString = "";
        $pathData = [];
        if (count($routerPaths) == count($parseUrl["paths"]) && $routerRequestMethod == $parseUrl["requestMethod"]) {
            for ($i = 1; $i <= count($routerPaths); $i++) {
                if (preg_match("/\{(.*?)\}/", $routerPaths[$i])) {
                    $routerUrlString .= "/" . $parseUrl["paths"][$i];
                    $pathData[str_replace("}", "", str_replace("{", "", $routerPaths[$i]))] = $parseUrl["paths"][$i];
                } else {
                    $routerUrlString .= "/" . $routerPaths[$i];
                }
            }
            if ($routerUrlString == $urlParser->urlParse()["pathsString"]) {
                $parseControler = array_filter(explode(":", $routerControler));
                $controlerFile = "./app/controllers/" . $parseControler[0] . ".php";
                if (file_exists($controlerFile)) {
                    require_once $controlerFile;

                    if (class_exists($parseControler[0])) {
                        $controller = new $parseControler[0]($pathData);
                        if (method_exists($parseControler[0],$parseControler[1])) {
                            $controllerFunc = $parseControler[1];
                            $controller->$controllerFunc();
                        } else {
                            echo "Not Find Function Name! <br/> Wanted function Name: $parseControler[1] <br />Class Name: $parseControler[0]";
                        }
                    } else {
                        echo "Not Find Class Name! <br/> Wanted Class Name: $parseControler[0]";
                    }


                    self::$notFindPage = false;
                } else {
                    echo "Not Find Controller File! <br/> File: $controlerFile";
                }
            }
        }
    }
    static function notFindPage($view)
    {
        if (self::$notFindPage) {
            $viewFile = "./app/views/$view.php";
            if (file_exists($viewFile)) {
                require_once $viewFile;
            } else {
                echo "Not Find 404 View File! <br/> File:$viewFile";
            }
        }
    }
}
