<?php
    //Подключение шапки
    require_once("db_connect.php");
    require_once("header.php");
?>
<table class = "timetable">
	<?php
		if(isset($_GET['act'])){$act = $_GET['act'];} 
    	else {$act = 'home';}
    	switch ($act) {
    		case 'home':
    			$units = $mysqli->query("SELECT units.id, units.name FROM units");
				while ($units_array = mysqli_fetch_array($units)) {
					echo "<tr><th><a href='?act=view&id=$units_array[0]'>".$units_array[1]."</a></th></tr>";
				}
    			break;
    		case 'view':
    			if(isset($_GET['id'])) $id = $_GET['id'];
    			$timetable = $mysqli->query("SELECT units.Name, day_week.name, timetable.time_begin, timetable.time_end FROM units, day_week, timetable WHERE units.ID = timetable.id_units AND day_week.id = timetable.id_day_week AND units.id = '".$id."' ");
    			$i = 0;
    			while($timetable_array = mysqli_fetch_array($timetable)){
			    	if ($i%7 == 0) echo "<tr><th colspan = '3'>".$timetable_array[0]."</th></tr>";
			    	echo "<tr><th>".$timetable_array[1]."</th>";

			    	if (empty($timetable_array[2])) echo "<th>Выходной</th>";
			    	else echo "<th>".$timetable_array[2]."</th>";

			    	if (empty($timetable_array[3])) echo "<th>Выходной</th></tr>";
			    	else echo "<th>".$timetable_array[3]."</th></tr>";

			    	$i++;
    			}
    			echo "<a href='?act=home'class = \"go_back\">[Вернуться]</a>";
    			break;
    	}
		
	?>
</table>
<div class = "void"></div>
</main>
	<?php
    //Подключение подвала
    require_once("footer.php");
?>