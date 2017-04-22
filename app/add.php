<?php
/**
 * Created by PhpStorm.
 * Date: 09.04.2017
 * Time: 19:32
 */


define('WWW',dirname(__DIR__));
require_once WWW."/config/db.php";
require_once WWW."/app/cache.php";
require_once WWW."/app/functions.php";

$bd=$list;
foreach ($bd as $item => $row){

}
$id = ($row['id']+1);
$id = preg_replace("/.......................$/", "", preg_replace("/^....../", "", md5($id)));

if (!empty($_FILES['photo']['tmp_name'])){
    if ($_FILES['photo']['size']<=204800){
        $img = '/img/'.$_FILES['photo']['name'];
        if (file_exists(WWW.$img)){
             $img = '/img/'.preg_replace("/\..+/", "", $_FILES['photo']['name']).''.$id.'.'.preg_replace("/.+\./", "", $_FILES['photo']['name']);
        }
        move_uploaded_file($_FILES['photo']['tmp_name'],WWW.$img);
    } else exit('Файл не может превышать 200Кб');
}


$family = trim($_POST['family']);

preg_match("/[0-9A-Za-z]+/",$family,$dsa);
if (!empty($dsa)){
    exit ('<p style="color: red">В Фамилии доступны только русские буквы.<br>/*Фамилия пишется только с заглавной буквы*/');
}

$name = trim($_POST['name']);

preg_match("/[0-9A-Za-z]+/",$name,$dsa);
if (!empty($dsa)){
    exit ('<p style="color: red">В Имени доступны только русские буквы.<br>/*Имя пишется только с заглавной буквы*/');
}

$midle_name = trim($_POST['lastname']);

preg_match("/[0-9A-Za-z]+/",$midle_name,$dsa);
if (!empty($dsa)){
    exit ('<p style="color: red">В Отчестве доступны только русские буквы.<br>/*Отчество пишется только с заглавной буквы*/');
}


$gender = trim($_POST['pol']);

if ($gender == 'Женщина'){
    $gender = 'жен';
}
if ($gender == 'Мужчина'){
    $gender = 'муж';
}

$birthday = trim($_POST['date']);




$year = preg_replace('/^..\/..\//','',$birthday);
$day = preg_replace('/\/....$/','',preg_replace('/^..\//','',$birthday));
$month = preg_replace('/\/..\/....$/','',$birthday);
$birthday = date($year.'-'.$month.'-'.$day);

/**
 * Загрузка в базу
 */

$worker = R::dispense('sotr');
$worker->img = $img;
$worker->family = $family;
$worker->name = $name;
$worker->midle_name = $midle_name;
$worker->gender = $gender;
$worker->birthday =$birthday;
R::store($worker);
deleteCache('list');
$_POST ='';






