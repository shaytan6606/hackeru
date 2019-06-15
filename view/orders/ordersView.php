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
    
    if($allOrders['userid'] == $_SESSION['id']) {
        echo '<tr style="background: green">';
    } else {
        echo '<tr style="background: red; height: 52px">';
    }

    foreach($allOrders as $order){
        echo '<th>' . $order . '</th>';
    }
    if($allOrders['userid'] == $_SESSION['id']) {
        echo '<th><p><a href="/orders/deleteorder/'. $allOrders['id'] .'">Удалить</a></p></th>';
    }
    // echo '<th><p><a href="/orders/deleteorder/'. $allOrders['id'] .'">Удалить</a></p></th>';
    echo '</tr>';
    // echo $allOrders['id'];
}

?>

</table>
</div>
