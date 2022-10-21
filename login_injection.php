<?php
    if (isset($_POST['username'])) {
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

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `customer` WHERE per_name = :username AND per_pass = :password";
        $stmt = $dbcon->prepare($sql);
        $stmt->execute(array(":username" => $username, ":password" => $password));
        $row = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($stmt->rowCount() == 1) {
            foreach($row as $res){
                if ($res->role == 'admin') {
                    echo "<script>window.location.href='admin_page.php'</script>";
                }
            }
        } else {
            echo "Username or Password went wrong!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Log in - injection</title>
</head>
<body>
    <style>
        *{
            margin: 0; 
            padding: 0; 
            box-sizing: border-box;
        }
    </style>
    
    <div class="m-5 p-4 shadow-lg">
         <h3 class="my-3 text-center">Log in</h3>
        <hr>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label class="form-label">username</label>
            <input type="text" name="username"  class="form-control rounded-pill"  placeholder="Enter your username">
            <br>

            <label class="form-label">Password</label>
            <input type="text" name="password" class="form-control rounded-pill" placeholder="Enter your password">
            <br>

            <button type="submit" name="submit" class=" rounded-pill btn btn-warning">Login</button>
                    <!-- <a href="index.php" class="container rounded-pill btn btn-dark my-2">Back</a> -->
        </form>
    </div>
</body>
</html>