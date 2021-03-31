<?php
	require_once("db_connect.php");
	if(isset($_POST['name']) && isset($_POST['content']) && isset($_POST['direct'])){
		$update = $mysqli->query("UPDATE documents SET name='$_POST[name]', 
										 content='$_POST[content]', 
										 direct='$_POST[direct]' 
										 WHERE id='$id'") 
							or die("Не обновлена таблица");

		if($update){
			/*$result = $mysqli->query("SELECT * FROM documents WHERE id='$id'") or die("Не удалось прочитать данные из таблицы");*/
			$message = "Успешно обновлено!";
		}
	}
	echo $message;
	/*$update->close();*/
    $mysqli->close();
	/*header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$address_site."/adminpanel.php");
    /*exit();				

            /*if(mysqli_num_rows($result) == 1) {
						if(isset($_POST['name']) && isset($_POST['content']) && isset($_POST['direct'])) {
							$update = $mysqli->query("UPDATE documents SET name='$_POST[name]', content='$_POST[content]', direct='$_POST[direct]' WHERE id='$id'") or die("Не обновлена таблица");
							if($update){
								$result = $mysqli->query("SELECT * FROM documents WHERE id='$id'") or die("Не удалось прочитать данные из таблицы");
								$message = "Успешно обновлено!";
							}
						}
						/*$documents = $result->fetch_array(MYSQLI_ASSOC);
						$act = 'edit_documents';
						//форма
						/*echo "<table class = 'admin'>
								<tr>
									<a href='?act=home'><- Вернуться</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form method='post' class='documents-form'>
											<b>Название:</b> <input type='text' name='name' value='".$documents_array[1]."'><br>
											<b>Направление:</b> <input type='text' name='direct' value='".$documents_array[4]."'><br>
											<b>Текст:</b> <textarea name='content'>$documents_array[8]</textarea></br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";*/
					
?>