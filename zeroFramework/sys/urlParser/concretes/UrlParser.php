<?php
require_once "./sys/urlParser/abstracts/UrlParserManager.php";

class UrlParser implements UrlParserManager {

    public $urlParserData = [];

    public function urlParse()
    {
        $phpRequestSelfUrl = $_SERVER["PHP_SELF"];
        $phpRequestUri = $_SERVER["REQUEST_URI"];

        $phpRequestUrl = str_replace(str_replace("/index.php","",$phpRequestSelfUrl),"",$phpRequestUri);
        $phpRequestPaths = array_filter(explode('/',$phpRequestUrl));

        $urlParserData = [
            "pathsString" => $phpRequestUrl,
            "paths" => $phpRequestPaths,
            "requestMethod" => $_SERVER["REQUEST_METHOD"]
        ];

      return $urlParserData;
    }

}