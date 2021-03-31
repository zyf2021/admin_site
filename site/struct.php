<?php
	require_once("db_connect.php");
    //Подключение шапки
    require_once("header.php");
    if(isset($_GET['act'])) 
    	{$act = $_GET['act'];} 
    else {$act = 'home';}
?>		<div class="center_vertical">
			<?php

				$result = $mysqli->query("SELECT units.id, units.Name, units.Purpose, units.Discript, units.image, director.full_name, director.phone FROM units LEFT OUTER JOIN director ON units.ID = director.id_unit");
				switch ($act) {
					case 'home':
						if(mysqli_num_rows($result) >= 1) {
						echo "<div>";
						while ($row = mysqli_fetch_array($result)) {
							echo "<div class = \"depart\" >
									<p>
										<svg height=\"100\" width=\"100\">
	   										<rect x=\"10\" y=\"20\" rx = \"5px\" ry = \"5px\" width=\"80\" height=\"10\"
	   											style=\"fill: Coral\"
	   										/>
	   										<rect x=\"10\" y=\"35\" rx = \"5px\" ry = \"5px\" width=\"80\" height=\"10\"
	   											style=\"fill: Coral\"
	   										/>
	   										<rect x=\"10\" y=\"50\" rx = \"5px\" ry = \"5px\" width=\"80\" height=\"10\"
	   											style=\"fill: Coral\"
	   										/>
										</svg>
									</p>
									<p>
										<a href = '?act=show_unit&id=$row[0]'>".$row[1]."</a>
									</p>
									
								</div>";

									


							/*echo "<article>
										<div class = \"name\">
											".$row[1]."
										</div>
										<div>
											<p class = \"text\">".$row[2]."</p>
											<p class = \"text\">".$row[3]."</p>
											<p class = \"text\">".$row[4]."</p>
											<p class = \"img\">
												<img src=\"photo1.png\" alt=\"Город\" width=\"100\" height=\"100\">
											</p>
										</div>
								  </article>";
							echo "<div class = \"show_news\">";
							echo "<div class = \"title\">".$row[0]."</div>";
							echo "<div>".$row[1]."</div>";
							echo "<div>".$row[2]."</div>";
							echo "<div>Руководитель: ".$row[3]."</div>";
							echo "<table class = \"show_director\">
									<tr>
										<th>Руководитель: ".$row[3]."</th>
										<th><img src=\"photo1.png\" alt=\"Город\" width=\"100\" height=\"100\"></th>
									</tr>
									<tr>
										<th colspan = 2>Телефон:".$row[4]."</th>
									</tr>
							</table>";*/
						}
						echo "</div>";
						}
						break;
					case 'show_unit':
						if (isset($_GET['id'])){
						$id = $_GET['id'];
						$result = $mysqli->query("SELECT units.id, units.Name, units.Purpose, units.Discript, director.full_name, director.phone FROM units LEFT OUTER JOIN director ON units.ID = director.id_unit WHERE units.id = $id");
						/*$query = "SELECT `name`, `content` FROM `news` WHERE `id` = $id";
						$result = $mysqli->query("SELECT `name`, `theme`, `direct`, `content`, `date_public` FROM `news` WHERE `id` = $id") or die("ERROR");*/
						$row = mysqli_fetch_array($result);
						
						
						echo "<div class = \"show_news\">";
						echo "<div class = \"title\">".$row[1]."</div>";
						echo "<div>".$row[2]."</div>";
						echo "<div>".$row[3]."</div>";
						echo "<div>Руководитель: ".$row[4]."</div>";
						echo "<div>Телефон: ".$row[5]."</div>";
						echo "<div><a href='?act=home' class = \"go_back\">Вернуться</a></div>";
						echo "</div>";
						echo "<div class = \"void\"></div>";
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