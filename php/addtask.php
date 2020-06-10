<?php
if(isset($_POST["add"])){

   
    $name = trim($_POST["name"]);
    $email =trim( $_POST["email"]);
    $text = trim($_POST["text"]);
    $errors = false;
    if($name == ""){
        $error1 = "Введите ваше имя";
        $errors = true;
    }else if(!preg_match("/[0-9a-z_\.\-]+@[0-9a-z_\.\-]+\.[a-z]{2,4}/i", $email)){
        $error2 = "Введите корректный mail";
        $errors = true;
    }else if($text == ""){
        $error3 = "Введите задачу";
        $errors = true;
    }
    if($errors == false){
        $mysqli = new mysqli("localhost", "u82132_admin", "7be-2KA-3Fv-JmA","u82132_testovoe");
    $mysqli->query("SET NAMES 'utf8'");
    $result_set = $mysqli-> query("INSERT INTO `task_list` (`name_user`,`email`,`text`) VALUES ('$name','$email','$text');");
    $mysqli->close();
    header("Location: /");
    }else{
        echo $error1."<br>";
        echo $error2."<br>";
        echo $error3."<br>";
    }

}

?>

<a href="/"> Вернуться</a>