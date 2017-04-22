<?php
/**
 * Created by PhpStorm.
 * Date: 10.04.2017
 * Time: 18:10
 */

define('WWW',dirname(__DIR__));
require_once WWW."/config/db.php";
require_once WWW."/app/functions.php";

/**Прием данных из формы поиска*/
$err = 0;
$fio = $_POST['fio'];
$pol1 = $_POST['pol1'];
$pol2 = $_POST['pol2'];
$voz1 = trim($_POST['voz1']);
$voz2 = trim($_POST['voz2']);
$bd=$list;
/**-------------------------------------------------*/

/**Обработка ошибок ФИО и задание условий поиска*/
preg_match("/[0-9A-Za-z]+/",$fio,$dsa);
if (!empty($dsa)){
    echo 'В ФИО доступны только русские буквы.<br>/*ФИО пишутся только с заглавной буквы и через пробел.*/';
    $fio = '';
    $name = false;
} else {
    $fio = explode(' ',$fio);
    $name = true;
}
if (count($fio) == 1 and $fio[0] == null){
    $name = false;
} else $name = true;
if (count($fio)>3){
    echo 'В ФИО доступны не более трех параметров.<br>/*ФИО пишутся только с заглавной буквы и через пробел.*/';
    echo '<br>';
    $name = false;
}
/**-------------------------------------------------*/

/**Обработка ПОЛА и задание условий поиска*/
if ($pol1 == 'Муж'){
    $pol1 = 'муж';
}
if ($pol2 == 'Жен'){
    $pol2 = 'жен';
}
if (empty($pol1) and empty($pol2)){
    $pol = false;
}
if (!empty($pol1) || !empty($pol2)){
    $pol = true;
}
/**-------------------------------------------------*/

/**Обработка ошибок ВОЗРАСТА и задание условий поиска*/
$err=false;
if ($voz1 !== ''){
    if (!is_numeric($voz1)){
        $err = true;
    }elseif ($voz1<16 || $voz1>90){
        $err = true;
    }
}
if ($voz2 !== ''){
    if (!is_numeric($voz2)){
        $err = true;
    }elseif ($voz2>90 || $voz2<16){
        $err = true;
    }
}
if ($err == true){
    echo 'Введен не корректный диапозон по возрасту.';
    echo '<br>';
    echo 'Допускаются только цифры в диапазоне от 16 до 90 лет.';
    echo '<br>';
}else {
    if ((!empty($voz1) and !empty($voz2)) and $voz1 > $voz2){
        $var = $voz1;
        $voz1 = $voz2;
        $voz2 = $var;
    }
}
if (empty($voz1) and empty($voz2)){
    $voz = false;
}
if (!empty($voz1) || !empty($voz2)){
    $voz = true;
}
/**-------------------------------------------------*/

/**Параметры поиска*/
$find[]=$name;
$find[]=$pol;
$find[]=$voz;
/**-------------------------------------------------*/

/**Условия поиска*/
switch ($find) {
    case (($name == false) and ($pol == false) and ($voz == false)):
        echo 'Введите данные для поиска';
        echo '<br>';
        break;
    case (($name == true) and ($pol == true) and ($voz == true)) :
        $rows = getRowsFio($bd,$fio);
        $spisok = getSpisokPol($pol1, $pol2, $rows);
        $rows = getRows($spisok, $bd);
        $spisok = getSpisokVoz($voz1, $voz2, $err, $rows);
        break;
    case (($name == true) and ($pol == false) and ($voz == false)) :
        $spisok = getSpisokFio($bd, $fio);
        break;
    case (($name == false) and ($pol == true) and ($voz == false)) :
        $spisok = getSpisokPol($pol1, $pol2, $bd);
        break;
    case (($name == false) and ($pol == false) and ($voz == true)) :
        $spisok = getSpisokVoz($voz1, $voz2, $err, $bd);
        break;
    case (($name == true) and ($pol == true) and ($voz == false)) :
        $rows = getRowsFio($bd,$fio);
        $spisok = getSpisokPol($pol1, $pol2, $rows);
        break;
    case (($name == true) and ($pol == false) and ($voz == true)) :
        $rows = getRowsFio($bd,$fio);
        $spisok = getSpisokVoz($voz1, $voz2, $err, $rows);
        break;
    case (($name == false) and ($pol == true) and ($voz == true)):
        $rows = getRowsPol($pol1, $pol2, $bd);
        $spisok = getSpisokVoz($voz1, $voz2, $err, $rows);
        break;
}
/**-------------------------------------------------*/

/**Вывод таблицы результатов*/
//require_once WWW."/views/restable.php";
require_once WWW."/views/pagination.php";
/**-------------------------------------------------*/
