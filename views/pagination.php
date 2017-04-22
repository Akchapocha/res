<?php
if (empty($spisok)){
    exit ('Нет данных удовлетворяющих запросу поиска');
}else {
//    echo '<h3>Результат поиска</h3>';
    echo '<div class="container" style="margin-top: 35px">
            <table id="mytable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>№ id</th>
                        <th>Фото</th>
                        <th>ФИО</th>
                        <th>Возраст</th>
                        <th>Пол</th>
                        <th>Действие</th>
                    </tr>
                </thead>
        
                <tbody>';
    $i = 0;
    foreach ($bd as $item => $row) {
        foreach ($spisok as $item => $value) {
            if ($row['id'] == $value) {
                $i = $i + 1;
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                if (!empty($row['img'])) {
                    echo '<td><img src=' . $row['img'] . '></td>';
                } else echo '<td>Нет фото</td>';
                echo '<td id="family">' . $row['family'] . ' ' . $row['name'] . ' ' . $row['midle_name'] . '</td>';
                echo '<td>' . (date("Y-m-d") - $row['birthday']) . '</td>';
                if ($row['gender'] == 'муж') {
                    echo '<td style="color: #0080C7">' . $row['gender'] . '</td>';
                } else {
                    echo '<td style="color: #FF05D3">' . $row['gender'] . '</td>';
                }
                echo '<td><a href="#">Ред</a>, <a href="#">удал</a></td>';
                if ($i == 1) {
                    echo '</tr>';
                }
            }
        }
    }
    echo '</tr>';
}
?>
    </tbody>
</table>
    <h4>Страницы</h4>
    <div class="pagination-container">
        <nav>
            <ul class="pagination" style="cursor: pointer"></ul>
        </nav>
    </div>
</div>


<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>
<script src="../libs/pagination.js"></script>