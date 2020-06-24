<?php
function getFriendsList($type, $page)
{
 // осуществляем подключение к базе данных
 $connect = pg_connect("host=localhost port=5432 dbname=demo user=postgres password=fly2505") or die('Не удалось соединиться: ' . pg_last_error($connect));

 // формируем и выполняем SQL-запрос
 $query_count=pg_query($connect, 'SELECT count(*) FROM php_demo' );
if( !pg_last_error($connect) && $row=pg_fetch_row($query_count) ) // возвращаем данные о посл ошибке и формируем массив из строк запроса
{
 if( !$TOTAL=$row[0] ) // если в таблице нет записей total - колво строк
 return 'В таблице нет данных'; // возвращаем сообщение
 $PAGES = ceil($TOTAL/10); // ceil округляет до ближ целого
 if( $page>=$TOTAL ) // если указана страница больше максимальной
$page=$TOTAL-1; // будем выводить последнюю страницу
 // формируем и выполняем SQL-запрос для выборки записей из БД
 if (isset($_GET['sort']) and $_GET['sort'] == 'fam' ) {
     $sql='SELECT * FROM php_demo ORDER BY person offset '.$page.'*10 limit 10';
 } else
 $sql='SELECT * FROM php_demo offset '.$page.'*10 limit 10';
$query_read=pg_query($connect, $sql); //выполнить запрос
// echo "<table>\n";
$ret='<table>'; 
while ($row = pg_fetch_array($query_read, null, PGSQL_ASSOC)) { // пока роу не 0
    // echo "\t<tr>\n";
    // foreach ($line as $col_value) {
    //     echo "\t\t<td>$col_value</td>\n";
    // }
    
    // echo "\t</tr>\n";
    $ret.='<tr><td>'.$row['id_person'].'</td>
<td>'.$row['person'].'</td>
 <td>'.$row['gender'].'</td>
 <td>'.$row['bdate'].'</td>
 <td>'.$row['phone'].'</td>
 <td>'.$row['address'].'</td>
 <td>'.$row['email'].'</td>
 <td>'.$row['comm'].'</td></tr>';
}
$ret.='</table>';
if( $PAGES>1 ) // если страниц больше одной – добавляем пагинацию
 {
 $ret.='<div id="pages">'; // блок пагинации
 for($i=0; $i<$PAGES; $i++) // цикл для всех страниц пагинации
 if( $i != $page ) // если не текущая страница
     $ret.='<a href="?p=viewer&pg='.$i.'&sort='.$_GET['sort'].'">'.($i+1).'</a>';
 else // если текущая страница
 $ret.='<span>'.($i+1).'</span>';
 $ret.='</div>';
 }
 return $ret; // возвращаем сформированный контент
} else
 // если запрос выполнен некорректно
return 'Неизвестная ошибка'; // возвращаем сообщение

} 
?>