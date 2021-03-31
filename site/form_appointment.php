<?php
    //Запускаем сессию
    session_start();
?>
 <?php $url = $_SERVER["REQUEST_URI"];?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Город N</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<header>
		<div><h2 class="shadow"><a href="index.html">Администрация города N</a></h2></div>
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

</div>
		<div class="center_horizontal">
			<div class="appointment">
				<form name = "form_appointment" method="post" action="appointment.php" onsubmit="return validate_form()">
					<div class="str">
						<div><p>Фамилия*</p></div>
						<div><input class = "str" type="text" name="last_name" size="20" placeholder="Фамилия" required></div>
					</div>
					<div class="str">
						<div><p>Имя*</p></div>
						<div><input class = "str" type="text" name="first_name" size="20" placeholder="Имя" required></div>
					</div>
					<div class="str">
						<div><p>Отчество*</p></div>
						<div><input class = "str" type="text" name="middle_name" size="20" placeholder="Отчество" required></div>
					</div>
					<div class="str">
						<div><p>Телефон </p></div>
						<div><input class = "str" type="text" id="phone" name="phone" size="20" title="Номер телефона только цифры" required pattern="[0-9]{11}"></div>
					</div>
					<div class="str">
						<div><p>e-mail* </p></div>
						<div><input class = "str" type="email" name="email" placeholder="e-mail" required></div>
					</div>
					<div class="str">
						<div><p>Тема</p></div>
						<div><select class = "str" name="depart">
							<option value="">Выберите тему</option>
							<option value="1">Тема 1</option>
							<option value="2">Тема 2</option>
							<option value="3">Тема 3</option>
							<option value="4">Тема 4</option>
							<option value="5">Тема 5</option>
							<option value="6">Тема 6</option>
							<option value="7">Тема 7</option>
							<option value="3">Тема 8</option>
							</select></div>
					</div>
					<div class="str">
						<div><p>Текст обращения</p></div>
						<div><textarea class = "str" name = "text" cols = 50 rows= 6></textarea></div>
					</div>
					<p>Направить ответ на обращение (выберите один способ)</p>
					<div class="str">
						<div>
							<p>
								Направить письмо по почте 
							</p>
						</div>
						<div>
							<input type="radio" name="vr" value="vr1">
						</div>
					</div>
					<div class="str">
						<div>
							<p>
								Направить письмо по e-mail
							</p>
						</div>
						<div>
							<input type="radio" name="vr" value="vr2">
						</div>
					</div>
					<p>Вы даете соглсие на обработку ваших данных?</p>
					<div class="str">
						<div>
							<p>
								Да
							</p>
						</div>
						<div>
							<input type="checkbox" name="terms" value="yes">
						</div>
					</div>
					<div class="str">
						<div>
							<p>
								<input class="buttom" type="submit" name="mybt" value="Отправить"></p>
						</div>
					</div>
					
				</form>
			</div>
		</div>
		<div class="block_for_messages">
   		 <?php
        //Если в сессии существуют сообщения об ошибках, то выводим их
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
 
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }
 
        //Если в сессии существуют радостные сообщения, то выводим их
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
             
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    	?>
	</main>
	<footer>
		<div class="wrapper">
		<div class="left">
			<p>Контактная информация:</p>
			<p>Телефон приемной 89997776655</p>
			<p>Техподдержка e-mail helpme@cherty.ru</p>
		</div>
		<div class="right">
			<p>Адрес:</p>
			<p>ул. Центральная д. 46</p>
			<p><a href="about.php">About</a></p>
		</div>
		</div>
	</footer>
</body>
</html>