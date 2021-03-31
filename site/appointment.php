<?php
    //Запускаем сессию
    session_start();
 
    //Добавляем файл подключения к БД
    require_once("db_connect.php");
 
    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
    $_SESSION["error_messages"] = '';
 
    //Объявляем ячейку для добавления успешных сообщений
    $_SESSION["success_messages"] = '';


	
	if (!isset($_POST['last_name'])||
		!isset($_POST['first_name'])||
		!isset($_POST['middle_name'])||
		!isset($_POST['email'])||
		!isset($_POST['text'])){
			$_SESSION["error_messages"] = "<p class='mesage_error' >Не все данные введены.<br> Пожалуйста, вернитесь назад и закончите ввод</p>";
			//Возвращаем пользователя на страницу обращения
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_appointment.php");
            exit();
	}
    $user = $_SESSION['id_user'];
    #echo $user;
	$fio = trim($_POST['last_name']);
	$fio = addslashes($fio);
	$email = trim($_POST['email']);
	$email = addslashes($email);
	$text = trim($_POST['text']);
	$text = addslashes($text);
	$units = trim($_POST['depart']);

    //mysqli_select_db($link, $db) or die("Невозможно открыть $db");

	$query = "INSERT INTO `appointments` (`id`, `id_user`, `fio`, `units`, `text`, `e-mail`) VALUES (NULL,'".$user."','".$fio."','".$units."','".$text."','".$email."')";
	$result_query_insert = $mysqli->query($query);
    //($reslt = mysqli_query($link, $query ); 
    if(!$result_query_insert) {
    	$_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на добавления обращения в БД</p>";
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_appointment.php");
                //Останавливаем  скрипт
                exit();
    }
    	else{
				$_SESSION["success_messages"] = "<p class='success_message'>Обращение отправлено!</p>";
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_appointment.php");
    	}
    $result_query_insert->close();
    $mysqli->close();

?>

