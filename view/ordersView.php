<div>
<table>
<tr>
<th></th>
<th>Имя</th>
<th>Стоимость</th>
<th>Дата получения</th>
<th>Дата выдачи</th>
<th>Id пользователя</th>
</tr>
<?php
foreach(self::$renderData as $allOrders){
    echo '<tr>';
    foreach($allOrders as $order){
        echo '<th>' . $order . '</th>';
    }
    echo '<th><p><a href="/deleteorder/'. $allOrders['id'] .'">Удалить</a></p></th>';
    echo '</tr>';
    // echo $allOrders['id'];
}

?>

</table>
</div>
