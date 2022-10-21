<?php

    $host = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "rental_car";

    $dsn = "mysql:host=$host;dbname=$dbname";

    try{
        $dbcon = new PDO($dsn, $username, $pass);
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Failed to connect database." . $e->getMessage();
    }

    // $var = $_GET['id'];
    // $sql = "SELECT * FROM car WHERE per_id = $var";
    // $stmt = $dbcon->query($sql);
    // echo"<pre>";
    // print_r($stmt->fetchAll());
    // echo "</pre>";

    $var = $_GET['id'];
    $sql = "SELECT * FROM car WHERE per_id = ?";
    $stmt = $dbcon->prepare($sql);
    $stmt->execute(array($var));
    $row = $stmt->fetchAll(PDO::FETCH_OBJ);
    
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
        
    <h1>My Car</h1>
    <?php if ($stmt->rowCount() > 0) {
            foreach($row as $res){
    ?>
    <p>ID : <?php echo $res->car_id ?></p>
    <p>Car sign : <?php echo $res->car_sign ?></p>
    <p>Model : <?php echo $res->car_model ?></p>
    <p>Brand : <?php echo $res->car_brand ?></p>
    <p>Person ID : <?php echo $res->per_id ?></p>

    
    
    <?php   }
        }else{
            echo "None";
        } ?>
</body>
</html>