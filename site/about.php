<?php
    //Подключение шапки
    require_once("header.php");
?>
		<table>
			<tbody>
				<tr>
				<td>
					<div>
						<h3>Карта сайта</h3>
						<div class="map_site">
							<div>
								<p class="top_title"><a href="index.php">Главная</a></p>
							</div>
							<div>
								<p class="top_title"><a href="administration.php">Администрация</a></p>
								<p><a href="director.php">Глава администрации</a></p>
								<p><a href="struct.php">Структурные подразделения администрации</a></p>
								<p><a href="municip_service.php">Муниципальные службы</a></p>
							</div>
							<div>
								<p class="top_title"><a href="news.php">Новости</a></p>
								<p><a href="/news1.php">Социальная сфера</a></p>
								<p><a href="/news2.php">Городская сфера</a></p>
								<p><a href="search_news.php">Поиск по новостям</a></p>
							</div>
							<div>
								<p class="top_title"><a href="#">Приемная</a></p>
								<p><a href="/timetable.php">Расписание приема</a></p>
								<?php if($_SESSION['user']==true)
									echo "
									<p><a href=\"form_appointment.php\">Запись на прием</a></p>";
								?>
							</div>
							<div>
								<p class="top_title"><a href="documents.php">Документы</a></p>
								<p><a href="/documents1.php">Устав города</a></p>
								<p><a href="/documents2.php">Регламент администрации</a></p>
								<p><a href="/documents3.php">Правила землепользования и застройки города</a></p>
								<p><a href="/documents4.php">Муниципальные программы города</a></p>
								<p><a href="search_documents.php">Поиск по документам</a></p>
							</div>
							<div>
								<p class="top_title"><a href="search.php">Поиск</a></p>
							</div>
						</div>
						<div class = "about">
							<p>Copyright © 2020</p>
							<p>Администрация г. N</p>
							<p>При цитировании с сайта cсылка на http://cityn.ru обязательна, при использовании материалов в сети Интернет гиперссылка на сайт обязательна.</p>
						</div>
					</div>					
				</td>
				</tr>
			</tbody>
		</table>
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
			<p><a href="about.html">About</a></p>
		</div>
		</div>
	</footer>
</body>
</html>