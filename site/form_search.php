<?php
	require_once("header.php");



?>
<div class="center_vertical">
	<form action="search.php" method="post">
	Поиск по <br>
		<select name = "type">
			<option value="all">По сайту</option>
			<option value="news">Новости</option>
			<option value="documents">Документы</option>
		</select>
		<br>
	Что ищем:<br> 
		<input name="query_str"> <br> <input type=submit value="Поиск">
	</form>
</div>
</main>
	<?php
    //Подключение подвала
    require_once("footer.php");
?>
