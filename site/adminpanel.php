<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if (! $_SESSION['admin'])
header('Location: form_auth.php');
 require_once("db_connect.php");
    //Подключение шапки
    require_once("header.php");
    if(isset($_GET['act'])) 
    	{$act = $_GET['act'];} 
    else {$act = 'home';}
		switch($act) {
			case 'home':
				echo "<table class = 'admin'>
						<tr><th>";

					$news_result = $mysqli->query("SELECT * FROM news");
	            	if(mysqli_num_rows($news_result) >= 1) {
	            		echo "<table class = 'admin'>";
	                    while($news_array = mysqli_fetch_array($news_result)) {
	                        echo "<tr>
	                        		<th>".$news_array[0]."</th>
	                       			<th> 
	                       				<a href = '?act=edit_news&id=$news_array[0]'>".$news_array[1]."</a>
	                       			</th>
	                       			<th>".$news_array[3]."</th>
	                       			<th>".$news_array[4]."</th>
	                       			<th><a href = '?act=delete_news&id=$news_array[0]'>Удалить</a></th>
	                       		  </tr>";
	                    }
	                    echo "<tr>
	                    		<th colspan = '5'>
	                    			<a href = '?act=add_news'>Добавить статью</a>
	                    		</th>
	                    	 </tr>";
	                    echo "</table>";
	              	} 
	              	else{
	                   	$news_array= "Статей пока нет";
	              	}
	              	echo "</th>
	              		  <th>";

	             	$documents_result = $mysqli->query("SELECT * FROM documents");
	              	if(mysqli_num_rows($documents_result) >= 1) {
	              		echo "<table class = 'admin'>";
	                    while($documents_array = mysqli_fetch_array($documents_result)) {
	                    	echo "<tr>
	                        		<th>".$documents_array[0]."</th>
	                       			<th> 
	                       				<a href = '?act=edit_documents&id=$documents_array[0]'>".$documents_array[1]."</a>
	                       			</th>
	                       			<th>".$documents_array[3]."</th>
	                       			<th>".$documents_array[4]."</th>
	                       			<th><a href = '?act=delete_documents&id=$documents_array[0]'>Удалить</a></th>
	                       		  </tr>";
	                    }
	                    echo "<tr>
	                    		<th colspan = '5'>
	                    			<a href = '?act=add_documents'>Добавить документ</a>
	                       		</th>
	                    	 </tr>";
	                    echo "</table>";
	                }
	                else{
	                    $documents_array = "Статей пока нет";
	                }
	                echo "</tr><tr><th>";

	                $users_result = $mysqli->query("SELECT users.id, users.email, users.pass, users.name, role.name FROM users LEFT OUTER JOIN role ON role.id = users.role");
	              	if(mysqli_num_rows($users_result) >= 1) {
	              		echo "<table class = 'admin'>";
	                    while($users_array = mysqli_fetch_array($users_result)) {
	                    	echo "<tr>
	                        		<th>".$users_array[0]."</th>
	                       			<th> 
	                       				<a href = '?act=edit_users&id=$users_array[0]'>".$users_array[1]."</a>
	                       			</th>
	                       			<th>".$users_array[3]."</th>
	                       			<th>".$users_array[4]."</th>
	                       			<th><a href = '?act=delete_users&id=$users_array[0]'>Удалить</a></th>
	                       		  </tr>";
	                    }
	                    echo "<tr>
	                    		<th colspan = '5'>
	                    			<a href = '?act=add_users'>Добавить пользователя</a>
	                    			
	                    		</th>
	                    	 </tr></table>";
	                }
	                else{
	                    $users_array = "Статей пока нет";
	                }

	                echo "</th><th> ";
	                $appointment_result = $mysqli->query("SELECT * FROM appointments") or die("appointment");
	              	if(mysqli_num_rows($appointment_result) >= 1) {
	              		echo "<table class = 'admin'>";
	                    while($appointment_array = mysqli_fetch_array($appointment_result)) {

	                    	echo "<tr>
	                        		<th>".$appointment_array[0]."</th>
	                       			<th> 
	                       				<a href = '?act=edit_appointments&id=$appointment_array[0]'>".$appointment_array[1]."</a>
	                       			</th>
	                       			<th>".$appointment_array[3]."</th>
	                       			<th>".$appointment_array[4]."</th>
	                       			<th><a href = '?act=delete_appointments&id=$appointment_array[0]'>Удалить</a></th>
	                       		  </tr>";

	                    	/*echo "<tr><th>".$appointment_array[0]."</th><th>".$appointment_array[1]."</th><th>".$appointment_array[2]."</th><th>".$appointment_array[3]."</th></tr>";*/
	                    }
	                    echo "<tr>
	                    		<th colspan = '5'>
	                    			<a href = '?act=add_appointments'>Добавить обращение</a>
	                    		</th>
	                    	 </tr>";
	                    echo "</table>";
	                }
	                else{
	                    echo "Статей пока нет";
	                }
	                echo "</th></tr>";

	               	echo "<tr><th>";
	               	$kolvo_news = $mysqli->query("SELECT COUNT(*) FROM news");
	               	$kolvo_news = mysqli_fetch_array($kolvo_news);
	               	$kolvo_docs = $mysqli->query("SELECT COUNT(*) FROM documents");
	               	$kolvo_docs = mysqli_fetch_array($kolvo_docs);
	                $advert_result = $mysqli->query("SELECT * FROM advertising");
	                if(mysqli_num_rows($advert_result) >= 1) {
	              		echo "<table class = 'admin'>";
	                    while($advert_array = mysqli_fetch_array($advert_result)) {
	                    	echo "<tr>
	                        		<th>".$advert_array[0]."</th>
	                       			<th> 
	                       				<a href = '?act=edit_advert&id=$advert_array[0]'>".$advert_array[1]."</a>
	                       			</th>
	                       			<th>".$advert_array[2]."</th>
	                       			<th>".$advert_array[3]."</th>
	                       			<th><a href = '?act=delete_advert&id=$advert_array[0]'>Удалить</a></th>
	                       		  </tr>";
	                    }
	                }
	                    echo "<tr>
	                    		<th colspan = '5'>
	                    			<a href = '?act=add_advert'>Добавить пользователя</a>
	                    			
	                    		</th>
	                    	 </tr>";
	                    echo "</table></th>";
	                    echo "<th>Количество новостей на сайте: ".$kolvo_news[0]."<br>
	                    		  Количество документов на сайте: ".$kolvo_docs[0]."<br>";
	                    echo "</th></tr>";
	                echo "</table>";  
				break;
			case 'edit_news':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("SELECT * FROM news WHERE id='$id'") or die("Не выбран id из таблицы");
					if(mysqli_num_rows($result) == 1){
						if(isset($_POST['name']) && isset($_POST['content']) && isset($_POST['direct'])){
							$update = $mysqli->query("UPDATE news SET name='$_POST[name]', 
										 content='$_POST[content]', 
										 direct='$_POST[direct]' 
										 WHERE id='$id'") 
							or die("Не обновлена таблица");
							if($update){
								$result = $mysqli->query("SELECT * FROM news WHERE id='$id'") or die("Не удалось прочитать данные из таблицы");
								$message = "Успешно обновлено!";
							}
						}
					$news = mysqli_fetch_array($result);
					echo "<table class = 'admin'>
								<tr>
									<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='news-form'>
											<b>Название:</b> <input type='text' name='name' value='".$news[1]."'><br>
											<b>Направление:</b> <input type='text' name='direct' value='".$news[2]."'><br>
											<b>Текст:</b> <textarea name='content'>$news[4]</textarea></br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
					}	
				}
				break;
			case 'edit_documents':
				if(isset($_GET['id'])){
					$id = $_GET['id'];

					$result = $mysqli->query("SELECT * FROM documents WHERE id='$id'") or die("Не выбран id из таблицы");
					if(mysqli_num_rows($result) == 1){
						if(isset($_POST['name']) && isset($_POST['content']) && isset($_POST['direct'])){
							$update = $mysqli->query("UPDATE documents SET name='$_POST[name]', 
										 content='$_POST[content]', 
										 direct='$_POST[direct]' 
										 WHERE id='$id'") 
							or die("Не обновлена таблица");
							if($update){
								$result = $mysqli->query("SELECT * FROM documents WHERE id='$id'") or die("Не удалось прочитать данные из таблицы");
								$message = "Успешно обновлено!";
							}
						}
					$documents = mysqli_fetch_array($result);
					echo "<table class = 'admin'>
								<tr>
									<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='documents-form'>
											<b>Название:</b> <input type='text' name='name' value='".$documents[1]."'><br>
											<b>Направление:</b> <input type='text' name='direct' value='".$documents[4]."'><br>
											<b>Текст:</b> <textarea name='content'>$documents[8]</textarea></br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
					}	
				}
				break;
			case 'edit_users':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("SELECT * FROM users WHERE id='$id'") or die("Не выбран id из таблицы");
					if(mysqli_num_rows($result) == 1){
						if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['role'])){
							$update = $mysqli->query(
								"UPDATE users SET name='$_POST[name]', 
										 pass='$_POST[password]', 
										 email='$_POST[email]',
										 role = '$_POST[role]' 
										 WHERE id='$id'") 
							or die("Не обновлена таблица");
							if($update){
								$result = $mysqli->query("SELECT * FROM users WHERE id='$id'") or die("Не удалось прочитать данные из таблицы");
								$message = "Успешно обновлено!";
							}
						}
					$users = mysqli_fetch_array($result);
					echo "<table class = 'admin'>
								<tr>
									<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='users-form'>
											<b>Почта:</b> <input type='text' name='email' value='".$users[1]."'><br>
											<b>Пароль:</b> <input type='text' name='password' value='".$users[2]."'><br>
											<b>Имя:</b> <input type='text' name='name' value='".$users[3]."'><br>
											<b>Роль:</b> <input type='text' name='role' value='".$users[4]."'><br>						
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
					}	
				}
				break;
			case 'edit_appointments':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("SELECT * FROM appointments WHERE id='$id'") or die("Не выбран id из таблицы");
					if(mysqli_num_rows($result) == 1){
						if(isset($_POST['fio']) && isset($_POST['units']) && isset($_POST['text_'])&& isset($_POST['email'])){
							$update = $mysqli->query(
								"UPDATE appointments SET 
										 fio='$_POST[fio]', 
										 units='$_POST[units]', 
										 text_='$_POST[text]',
										 `e-mail` = '$_POST[email]' 
										 WHERE id='$id'") 
							or die("Не обновлена таблица");
							if($update){
								$result = $mysqli->query("SELECT * FROM appointments WHERE id='$id'") or die("Не удалось прочитать данные из таблицы");
								$message = "Успешно обновлено!";
							}
						}
					$appointments = mysqli_fetch_array($result);
					echo "<table class = 'admin'>
								<tr>
									<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='appointments-form'>
											<b>Имярек:</b> <input type='text' name='fio' value='".$appointments[1]."'><br>
											<b>Отдел:</b> <input type='text' name='units' value='".$appointments[2]."'><br>
											<b>Текст:</b> <input type='text' name='text_' value='".$appointments[3]."'><br>
											<b>Почта:</b> <input type='text' name='email' value='".$appointments[4]."'><br>						
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
					}	
				}
				break;
			case 'edit_advert':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("SELECT * FROM advertising WHERE id='$id'") or die("Не выбран id из таблицы");
					if(mysqli_num_rows($result) == 1){
						if(isset($_POST['name']) && isset($_POST['content']) && isset($_POST['date_public'])){
							$update = $mysqli->query("UPDATE advertising SET name='$_POST[name]', 
										 content='$_POST[content]', 
										 date_public='$_POST[date_public]' 
										 WHERE id='$id'") 
							or die("Не обновлена таблица");
							if($update){
								$result = $mysqli->query("SELECT * FROM advertising WHERE id='$id'") or die("Не удалось прочитать данные из таблицы");
								$message = "Успешно обновлено!";
							}
						}
					$advert = mysqli_fetch_array($result);
					echo "<table class = 'admin'>
								<tr>
									<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='advert-form'>
											<b>Название:</b> <input type='text' name='name' value='".$advert[1]."'><br>
											<b>Направление:</b> <input type='data' name='date_public' value='".$advert[2]."'><br>
											<b>Текст:</b> <textarea name='content'>$advert[3]</textarea></br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
					}	
				}
				break;
			case 'add_appointments':
				if(isset($_POST['fio']) && isset($_POST['units']) && isset($_POST['text_'])&& isset($_POST['email'])){
					$user = $_SESSION['id_user'];
					$fio = trim($_POST['fio']);
					$fio = addslashes($fio);
					$email = trim($_POST['email']);
					$email = addslashes($email);
					$text = trim($_POST['text_']);
					$text = addslashes($text);
					$units = trim($_POST['units']);
					$query = "INSERT INTO `appointments` (`id`, `id_user`, `fio`, `units`, `text`, `e-mail`) VALUES (NULL,'".$user."','".$fio."','".$units."','".$text."','".$email."')";
					$result_query_insert = $mysqli->query($query);
					if($result_query_insert) $message = "Успешно добавлено!";
				}
				echo "<table class = 'admin'>
								<tr>
									<a href='?act=home'class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='appointments-form'>
											<b>Имярек:</b> <input type='text' name='fio'><br>
											<b>Отдел:</b> <input type='text' name='units'><br>
											<b>Текст:</b> <input type='text' name='text_'><br>
											<b>Почта:</b> <input type='text' name='email'><br>						
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
				break;
			case 'add_news':
				if(isset($_POST['name']) && isset($_POST['direct']) && isset($_POST['content'])&& isset($_POST['theme']) && isset($_POST['key_words'])){
					$name = trim($_POST['name']);
					$direct = trim($_POST['direct']);
					$content = trim($_POST['content']);
					$theme = trim($_POST['theme']);
					$key_words = trim($_POST['key_words']);
					$date = date("y-m-d");

					$query = "INSERT INTO `news` (`Name`, `Theme`, `Direct`, `Key_words`, `Content`, `date_public`) VALUES('".$name."', '".$theme."','".$direct."', '".$key_words."', '".$content."', '".$date."')";


					$result_query_insert = $mysqli->query($query) or die("ERROR!");
					if($result_query_insert) $message = "Успешно добавлено!";
				}
				echo "<table>
								<tr>
									<a href='?act=home'class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='news-form'>
											<b>Название:</b> <input type='text' name='name'><br>
											<b>Тема:</b> <input type='text' name='theme'><br>
											<b>Направление:</b>
														 <select name = 'direct'>
														 	<option value = 'Социальная сфера'>Социальная сфера</option>
														 	<option value = 'Городская сфера'>Городская сфера</option>
														 </select><br>

											<b>Ключевые слова:</b><input type='text' name='key_words'><br>
											<b>Текст:</b><textarea name='content'></textarea></br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
				
				break;
			case 'add_documents':
				if(isset($_POST['name']) && isset($_POST['direct']) && isset($_POST['content'])&& isset($_POST['theme']) && isset($_POST['key_words'])){
					$name = trim($_POST['name']);
					$direct = trim($_POST['direct']);
					$content = trim($_POST['content']);
					$theme = trim($_POST['theme']);
					$key_words = trim($_POST['key_words']);

					$query = "INSERT INTO `documents` (`Name`, `Key_words`, `Theme`, `Direct`, `Content`) VALUES('".$name."', '".$key_words."', '".$theme."','".$direct."', '".$content."')";


					$result_query_insert = $mysqli->query($query) or die("ERROR!");
					if($result_query_insert) $message = "Успешно добавлено!";
				}#<input type='text' name='direct'><br>
				echo "<table class = 'admin'>
								<tr>
									<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='news-form'>
											<b>Название:</b> <input type='text' name='name'><br>
											<b>Тема:</b> <input type='text' name='theme'><br>
											<b>Направление:</b><select name = 'direct'>
																	<option value = 'Устав города'>Устав города</option>
																	<option value = 'Правила землепользования и застройки города'>Правила землепользования и застройки города</option>
																	<option value = 'Регламент администрации'>Регламент администрации</option>
																	<option value = 'Муниципальные программы города'>Муниципальные программы города</option>
																</select><br>
											<b>Ключевые слова:</b><input type='text' name='key_words'><br>
											<b>Текст:</b><textarea name='content'></textarea></br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
				break;
			case 'add_users':
				if(isset($_POST['name']) && isset($_POST['role']) && isset($_POST['email'])&& isset($_POST['password'])){
					$name = trim($_POST['name']);
					$email = trim($_POST['email']);
					$password = trim($_POST['password']);
					if(!empty($password)){
                		$password = htmlspecialchars($password, ENT_QUOTES);
                     //Шифруем папроль
                    	$password = md5($password."top_secret"); 
                	}
					$role = trim($_POST['role']);
					$query = "INSERT INTO `users` (`email`, `pass`, `name`, `role`) VALUES('".$email."', '".$password."', '".$name."','".$role."')";


					$result_query_insert = $mysqli->query($query) or die("ERROR!");
					if($result_query_insert) $message = "Успешно добавлено!";
				}
				echo "<table class = 'admin'>
								<tr>
									<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='news-form'>
											<b>Логин:</b> <input type='text' name='email'><br>
											<b>Пароль:</b> <input type='text' name='password'><br>
											<b>Имя:</b><input type='text' name='name'><br>
											<select name ='role'>
												<option value = '1'>Администратор</option>
												<option value = '2'>Пользователь</option>
											</select><br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
				break;
			case 'add_advert':
				if(isset($_POST['name']) && isset($_POST['date_public']) && isset($_POST['content'])){
					$name = trim($_POST['name']);
					$date_public = trim($_POST['date_public']);
					$content = trim($_POST['content']);
					
					
					$query = "INSERT INTO `advertising` (`name`, `date_public`, `content`) VALUES('".$name."', '".$date_public."', '".$content."')";


					$result_query_insert = $mysqli->query($query) or die("ERROR!");
					if($result_query_insert) $message = "Успешно добавлено!";
				}
				echo "<table class = 'admin'>
								<tr>
									<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message
								</tr>
								<tr>
									<th>
										<form action = '' method='post' class='news-form'>
											<b>Название:</b> <input type='text' name='name'><br>
											<b>Дата:</b> <input type='date' name='date_public'><br>
											<b>Текст:</b><textarea name='content'></textarea></br>
											<input type='submit' class='button' value='Сохранить'>
										</form>
									</th>
								</tr>
							  </table>";
				break;
			case 'delete_users':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("DELETE FROM `users` WHERE id='".$id."'") or die("Не выбран id из таблицы");
					if($result) $message = "Успешно удалено!";
				}
				else echo "id не получен";
				echo "<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message";
				# code...
				break;
			case 'delete_news':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("DELETE FROM `news` WHERE id='".$id."'") or die("Не выбран id из таблицы");
					if($result) $message = "Успешно удалено!";
				}
				else echo "id не получен";
				echo "<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message";
				# code...
				break;
			case 'delete_documents':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("DELETE FROM `documents` WHERE id='".$id."'") or die("Не выбран id из таблицы");
					if($result) $message = "Успешно удалено!";
				}
				else echo "id не получен";
				echo "<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message";
				# code...
				break;
			case 'delete_appointments':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("DELETE FROM `appointments` WHERE id='".$id."'") or die("Не выбран id из таблицы");
					if($result) $message = "Успешно удалено!";
				}
				else echo "id не получен";
				echo "<a href='?act=home'class = \"go_back\">[Вернуться]</a><br>
									$message";
				# code...
				break;
			case 'delete_advert':
				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$result = $mysqli->query("DELETE FROM `advertising` WHERE id='".$id."'") or die("Не выбран id из таблицы");
					if($result) $message = "Успешно удалено!";
				}
				else echo "id не получен";
				echo "<a href='?act=home' class = \"go_back\">[Вернуться]</a><br>
									$message";
				break;
		}
?>

</main>
<?php
    //Подключение подвала
    require_once("footer.php");
?>