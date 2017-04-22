<?php
/**
 * Created by PhpStorm.
 * Date: 11.04.2017
 * Time: 10:41
 */
define('WWW',dirname(__DIR__));
require_once WWW."/app/cache.php";

/**
 * Возвращает данные из базы
 * @return array
 */
function getList()
{
    $list = R::getAll('SELECT * FROM sotr');
    return $list;
}

/**
 * Запрос к кеш
 */
$list = getCache('list');
if (!$list){
    $list =getList();
    setCache('list',$list,3600*24);
}

/**
 * Поиск всех совпадений в $bd по ФИО
 * @param $bd
 * @param $fio
 * @return array
 */
function getFio($bd,$fio)
{
    foreach ($bd as $item => $row){
        foreach ($fio as $key => $value) {
            if ($row['family'] == $value) {
                $spisok[]=$row['id'];
            }
        }
        foreach ($fio as $key => $value) {
            if ($row['name'] == $value) {
                $spisok[]=$row['id'];
            }
        }
        foreach ($fio as $key => $value) {
            if ($row['midle_name'] == $value) {
                $spisok[]=$row['id'];
            }
        }
    }
    return $spisok;
}

/**
 * Поиск всех совпадений в $bd по ВОЗРАСТУ
 * @param $bd
 * @param $voz1
 * @param $voz2
 * @return array
 */
function getVoz($bd, $voz1, $voz2)
{
    foreach ($bd as $item => $row){
        if ((date('Y-m-d')-$row['birthday']>=$voz1) and (date('Y-m-d')-$row['birthday']<=$voz2)){
            $spisok[] = $row['id'];
        }
    }
    return $spisok;
}

/**
 * Построение списка ФИО id
 * @param $bd
 * @param $fio
 * @return array
 */
function getSpisokFio($bd, $fio){
    if (count($fio) == 1){
        $spisok = getFio($bd,$fio);
    }
    if (count($fio) == 2){
        $spisok = getFio($bd,$fio);
        foreach ($spisok as $item => $value){
            if ($spisok[$item] == $spisok[$item+1]){
                $spisok2[]=$spisok[$item];
            }
        }
        $spisok=$spisok2;
    }
    if (count($fio) == 3){
        $spisok = getFio($bd,$fio);
        foreach ($spisok as $item => $value){
            if (($spisok[$item] == $spisok[$item+1]) and ($spisok[$item] == $spisok[$item+2])){
                $spisok2[]=$spisok[$item];
            }
        }
        $spisok=$spisok2;
    }

    return $spisok;
}

/**
 * Поиск всех совпадений в $bd по ПОЛУ и построение списка id
 * @param $pol1
 * @param $pol2
 * @param $bd
 * @return array
 */
function getSpisokPol($pol1, $pol2, $bd)
{

    if (!empty($pol1) and !empty($pol2)){
        foreach ($bd as $item => $row) {
            if ($row['gender'] == $pol1 || $row['gender'] == $pol2) {
                $spisok[] = $row['id'];
            }
        }
    }
    if (!empty($pol1) and empty($pol2)){
        foreach ($bd as $item => $row) {
            if ($row['gender'] == $pol1) {
                $spisok[] = $row['id'];
            }
        }
    }
    if (empty($pol1) and !empty($pol2)){

        foreach ($bd as $item => $row) {
            if ($row['gender'] == $pol2) {
                $spisok[] = $row['id'];
            }
        }
    }
    return $spisok;
}

/**
 * Поиск всех совпадений в $bd по ВОЗРАСТУ и построение списка id
 * @param $voz1
 * @param $voz2
 * @param $err
 * @param $bd
 * @return array
 */
function getSpisokVoz ($voz1, $voz2, $err, $bd)
{
    if (!empty($voz1) and !empty($voz2) and $err == false){
        if ($voz1 > $voz2){
            $var = $voz1;
            $voz1 = $voz2;
            $voz2 = $var;
        }
        $spisok = getVoz($bd, $voz1, $voz2);
    }
    if (empty($voz1) and !empty($voz2) and $err == false){
        $voz1 = 16;
        $spisok = getVoz($bd, $voz1, $voz2);
    }
    if (!empty($voz1) and empty($voz2) and $err == false){
        $voz2 = 90;
        $spisok = getVoz($bd, $voz1, $voz2);
    }
    return $spisok;
}

/**
 * Преобразование списка в строки
 * @param $spisok
 * @param $bd
 * @return array
 */
function getRows ($spisok, $bd)
{
    foreach ($spisok as $item => $value) {
        foreach ($bd as $key => $row) {
            if (($value == $row['id'])) {
                $rows[]=$row;
            }
        }
    }
    return $rows;
}

/**
 * Преобразование списка id ФИО в строки
 * @param $bd
 * @param $fio
 * @return array
 */
function getRowsFio($bd, $fio)
{
    $spisok = getSpisokFio($bd, $fio);
    $rows = getRows($spisok, $bd);
    return $rows;
}

/**
 * Преобразование списка id ПОЛА в строки
 * @param $pol1
 * @param $pol2
 * @param $bd
 * @return array
 */
function getRowsPol($pol1, $pol2, $bd)
{
    $spisok = getSpisokPol($pol1, $pol2, $bd);
    $rows = getRows($spisok,$bd);
    return $rows;
}

