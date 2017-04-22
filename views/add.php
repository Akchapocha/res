
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Создание нового сотрудника</title>

    <link href="../css/add.css" rel="stylesheet">
    <link href="../css/tcal.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>



<body>

<h2>Создание сотрудника</h2>


<form id="newworker" enctype="multipart/form-data" action="" method="POST" " >
    <div id="add">
        <div id="key">
            <p>Фамилия: </p>
            <p>Имя: </p>
            <p>Отчество: </p>
        </div>
        <div id="fio">
            <p><input id="plhol" type="text" name="family" required > *</p>
            <p><input id="plhol" type="text" name="name" required > *</p>
            <p><input id="plhol" type="text" name="lastname" ></p>
        </div>
        <div id="date">
            <p>Дата рождения: </p>
        </div>
        <div id="pldate">
            <p><input id="plholdate" type="text" style="cursor: pointer" name="date" class="tcal" required  > *</p>
        </div>
        <div id="polfoto">
            <p>Пол: </p>
            <p>Фото: </p>
        </div>
        <div id="fio">
            <p><select type="text" style="cursor: pointer" name="pol" required >
                    <option disabled>Выберите пол</option>
                    <option value="Женщина">Женщина</option>
                    <option value="Мужчина">Мужчина</option>
                </select> *</p>
            <p><input type="file" accept="image/jpeg,image/png" style="cursor: pointer" name="photo" ></p>
        </div>
        <button id="btsave">Отправить</button>
        <p>*обязятельные поля</p>
    </div>
</form>

<div id="mes" ></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../libs/calendar/tcal.js"></script>


</body>
</html>

<?php
if ($_POST) {
    define('WWW', dirname(__DIR__));
    require_once WWW . "/app/add.php";
}
?>