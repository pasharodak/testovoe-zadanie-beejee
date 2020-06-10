
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <?php include("blocks/header.php");    ?>



    <div class="container">
        
            <?php  if($_COOKIE['login']):?>
            <h1>Привет, <?= $_COOKIE["login"]?></h1>
            <?php endif?>
            <div class="group-card">
                <?php 
                        $mysqli = new mysqli("localhost", "u82132_admin", "7be-2KA-3Fv-JmA","u82132_testovoe");
                        $mysqli->query("SET NAMES 'utf8'");
                        $count = $mysqli-> query("SELECT COUNT(*) FROM `task_list`;");
                        $row = mysqli_fetch_row($count);
                        $total = $row[0];
                        $result_set = $mysqli-> query("SELECT * FROM `task_list`;");
                ?>
                <?php for($i = 0; $i<=$total+2;$i++):?>
                    <?php  
                        $result = $result_set->fetch_assoc();
                        $name = $result["name_user"];
                        $email = $result["email"];
                        $text = $result["text"];
                        $id = $result["id"];
                        $status = $result["status"];
                        if($status == false){
                            $val = "Не выполненно";
                        }else{
                            $val = "Выполненно";
                        }
                        if($result):
                        ?>
                    
                        <div class="card mb-4 shadow-sm">
                        <form action="/changeTask.php" method="POST">  
                            <div class="card-header"> 
                                <h4 class="my-0 font-weight-normal" name="name"><?= $name?></h4>
                            </div>
                            <div   div class="card-body">
                                <ul class="list-unstyled mt-3 mb-4">
                                <h2 name="text"><?=$text?></h2> 
                                <p name="email"><?=$email ?></p>
                                <h2 name="status"><?=$val?></h2>
                                </ul>
                                <?php if($_COOKIE['login']):?>
                                    <button type="submit" name ="send" class="btn btn-lg btn-block btn-outline-primary" value="<?= $id?>">Изменить</button>
                                    <?php endif;?>
                                </div> 
                        </form>  
                        </div>
                    
                        <?php endif; endfor?>
                        <div class="container">
                            <form action="/php/addtask.php" method="post" class="add-form">
                                    <input type="text" class="form-contol mt-3" placeholder="Введите ваше имя" name="name"><br>
                                    <input type="text" class="form-contol mt-3" placeholder="Введите ваш email" name="email"><br>                       
                                    <input type="text" class="form-contol mt-3" placeholder="Текст задачи" name="text"><br><br>
                                    <input type="submit" class="btn btn-success" name="add" value="Добавить задачу">
                            </form>
                        </div>
                <?php     $mysqli->close();?>
        </div>
    </div>


    <?php         include("blocks/footer.php")?>
</body>
</html>