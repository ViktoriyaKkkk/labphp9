<div id="menu">
<?php
// если нет параметра меню – добавляем его
if( !isset($_GET['p']) ) $_GET['p']='viewer';
echo '<div class="menu_item" class="spisok" ><a href="/?p=viewer"'; // первый пункт меню
if( $_GET['p'] == 'viewer' ) // если он выбран
echo ' class="selected"'; // выделяем его
echo '>Просмотр</a></div>';
echo '<div class="menu_item" class="spisok" ><a href="/?p=add"'; // второй пункт меню
if( $_GET['p'] == 'add' ) echo ' class="selected"';
echo '>Добавление записи</a></div>';
echo '<div class="menu_item" class="spisok" ><a href="/?p=edit"'; // второй пункт меню
if( $_GET['p'] == 'edit' ) echo ' class="selected"';
echo '>Редактирование записи</a></div>';
echo '<div class="menu_item" class="spisok" ><a href="/?p=delete"'; // второй пункт меню
if( $_GET['p'] == 'delete' ) echo ' class="selected"';
echo '>Удаление записи</a></div></div>';
if( $_GET['p'] == 'viewer' ) //если был выбран первый пунт меню
{
 echo '<div id="submenu">'; // выводим подменю
echo '<div class="spisok" class="menu_item"><a href="/?p=viewer&sort=byid"'; // первый пункт подменю
if( !isset($_GET['sort']) or $_GET['sort'] == 'byid' )
echo ' class="selected"';
echo '>По умолчанию</a></div>';
echo '<div class="spisok" class="menu_item"><a href="/?p=viewer&sort=fam"'; // второй пункт подменю
if( isset($_GET['sort']) && $_GET['sort'] == 'fam' )
echo ' class="selected"';
echo '> По фамилии</a></div>';
 echo '</div>'; // конец подменю
}
?>
