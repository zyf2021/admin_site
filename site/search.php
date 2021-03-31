<?php
	require_once("db_connect.php");
	require_once("header.php");
	/*Вывод результатов поиска с главной страницы*/
?>
<div class="center_vertical">
	<table class="search">
		<form action="search.php" method="post">
		<tr><th>Поиск по:</th>
			<th><select name = "type">
				<option value="all">По сайту</option>
				<option value="news">Новости</option>
				<option value="documents">Документы</option>
			</select></th></tr>
		<tr><th>Дата:</th> 
		    <th><input type="date" name="date"/></th></tr>
		<tr><th>Что ищем:</th> 
			<th><input name="query_str"></th></tr>
		<tr><th colspan = 2><input type=submit value="Поиск"></th></tr>
		</form>
	</table>
</div>
<?php
	if(isset($_GET['act'])) 
    	{$act = $_GET['act'];} 
    else {$act = 'home';}
	switch($act) {
	case 'home':
			if (!empty($_POST['query_str_main'])){
				$query_str_main = trim($_POST['query_str_main']);
				$query_str_main = strip_tags($query_str_main);
				$query_main = "select `id`,`name`, `theme`, `direct`, `content` from news
							  	where (
									`name` like '%$query_str_main%' OR 
									`theme` like '%$query_str_main%' OR 
									`direct` like '%$query_str_main%' OR 
									`content` like '%$query_str_main%'
											)
							  	UNION 
							  	select `id`,`name`, `theme`, `direct`, `content` from documents 
							  		where (
									`name` like '%$query_str_main%' OR 
									`theme` like '%$query_str_main%' OR 
									`direct` like '%$query_str_main%' OR 
									`content` like '%$query_str_main%'
											)";
				$result = $mysqli->query($query_main) or die ("ошибка в чтении таблицы");
				$i=1;
				echo "<div class=\"news\">";
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$i++;
					echo "<article>
		           				<div class=\"name\">";
								echo "	<a href = '?act=read_news&id=$row[id]'>".$row["name"]."</a>
								</div>
								<div>
									<p class = \"text\">";
					echo $row["theme"]."<br>",$row["direct"]."<br>","</p></div></article>";
				}
				echo "</div>";
				if ( $i == 1 ) echo "Ничего не можем предложить. Извините";
				unset($_POST['query_str_main']);
			}
			 
			/*Вывод результатов поиска со страницы поиска*/
			if (!empty($_POST['query_str'])){
				$type = trim($_POST['type']);
				$query_str = trim($_POST['query_str']);
				$query_str = strip_tags($query_str);
				

				if (!$query_str) die ("Не все данные введены.<br>Пожалуйста, вернитесь назад и закончите ввод");
				if (isset($_POST['date'])){
					$date = $_POST['date'];
					if ($type == 'news'){
						$query = "select `id`,`name`, `theme`, `direct` from news where `name` like '%$query_str%' AND `date_public` = '$date'";
					}
					if ($type == 'documents'){
						$query = "select `id`,`name`, `theme`, `direct` from documents where `name` like '%$query_str%' AND `date_of_entry` = '$date'";
					}
					if ($type == 'all') {
					$query = "select `id`,`name`, `theme`, `direct`, `content` from news
							  	WHERE `name` like '%$query_str%' AND `date_public` = '$date'
							  	UNION 
							  	select `id`,`name`, `theme`, `direct`, `content` from documents 
							  		where `name` like '%$query_str%' AND `date_of_entry` = '$date'";
					}
				}else{
					if ($type == 'news'){
						$query = "select `id`,`name`, `theme`, `direct` from news where `name` like '%$query_str%'";
					}
					if ($type == 'documents'){
						$query = "select `id`,`name`, `theme`, `direct` from documents where `name` like '%$query_str%'";
					}
					if ($type == 'all') {
						$query = "select `id`,`name`, `theme`, `direct`, `content` from news
								  	WHERE `name` like '%$query_str%'
								  	UNION 
								  	select `id`,`name`, `theme`, `direct`, `content` from documents 
								  		where `name` like '%$query_str%'";
					}
				}

				$result = $mysqli->query($query) or die ("ошибка в чтении таблицы");
				$i=1;
				echo "<div class=\"news\">";
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$i++;
					echo "<article>
		           				<div class=\"name\">
									<a href = '?act=read_news&id=$row[id]'>".$row["name"]."</a>
								</div>
								<div>
									<p class = \"text\">";
					echo $row["theme"]."<br>",$row["direct"]."<br>","</p></div></article>";
				}
				echo "</div>";
				if ( $i == 1 ) echo "Ничего не можем предложить. Извините";
			}
	break;
	case 'read_news':
			if (isset($_GET['id'])){
			$id = $_GET['id'];
			$result = $mysqli->query("SELECT `name`, `theme`, `direct`, `content`, `date_public` FROM `news` WHERE `id` = $id
				UNION SELECT `name`, `theme`, `direct`, `content`, `date_of_entry` FROM `documents` WHERE `id` = $id") or die("ERROR");
			$row = mysqli_fetch_array($result);
						
			echo "<div class = \"show_news\">";
			echo "<div class = \"title\">".$row[0]."</div>";
			echo "<div>".$row[1]."</div>";
			echo "<div>".$row[2]."</div>";
			echo "<div>".$row[3]."</div>";
			echo "<div>".$row[4]."</div>";
			echo "<div><a href='?act=home' class = \"go_back\">Вернуться</a></div>";
			echo "</div>";

			}
		break;
	}
		$mysqli->close();
		
?>
</main>
<?php
    //Подключение подвала
    require_once("footer.php");
?>
