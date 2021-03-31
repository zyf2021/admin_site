<?php
    //Запускаем сессию
    session_start();
 
    //Добавляем файл подключения к БД
    require_once("db_connect.php");
 
    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
    $_SESSION["error_messages"] = '';
 
    //Объявляем ячейку для добавления успешных сообщений
    $_SESSION["success_messages"] = '';

    /*
        Проверяем была ли отправлена форма, то есть была ли нажата кнопка зарегистрироваться. Если да, то идём дальше, если нет, значит пользователь зашёл на эту страницу напрямую. В этом случае выводим ему сообщение об ошибке.
    */
    if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){
    	if(isset($_POST["name"])){
    		$name = trim($_POST["name"]);
    	}
    	if(isset($_POST["email"])){
            //Обрезаем пробелы с начала и с конца строки
            $email = trim($_POST["email"]);
            if (!empty($email)){
            	$email = htmlspecialchars($email, ENT_QUOTES);
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
                 if( !preg_match($reg_email, $email)){
                    // Сохраняем в сессию сообщение об ошибке. 
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный email</p>";
                    //Возвращаем пользователя на страницу авторизации
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/form_auth.php");
                    //Останавливаем скрипт
                    exit();
        }
            }
            //Проверяем нет ли уже такого адреса в БД.
            $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'") or die("ERROR!");
            $user = $result_query->fetch_assoc();
            if(!empty($user)){
            	$_SESSION["error_messages"] .= "<p class='mesage_error' >Пользователь с таким почтовым адресом уже зарегистрирован</p>";
            	//Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");
                exit();
            }           
        }   
        if(isset($_POST["password"])){
                //Обрезаем пробелы с начала и с конца строки
                $password = trim($_POST["password"]);
                if(!empty($password)){
                	$password = htmlspecialchars($password, ENT_QUOTES);
                    //Шифруем папроль
                    $password = md5($password."top_secret"); 
                }
            }

            //echo $name, " ", $email, " ", $password;
                    //Запрос на добавления пользователя в БД
        $result_query_insert = $mysqli->query("INSERT INTO `users` (`email`, `pass`, `name`) VALUES ('".$email."', '".$password."', '".$name."')");

       	if(!$result_query_insert){
                // Сохраняем в сессию сообщение об ошибке. 
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на добавления пользователя в БД</p>";
                
                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_register.php");
                //Останавливаем  скрипт
                exit();
            }else{
            	$_SESSION["success_messages"] = "<p class='success_message'>Регистрация прошла успешно!!! <br />Теперь Вы можете авторизоваться используя Ваш логин и пароль.</p>";
                //Отправляем пользователя на страницу авторизации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."/form_auth.php");
            }
            /* Завершение запроса */
            $result_query_insert->close();
            //Закрываем подключение к БД
            $mysqli->close();        
    }else {
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Перенаправление на страницу регистрации</p>";
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_register.php");
        exit();
    }


?>