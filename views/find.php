<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Реестр сотрудников</title>

    <!-- Bootstrap -->
<!--    <link href="../css/find.css" rel="stylesheet">-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>



<body>

<h2>Реестр сотрудников</h2>
<a id="add" href="/add">+Добавить сотрудника</a>


<form id="find">
    <div id="poisk">
        <div id="placeholder">
            <input id="plfio" name="fio" type="text" placeholder="ФИО">
        </div>
        <div id="place2">
            <div id="pol">
                <p>Пол:</p>
            </div>
            <div id="voz">
                <p>Возраст:</p>
            </div>
        </div>
        <div id="place3">
            <div id="flag">
                <p><input type="checkbox" name="pol1" value="Муж"> Муж</p>
                <p><input type="checkbox" name="pol2" value="Жен"> Жен</p>
            </div>
            <div id="phold">
                <p><input id="plvozr" name="voz1" type="text" placeholder="с"></p>
                <p><input id="plvozr" name="voz2" type="text" placeholder="по"></p>
            </div>
            <button id="btnfind" >Поиск</button>

        </div>
    </div>
</form>
<div id="findmes" ></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../libs/find.js"></script>
<script src="../libs/bootstrap.min.js"></script>



</body>
</html>