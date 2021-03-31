<?php
	require_once("db_connect.php");
    //Подключение шапки
    require_once("header.php");
    if(isset($_GET['act'])) 
    	{$act = $_GET['act'];} 
    else {$act = 'home';}
	
?>		
		<div class="center_vertical">
			<div><h3>Новости города</h3></div>
		<?php
			function link_bar($page, $pages_count)
			{
				for ($j = 1; $j <= $pages_count; $j++)
				{
				// Вывод ссылки
					if ($j == $page) {
					echo ' <a style="color: #808000;" ><b>'.$j.'</b></a> ';
				} else {
					echo ' <a style="color: #808000;" href='.$_SERVER['php_self'].'?page='.$j.'>'.$j.'</a> ';
				}
				// Выводим разделитель после ссылки, кроме последней
				// например, вставить "|" между ссылками
					if ($j != $pages_count) echo ' ';
				}
					return true;
			}
			switch ($act) {
				case 'home':
					$per_page = 5; // Количество отображаемых данных из БД
					$cur_page = 1;
					if (isset($_GET['page']) && $_GET['page'] > 0){
	    				$cur_page = $_GET['page'];
					}
					$start_page = ($cur_page - 1) * $per_page;


					$num_rows = mysqli_num_rows($mysqli->query("SELECT * FROM news")) or die('error! Записей не найдено!');
					$num_pages = ceil($num_rows / $per_page);
			
					$query = "SELECT id,name,theme,direct,content FROM news LIMIT $start_page,$per_page";
					$result = $mysqli->query($query) or die('error!');
					echo "<div class=\"news\">";
					while($row = mysqli_fetch_array($result)) {
						echo "<article>
	           				<div class=\"name\">
	           					<a href = '?act=read_news&id=$row[0]'>".$row[1]."</a>
							</div>
							<div>
								<p class = \"text\">";
									echo $row[4],"
								</p>
								<p class = \"img\">
										<img src=\"photo1.png\" alt=\"Город\" width=\"100\" height=\"100\">
								</p></div></article>";
					}
					link_bar($cur_page,$num_pages);
					echo "</div>";
					
					break;
				case 'read_news':
					if (isset($_GET['id'])){
						$id = $_GET['id'];
						#echo $id;
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