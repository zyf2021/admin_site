<?php
    require_once("db_connect.php");
    //Подключение шапки
    require_once("header.php");

?>
		<table>
			<tbody>
				<tr>
				<td>
					<p class="center">Структура администрации города</p>
					<nav class = "two">
						<?php
						
						$result = $mysqli->query("SELECT `name` FROM units");
						if(mysqli_num_rows($result) >= 1) {
							while ($row = mysqli_fetch_array($result)) {
							echo "<p><a href=\"struct.php\">".$row[0]."</a></p> ";
							}
						}
						?>
					</nav>	
				</td>
				<td>						
					<!--<div class="news">
						<h3><a href="news.php">Новости</a></h3>
						<?php
							$result //= $mysqli->//query("SELECT name, content FROM `news` ORDER BY date_public DESC LIMIT 2");
							/*while ($row = mysqli_fetch_array($result)){
								echo "
								<article>
									<div class=\"name\">
										<a href=\"news.php\">".$row[0]."</a>
									</div>
									<div>
										<p class = \"text\">".$row[1]." 
										</p>
										<p class =\"img\">
											<img src=\"photo1.png\" alt=\"Город\" width=\"100\" align = \"right\" height=\"100\">
										</p>
									</div>
								</article>";
							}*/
						?>
					</div>-->
					<div class="news">
						<div>
						<!--<div class = "left">-->
						<p align="bottom" class="administration">
							Как уже неоднократно упомянуто, сторонники тоталитаризма в науке и по сей день остаются уделом либералов, которые жаждут быть разоблачены. Кстати, сторонники тоталитаризма в науке, которые представляют собой яркий пример континентально-европейского типа политической культуры, будут объявлены нарушающими общечеловеческие нормы этики и морали. Следует отметить, что современная методология разработки однозначно фиксирует необходимость распределения внутренних резервов и ресурсов.
							
						</p>
						<p align="center_vertical" class="administration_img">
							<img src="photo1.png" title="Фото директора" height="250px">
						</p>					

						<p align="bottom" class="administration">
							Как уже неоднократно упомянуто, сторонники тоталитаризма в науке и по сей день остаются уделом либералов, которые жаждут быть разоблачены. Кстати, сторонники тоталитаризма в науке, которые представляют собой яркий пример континентально-европейского типа политической культуры, будут объявлены нарушающими общечеловеческие нормы этики и морали. Следует отметить, что современная методология разработки однозначно фиксирует необходимость распределения внутренних резервов и ресурсов.
							
						</p>
						<p align="center_vertical" class="administration_img">
							<img src="photo1.png" title="Фото директора" height="250px">
						</p>
						<p align="bottom" class="administration">
							Как уже неоднократно упомянуто, сторонники тоталитаризма в науке и по сей день остаются уделом либералов, которые жаждут быть разоблачены. Кстати, сторонники тоталитаризма в науке, которые представляют собой яркий пример континентально-европейского типа политической культуры, будут объявлены нарушающими общечеловеческие нормы этики и морали. Следует отметить, что современная методология разработки однозначно фиксирует необходимость распределения внутренних резервов и ресурсов.
							
						</p>
						<p align="center_vertical" class="administration_img">
							<img src="photo1.png" title="Фото директора" height="250px">
						</p>
						<!--</div>-->
						<!--<div class="right">
							<img src="photo1.png" title="Фото директора">
						</div>-->	
						</div>
					</div>
				</td>
				
				<td>
					<p class="center">Важное</p>
					<nav class = "two">
						<?php

							if(isset($_GET['act'])) 
    							{$act = $_GET['act'];} 
   							else {$act = 'home';}
							switch($act) {
								case 'home':
										$result = $mysqli->query("SELECT * FROM advertising ORDER BY date_public DESC LIMIT 5") 
										or die('error!');
										while($row = mysqli_fetch_array($result)) {
											echo "<p><a href='?act=read_advert&id=$row[0]'\">".$row[1]."</a></p>";
										}
										# code...
									break;
								case 'read_advert':
									if (isset($_GET['id'])){
									$id = $_GET['id'];
									$result = $mysqli->query("SELECT `name`, `date_public`, `content` FROM `advertising` WHERE `id` = $id") or die("ERROR");
									$row = mysqli_fetch_array($result);
									echo "<div class = \"show_news\">";
									echo "<div class = \"title\">".$row[0]."</div>";
									echo "<div>".$row[1]."</div>";
									echo "<div>".$row[2]."</div>";
									echo "<div><a href='?act=home' class = \"go_back\">Вернуться</a></div>";
									echo "</div>";

					}
					break;
									break;
							}
						?>
					</nav>
				</td>
				</tr>
			</tbody>
		</table>
	</main>
<?php
    //Подключение подвала
    require_once("footer.php");
?>