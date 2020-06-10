
<?php
    $mysqli = new mysqli("localhost", "u82132_admin", "7be-2KA-3Fv-JmA","u82132_testovoe");
    $mysqli->query("SET NAMES 'utf8'");
    if(isset($_POST["change"])){
        $id = $_POST["send"];
        $text = $_POST["text"];
        $status = $_POST["status"];
        if($status == true){
            $status = 1;
        }else if($status == false){
            $status = 0;
        }
        $result_set = $mysqli-> query("UPDATE `task_list` SET `text`='$text', `status`= '$status'  WHERE `id`='$id' ");
        $error = "Изменено";
    }
    $id = $_POST["send"];
    $result_set = $mysqli-> query("SELECT * FROM `task_list` WHERE `id` = '$id';");
    $result = $result_set->fetch_assoc();
    $text = $result["text"];
    $name = $result["name_user"];
    $email = $result["email"];
    $status = $result["status"];
    if($status != 0){
         $checked='checked="checked"';
    }
    
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменить задачу</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/changeTask.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <?php include("blocks/header.php");    ?>
    <?php if($_COOKIE['login']):?>
    <div class="container">
        <h2><?= $error?></h2>
        <form action="" method="post" >
            <h4 class="my-0 font-weight-normal" name="name"><?= $name?></h4>
            <p name="email"><?=$email ?></p>
            <input type="text" class="form-contol mt-3 file" name="text" value="<?= $text ?>"><br>
            <p><input type="checkbox" name="status" <?= $checked?>> отметить как выполненное</p>
            <input type="submit" class="btn btn-success" name="change" value="изменить">
            <input style="display: none;" name="send" value="<?=$id?>">
        </form>
        
    </div>
    <?php endif;?>
 


    <?php         include("blocks/footer.php")?>
</body>
</html>