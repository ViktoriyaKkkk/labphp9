
<?php
$connect = pg_connect("host=localhost port=5432 dbname=demo user=postgres password=fly2505")
 or die('Не удалось соединиться: '.pg_last_error($connect));
if( !$connect ) // если при подключении к серверу произошла ошибка
{
exit();
}
// если были переданы данные для изменения записи в таблице
if( isset($_POST['button']) && $_POST['button']== 'Изменить запись')
{
// формируем и выполняем SQL-запрос на изменение записи с указанным id
$query_edit=pg_query($connect, "UPDATE php_demo SET person='".
 htmlspecialchars($_POST['person'])."', gender='".
 htmlspecialchars($_POST['gend'])."', bdate='".
 htmlspecialchars($_POST['birth'])."', phone='".
 htmlspecialchars($_POST['tel'])."', address='".
 htmlspecialchars($_POST['adres'])."', email='".
 htmlspecialchars($_POST['mail'])."', comm='".
 htmlspecialchars($_POST['commen']).
 "' WHERE id_person=".$_POST['id_pers']);
 echo 'Данные изменены'; // и выводим сообщение об изменении данных
 $_GET['id']=$_POST['id_pers']; // эмулируем переход по ссылке на изменяемую запись
}
// формируем и выполняем запрос для получения требуемых полей всех записей таблицы
$query_read_edit=pg_query($connect, 'SELECT * FROM php_demo ORDER BY person');
if( $query_read_edit ) // если запрос успешно выполнен
{
 $currentROW=array(); // создаем массив для хранения текущей записи
 echo '<div id="edit_links">';
while( $row=pg_fetch_array($query_read_edit, null, PGSQL_ASSOC) ) // перебираем все записи выборки
 {
 // если текущая запись пока не найдена и ее id не передан
// или передан и совпадает с проверяемой записью
 if(  (!$currentROW && !isset($_GET['id'])) or $_GET['id']==$row['id_person']) 
{
// значит в цикле сейчас текущая запись
$currentROW=$row; // сохраняем информацию о ней в массиве
echo '<div>'.$row['person'].'</div><div>'.$row['gender'].'</div><div>'.$row['bdate'].'</div><div>'.$row['phone'].
'</div><div>'.$row['address'].'</div><div>'.$row['email'].'</div><div>'.$row['comm'].'</div>'; // и выводим ее в списке
}
else // если проверяемая в цикле запись не текущая
 // формируем ссылку на нее
 echo '<div class="spisok"><a class="names" href="?p=edit&id='.$row['id_person'].'">'.$row['person'].'</a></div>';
 }
 echo '</div>';
 // формируем HTML-код формы
echo '<form name="form_edit" method="post" action="/?p=edit">
 <input type="text" name="person" id="name"';
// если текущая запись определена – устанавливаем значение полей формы
if( $currentROW ) echo ' value="'.$currentROW['person'].'"';
echo '><label class="radio_inp" for="male">Муж
<input type="radio" class="radio_inp" value="муж" name="gend" id ="male"/></label> <!-- value это значение в пост name это ключ в пост id это значение для label -->
<label class="radio_inp" for="fmale">Жен
<input type="radio" class="radio_inp" value="жен" name="gend" id="fmale"/><br></label>
<label for="birth">Дата рождения:
<input type="date" name="birth" id="birth"';
if( $currentROW ) echo ' value="'.$currentROW['bdate'].'"';
echo '></label>
<label for="tel">Телефон:
<input type="text" name="tel" id="tel" placeholder="Телефон"';
if( $currentROW ) echo ' value="'.$currentROW['phone'].'"';
echo '></input></label>
<label for="adres">Адрес:
<textarea name="adres" id="adres" placeholder="Адрес">';
if( $currentROW ) echo $currentROW['address'];
echo '</textarea></label>
<label for="email">Почта:
<input type="email" id="email" name="mail"';
if( $currentROW ) echo ' value="'.$currentROW['email'].'"';
echo '></label>
<label for="comment">Комментарий:
<textarea name="commen" id="comment" placeholder="Краткий комментарий">';
if( $currentROW ) echo $currentROW['comm'];
echo '</textarea></label>';
echo '<input class="change" type="submit" name="button" value="Изменить запись">
 <input type="hidden" name="id_pers" value="';
if( $currentROW ) // если текущая запись определена
echo $currentROW['id_person']; // передаем ее id как POST параметр формы
echo '"></form>';
}
else // если запрос не может быть выполнен
 echo 'Ошибка базы данных'; // выводим сообщение об ошибке
?>