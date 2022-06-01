<?php

namespace Zero\libraries;

class Router
{
    static $notFindPage = true;
    public function route($routerUrl, $routerController, $routerRequestMethod)
    {
        $urlParser = new UrlParser;
        $parseUrl = $urlParser->urlParse();
        $routerPaths = array_filter(explode("/", $routerUrl));
        $routerUrlString = "";
        $pathData = [];
        if (count($routerPaths) == count($parseUrl["paths"]) && $routerRequestMethod == $parseUrl["requestMethod"]) {
            if (1 <= count($routerPaths)) {
                for ($i = 1; $i <= count($routerPaths); $i++) {

                    if (preg_match("/\{(.*?)\}/", $routerPaths[$i])) {
                        $routerUrlString .= "/" . $parseUrl["paths"][$i];
                        $pathData[str_replace("}", "", str_replace("{", "", $routerPaths[$i]))] = $parseUrl["paths"][$i];
                    } else {
                        $routerUrlString .= "/" . $routerPaths[$i];
                    }
                }
            } else {
                $routerUrlString .= "/";
            }
            if ($routerUrlString == $urlParser->urlParse()["pathsString"]) {

                if(is_callable($routerController)){
                    call_user_func_array($routerController,$pathData);
                    die;
                }

                $parseController = array_filter(explode(":", $routerController));
                $parseControllerUrl = array_filter(explode("/", $parseController[0]));
                $controllerClassName = end($parseControllerUrl);
                $controllerFile = "./app/controllers/" . $parseController[0] . ".php";

                if (file_exists($controllerFile)) {
                    require_once $controllerFile;

                    if (class_exists($controllerClassName)) {
                        $controller = new $controllerClassName();
                        if (method_exists($controllerClassName, $parseController[1])) {
                            $request = new Request($pathData);
                            $controllerFunc = $parseController[1];
                            $controller->$controllerFunc($request);
                        } else {
                            echo "Not Find Function Name! <br/> Wanted function Name: $parseController[1] <br />Class Name: $parseController[0]";
                        }
                    } else {
                        echo "Not Find Class Name! <br/> Wanted Class Name: $parseController[0]";
                    }


                    self::$notFindPage = false;
                } else {
                    echo "Not Find Controller File! <br/> File: $controllerFile";
                }
            }
        }
    }
    static function Get($routerUrl, $routerController)
    {
        $router = new Router();
        $router->route($routerUrl, $routerController, "GET");
    }
    static function Post($routerUrl, $routerController)
    {
        $router = new Router();
        $router->route($routerUrl, $routerController, "POST");
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
