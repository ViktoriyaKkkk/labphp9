<?php
$connect = pg_connect("host=localhost port=5432 dbname=demo user=postgres password=fly2505")
 or die('Не удалось соединиться: '.pg_last_error($connect));
if( !$connect ) // если при подключении к серверу произошла ошибка
{
exit();
}
$query_read_delete=pg_query($connect, 'SELECT * FROM php_demo ORDER BY person');
while( $row=pg_fetch_array($query_read_delete, null, PGSQL_ASSOC) ) // перебираем все записи выборки
 {
 // если текущая запись пока не найдена и ее id не передан
// или передан и совпадает с проверяемой записью
 if( $_GET['id']==$row['id_person']) 
{
// значит в цикле сейчас текущая запись
$query_edit=pg_query($connect, "DELETE FROM php_demo WHERE id_person='".$_GET['id']."'");
echo 'Запись &laquo;'.$row['person'].'&raquo; удалена';
}
else // если проверяемая в цикле запись не текущая
 // формируем ссылку на нее
 echo '<div class="spisok"><a class="names" href="?p=delete&id='.$row['id_person'].'">'.$row['person'].'</a></div>';
 }
 ?>