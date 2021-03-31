<?php
	require_once("db_connect.php");
	require_once("header.php");
	/*Вывод результатов поиска с главной страницы*/
?>
<div class="center_vertical">
	<table class="search">
		<form action="search_news.php" method="post">
		<tr><th>Поиск по:</th>
			<th><select name = "type">
				<option value="all">Всё</option>
				<option value="name">Названию</option>
				<option value="theme">Теме</option>
				<option value="direct">Направлению</option>
				<option value="content">Содержанию</option>
			</select></th></tr>
		<tr><th>Дата:</th> 
		    <th><input type="date" name="date"/></th></tr>
		<tr><th>Что ищем:</th> 
			<th><input name="query_str"></th></tr>
		<tr><th colspan = 2><input type=submit value="Поиск"></th></tr>
		</form>
	</table>

<?php
	if(isset($_GET['act'])) 
    	{$act = $_GET['act'];} 
    else {$act = 'home';}
	switch($act) {
	case 'home':
		/*Вывод результатов поиска со страницы поиска*/
		if (!empty($_POST['query_str'])){
			$type = trim($_POST['type']);
			$query_str = trim($_POST['query_str']);
			$query_str = strip_tags($query_str);
			$date = $_POST['date'];
			if (empty($_POST['date'])){
				if ($type == 'all'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content`
								from `news` 
								where (
								`name` like '%$query_str%' OR 
								`theme` like '%$query_str%' OR 
								`direct` like '%$query_str%' OR 
								`content` like '%$query_str%'
										)"
										;
				}
				if ($type == 'name'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` from `news` where `name` like '%$query_str%'";
				}
				if ($type == 'theme') {
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` from `news`
						  	WHERE `theme` like '%$query_str%'";
				}
				if ($type == 'direct'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` from `news`
						  	WHERE `direct` like '%$query_str%'";
				}
				if ($type == 'content'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` FROM `news`
						  	WHERE `content` like '%$query_str%'";
				}
			}
			#echo $_POST['date'];
			if (!empty($_POST['date'])){
				$date = $_POST['date'];

				if ($type == 'all'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` from news where (`name` like '%$query_str%' OR `theme` like '%$query_str%' OR `direct` like '%$query_str%' OR `content` like '%$query_str%') AND `date_public` = '$date'
						Order by `date_public`";
				}
				if ($type == 'name'){
					$query = "select `id`,`name`, `theme`, `direct`, `content` from news where `name` like '%$query_str%' AND `date_of_entry` = '$date'";
				}
				if ($type == 'theme') {
					$query = "select `id`,`name`, `theme`, `direct`, `content` from news
						  	WHERE `theme` like '%$query_str%' AND `date_public` = '$date'";
				}
				if ($type == 'direct'){
					$query = "select `id`,`name`, `theme`, `direct`, `content` from news
						  	WHERE `direct` like '%$query_str%' AND `date_public` = '$date'";
				}
				if ($type == 'content'){
					$query = "select `id`,`name`, `theme`, `direct`, `content` from news
						  	WHERE `content` like '%$query_str%' AND `date_public` = '$date'";
				}
			}
			
			$result = $mysqli->query($query) or die ("ошибка в чтении таблицы");
			$i=1;
			echo "<div class=\"news\">";
			while($row = mysqli_fetch_array($result)) {
					$i++;
					echo "<article>";
					echo "<div class = \"name\"><a href = '?act=read_news&id=$row[0]'>".$row[1]."</a></div></br>";
					echo "<div>";# "<p class = \"text\">".$row[1]."</p>";
					echo "<p class = \"text\">".$row[2]."</p>";
					echo "<p class = \"text\">".$row[3]."</p>";
					echo "<p class = \"text\">".$row[4]."</p>";
					echo "<div>";
					echo "</article>";				
				}
			echo "</div>";
			if ( $i == 1 ) echo "Ничего не можем предложить. Извините";
		}
			
		
		#$mysqli->close();
		break;
	case 'read_news':
			if (isset($_GET['id'])){
			$id = $_GET['id'];
			$query = "SELECT `name`, `content` FROM `news` WHERE `id` = $id";
			$result = $mysqli->query("SELECT `name`, `theme`, `direct`, `content`, `date_public` FROM `news` WHERE `id` = $id") or die("ERROR");
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
?>
</div>
</main>
<?php
    //Подключение подвала
    require_once("footer.php");
?>
