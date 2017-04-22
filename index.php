<?php
/**
 * Created by PhpStorm.
 * Date: 07.04.2017
 * Time: 18:29
 */

define('WWW',__DIR__);



$uri = $_SERVER['REQUEST_URI'];
if ($uri=='/'){
    require_once "/views/find.php";
}
if ($uri=='/add' or $uri=='/add/') {
    require_once "/views/add.php";
}
//if ($uri!=='/add' and $uri!=='/add/' and $uri!=='/') {
//    http_response_code(404);
//    require_once "/views/error.php";
//}
