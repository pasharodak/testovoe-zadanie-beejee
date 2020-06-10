<?php           
                    if(isset($_POST["send"])){
                        $login = $_POST["login"];
                        $password = $_POST["password"];
                        $mysqli = new mysqli("localhost", "u82132_admin", "7be-2KA-3Fv-JmA","u82132_testovoe");
                        $mysqli->query("SET NAMES 'utf8'");
                        $result_set = $mysqli-> query("SELECT * FROM `admin` where `login` = '$login' and `password` = '$password';");
                        $result = $result_set->fetch_assoc();
                        $error = "";
                        if($result){
                            setcookie('login',$login,time()+3600,'/');
                            header("Location: /");
                        }else{
                            $error = "Неправильный логин или пароль";
                        }

                        $mysqli->close();
                    }
                    if(isset($_POST["end"])){
                        setcookie('login',"",time()-3600,'/');
                       
                    }

        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <?php include("blocks/header.php");    ?>

                        

          
     <div class="container">            
    <?php if(!$_COOKIE["login"]):?>
   
        <form action="" method="post" >
            <h1 class="mt-2">Войти</h1>
            <h2> <?=$error?></h2>
            <input type="text" name="login" id="" class="form-control mt-3 " placeholder="Введите ваш логин"><span></span>
            <input type="password" name="password" id="phone" class="form-control mt-3" placeholder="Введите пароль"><span></span>
            <input type="submit" name="send" class="btn btn-success mt-3" value="Войти">
        </form>

    <?php endif;?>
    <?php         include("blocks/footer.php")?>
    </div>
</body>
</html>