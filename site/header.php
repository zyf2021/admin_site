<?php
    //Запускаем сессию
    session_start();
?>
 <?php $url = $_SERVER["REQUEST_URI"];?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
	<title>Город N</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script type="text/javascript">
    $(document).ready(function(){
        "use strict";
        // Проверка email 
        //регулярное выражение для проверки email
        var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
        var mail = $('input[name=email]');
        mail.blur(function(){
            if(mail.val() != ''){
 
                // Проверяем, если введенный email соответствует регулярному выражению
                if(mail.val().search(pattern) == 0){
                    // Убираем сообщение об ошибке
                    $('#valid_email_message').text('');
 
                    //Активируем кнопку отправки
                    $('input[type=submit]').attr('disabled', false);
                }else{
                    //Выводим сообщение об ошибке
                    $('#valid_email_message').text('Не правильный Email');
 
                    // Дезактивируем кнопку отправки
                    $('input[type=submit]').attr('disabled', true);
                }
            }else{
                $('#valid_email_message').text('Введите Ваш email');
            }
        });
 
        //Проверка длины пароля
        var password = $('input[name=password]');
         
        password.blur(function(){
            if(password.val() != ''){
 
                //Если длина введенного пароля меньше шести символов, то выводим сообщение об ошибке
                if(password.val().length < 6){
                    //Выводим сообщение об ошибке
                    $('#valid_password_message').text('Минимальная длина пароля 6 символов');
 
                    // Дезактивируем кнопку отправки
                    $('input[type=submit]').attr('disabled', true);
                     
                }else{
                    // Убираем сообщение об ошибке
                    $('#valid_password_message').text('');
 
                    //Активируем кнопку отправки
                    $('input[type=submit]').attr('disabled', false);
                }
            }else{
                $('#valid_password_message').text('Введите пароль');
            }
        });
    });
</script>
</head>
<body>
	<header>
		<div><h2 class="shadow"><a href="index.php">Администрация города N</a></h2></div>
	</header>
	<main>
	
	 <nav class="horiz">
			<ul class = "topmenu">
				<li><a href="/index.php" <?php if (preg_match("/index.php*/", $url)) {echo 'class="active"';}?>>Главная</a></li>
				<li><a href="administration.php" <?php if ((preg_match("/administration.php*/",$url))||(preg_match("/director.php*/",$url))||(preg_match("/struct.php*/",$url))) {echo 'class="active"';}?>>Администрация</a>
					<ul class = "submenu">
					<li><a href="/director.php">Глава города</a></li>
					<li><a href="/struct.php">Структура</a></li>
					<!--<li><a href="municip_service.php">Муниципальные службы</a></li>-->
					</ul> 
				</li>
				<li><a href="news.php" <?php if ((preg_match("/news.php*/", $url))||(preg_match("/news1.php*/",$url))||(preg_match("/news2.php*/",$url))||(preg_match("/search_news.php*/",$url))) {echo 'class="active"';}?>>Новости</a>
					<ul class = "submenu">
					<li><a href="/news1.php">Социальная сфера</a></li>
					<li><a href="/news2.php">Городская сфера</a></li>
					<li><a href="/search_news.php">Поиск по новостям</a></li>
					</ul>
				</li>
				<li><a href="#" <?php if (($url == "/#")||(preg_match("/form_appointment.php*/",$url))) {echo 'class="active"';}?>>Приемная</a>
					<ul class = "submenu">
					<li><a href="/timetable.php">Расписание приема</a></li>
					<?php if (isset($_SESSION['email']) && isset($_SESSION['password']) && ($_SESSION['user']==true || $_SESSION['admin']==true))
						echo "
					<li><a href=\"/form_appointment.php\">Запись на прием</a></li>";
					?>
					</ul>
				</li>
				<li><a href="/documents.php" 
					<?php if 
						((preg_match("/documents.php*/",$url))||
						(preg_match("/documents1.php*/",$url))||
						(preg_match("/documents2.php*/",$url))||
						(preg_match("/documents3.php*/",$url))||
						(preg_match("/documents4.php*/",$url))||
						(preg_match("/search_documents.php*/",$url))) {echo 'class="active"';}?>>Документы</a>
				<ul class = "submenu">
					<li><a href="/documents1.php">Устав города</a></li>
					<li><a href="/documents2.php">Регламент администрации</a></li>
					<li><a href="/documents3.php">Правила землепользования</a></li>
					<li><a href="/documents4.php">Муниципальные программы</a></li>
					<li><a href="/search_documents.php">Поиск по документам</a></li>
					</ul>
				</li>
				<?php
					if (!isset($_SESSION['email']) && !isset($_SESSION['password'])){ 
				?>
						<li><a href="#" <?php if ((preg_match("/form_register.php*/",$url))||(preg_match("/form_auth.php*/",$url))) {echo 'class="active"';}?>>Войти на сайт</a>
							<ul class = "submenu">
								<li><a href="/form_register.php">Регистрация</a></li>
								<li><a href="/form_auth.php">Авторизация</a></li>
							</ul>
						</li>
				<?php
					}else{
						echo "<li><a href=\"/logout.php\">Выход</a>"; 			
						if($_SESSION['admin']==true) {
							echo "<ul class = \"submenu\">
									<li>
										<a href=\"/adminpanel.php\">Администрация сайта</a>
									</li>
								  </ul></li>";
						}
					}
						
				?>
						
				<li class = "search">
					<form action="/search.php" method="post">
					<input class = "search" type="search" name="query_str_main" placeholder="Поиск по сайту">
					<input class="buttom1" type="submit" value="Найти"></li>
					</form>

			</ul>
		</nav>