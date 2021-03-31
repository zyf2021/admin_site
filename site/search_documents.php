<?php
	require_once("db_connect.php");
	require_once("header.php");
	/*Вывод результатов поиска с главной страницы*/
?>
<div class="center_vertical">
	<table class="search">
		<form action="search_documents.php" method="post">
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
			
			if (empty($_POST['date'])){
				if ($type == 'all'){
					$query = "SELECT `id`,`name`, `theme`, `direct` 
								from `documents` 
								where (
								`name` like '%$query_str%' OR 
								`theme` like '%$query_str%' OR 
								`direct` like '%$query_str%' OR 
								`content` like '%$query_str%'
										)"
										;
				}
				if ($type == 'name'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` from `documents` where `name` like '%$query_str%'";
				}
				if ($type == 'theme') {
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` from `documents`
						  	WHERE `theme` like '%$query_str%'";
				}
				if ($type == 'direct'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` from `documents`
						  	WHERE `direct` like '%$query_str%'";
				}
				if ($type == 'content'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` FROM `documents`
						  	WHERE `content` like '%$query_str%'";
				}
			}

			#$date = checkdate(month, day, year)$_POST['date'];
			#echo $_POST['date'];
			if (!empty($_POST['date'])){
				$date = $_POST['date'];
				echo $date;

				if ($type == 'all'){
					$query = "SELECT `id`,`name`, `theme`, `direct`, `content` from documents where (`name` like '%$query_str%' OR `theme` like '%$query_str%' OR `direct` like '%$query_str%' OR `content` like '%$query_str%') AND `date_of_entry` = '$date'
						Order by `date_of_entry`";
				}
				if ($type == 'name'){
					$query = "select `id`,`name`, `theme`, `direct`, `content` from documents where `name` like '%$query_str%' AND `date_of_entry` = '$date'";
				}
				if ($type == 'theme') {
					$query = "select `id`,`name`, `theme`, `direct`, `content` from documents
						  	WHERE `theme` like '%$query_str%' AND `date_of_entry` = '$date'";
				}
				if ($type == 'direct'){
					$query = "select `id`,`name`, `theme`, `direct`, `content` from documents
						  	WHERE `direct` like '%$query_str%' AND `date_of_entry` = '$date'";
				}
				if ($type == 'content'){
					$query = "select `id`,`name`, `theme`, `direct`, `content` from documents
						  	WHERE `content` like '%$query_str%' AND `date_of_entry` = '$date'";
				}
			}
			

			$result = $mysqli->query($query) or die ("ошибка в чтении таблицы");
			$i=1;
			#echo $result;
			echo "<div class=\"news\">";
			while($row = mysqli_fetch_array($result)) {
					$i++;
					echo "<article>";
					echo "<p class = \"title\"><a href = '?act=read_documents&id=$row[0]'>".$row[1]."</a></p></br>";
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
	case 'read_documents':
			if (isset($_GET['id'])){
			$id = $_GET['id'];
			$query = "SELECT `name`, `content` FROM `documents` WHERE `id` = $id";
			$result = $mysqli->query("SELECT `name`, `theme`, `direct`, `content`, `date_of_entry` FROM `documents` WHERE `id` = $id") or die("ERROR");
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
