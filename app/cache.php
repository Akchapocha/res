<?php
/**
 * Created by PhpStorm.
 * Date: 11.04.2017
 * Time: 19:10
 */
define('WWW',dirname(__DIR__));

function setCache($key, $data, $seconds = 3600)
{
    $content['data'] = $data;
    $content['end_time'] = time()+$seconds;
    if (file_put_contents(WWW.'/cache/'.md5($key).'.txt',serialize($content))){
        return true;
    }
    return false;
}

function getCache($key)
{
    $file = WWW.'/cache/'.md5($key).'.txt';
    if (file_exists($file)){
        $content = unserialize(file_get_contents($file));
        if (time() <= $content['end_time']){
            return $content['data'];
        }
        unlink($file);
    }
    return false;
}

function deleteCache($key)
{
    $file = WWW.'/cache/'.md5($key).'.txt';
    if (file_exists($file)){
        unlink($file);
    }
}