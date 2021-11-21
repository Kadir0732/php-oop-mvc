<?php
interface RouterManager{
    static function router($routerUrl,$routerControler,$routerRequestMethod);
    static function notFindPage($view);
}