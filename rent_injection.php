<?php

    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'rental_car');
    
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if(mysqli_connect_errno()){
        echo "Failed to connect to Mysql : " . mysqli_connect_errno();
    }

    $gid = $_GET['id'];

    $query = "SELECT * FROM rent WHERE per_id = $gid ";
            
    $sql = mysqli_query($conn, $query);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rent-sql injection</title>
</head>
<body>
    <h1>My Rent History</h1>
    <?php while($res = mysqli_fetch_object($sql)):?>
        <p>ID : <?php echo $res->rent_id ?></p>
    <p>Car sign : <?php echo $res->car_sign ?></p>
    <p>Pick Up Date : <?php echo $res->pickup_date ?></p>
    <p>Return Date: <?php echo $res->return_date ?></p>
    <p>Person ID : <?php echo $res->per_id ?></p>

    
    
    <?php endwhile;?>
</body>
</html>