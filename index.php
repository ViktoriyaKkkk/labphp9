<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <title>КурниковаВА_191-322_Л1</title>
    <link rel="stylesheet" href="other/style.css">
</head>

<body>
    <header>
        <div class="header_container">
            <img src="other/logo.jpg" alt="logo" class="logo">
            <p>Курникова В.А. 191-322 Л1</p>
        </div>
    </header>
    <main>
        <h1>ПЕРВАЯ ЛАБА!</h1>

        <?php
        require 'modul/menu.php'; // главное меню
        if( $_GET['p'] == 'viewer' ) // если выбран пункт меню "Просмотр"
{
include 'modul/viewer.php'; // подключаем модуль с библиотекой функций
// если в параметрах не указана текущая страница – выводим самую первую
if( !isset($_GET['pg']) || $_GET['pg']<0 ) $_GET['pg']=0;
// если в параметрах не указан тип сортировки или он недопустим
if(!isset($_GET['sort']))
$_GET['sort']='byid'; // устанавливаем сортировку по умолчанию
// формируем контент страницы с помощью функции и выводим его
echo getFriendsList($_GET['sort'], $_GET['pg']);
}
else // подключаем другие модули с контентом страницы
if( file_exists($_GET['p'].'.php') ) { include 'modul/'.$_GET['p'].'.php'; } 
        ?>
    </main>
    <footer>
        <p>Moscow politech</p>
    </footer>
</body>

</html>