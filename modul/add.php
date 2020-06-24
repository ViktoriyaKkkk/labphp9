<form name="form_add" method="post" action="/?p=add">
<label for="pers">ФИО:
<input type="text" name="pers" id="pers" placeholder="ФИО"></label>
<label class="radio_inp" for="male">Муж
<input type="radio" class="radio_inp" value="муж" name="gend" id ="male"/></label> <!-- value это значение в пост name это ключ в пост id это значение для label-->
<label class="radio_inp" for="fmale">Жен
<input type="radio" class="radio_inp" value="жен" name="gend" id="fmale"/><br></label>
<label for="birth">Дата рождения:
<input type="date" name="birth" id="birth"></label>
<label for="tel">Телефон:
<input type="text" name="tel" id="tel" placeholder="Телефон"></input></label>
<label for="adres">Адрес:
<textarea name="adres" id="adres" placeholder="Адрес"></textarea></label>
<label for="email">Почта:
<input type="email" id="email" name="mail"></label>
<label for="comment">Комментарий:
<textarea name="commen" id="comment" placeholder="Краткий комментарий"></textarea></label>
<input type="submit" name="button" value="Добавить запись">
</form><?php
 // если были переданы данные для добавления в БД
 if( isset($_POST['button']) && $_POST['button']== 'Добавить запись')
 {
$connect = pg_connect("host=localhost port=5432 dbname=demo user=postgres password=fly2505") or die('Не удалось соединиться: '.pg_last_error($connect));
 // формируем и выполняем SQL-запрос для добавления записи
 $query_add=pg_query($connect, "INSERT INTO php_demo VALUES ('".
 htmlspecialchars($_POST['pers'])."', '".
 htmlspecialchars($_POST['gend'])."', '".
 htmlspecialchars($_POST['birth'])."', '".
 htmlspecialchars($_POST['tel'])."', '".
 htmlspecialchars($_POST['adres'])."', '".
 htmlspecialchars($_POST['mail'])."', '".
 htmlspecialchars($_POST['commen'])."') ");
//  $sql_res=mysqli_query($mysqli, 'INSERT INTO friends VALUES ("'.
// htmlspecialchars($_POST['name']).'", "'.
// htmlspecialchars($_POST['comment']).'")');
 // если при выполнении запроса произошла ошибка – выводим сообщение
 if(!$query_add)
 echo '<div class="error">Запись не добавлена</div>';
 else // если все прошло нормально – выводим сообщение
 echo '<div class="ok">Запись добавлена</div>';
 }
?>