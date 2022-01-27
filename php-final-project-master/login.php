<?php
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./stylesheet/reset.css"> -->
    <style>
        <?php
            include('./stylesheet/login.css');
        ?>
    </style>
    <title>Login page</title>
</head>
<body>
    
<header>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="main-header">
        <h1>Login</h1>
        <hr />
        <h3>Welcome to Education </h3>
        <p><input type="text" placeholder="UserId" name="userId"></p>
        <p><input type="password" placeholder="Password" name="pass"></p>
        <p><button>Continue</button></p>
    </form>
</header>
    
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //
        $user_id = $_POST['userId'];
        $pass = $_POST['pass'];
        //connect with database 
        $dbCon = new mysqli("localhost","root","","education");
        $select_cmd = "SELECT salt FROM users_tb WHERE user_id ='".$user_id."'";
        $result = $dbCon->query($select_cmd);
        if ($dbCon->connect_error) {
            echo "<p style='color:red;'>Connection error</p>";
        } else {
            // echo "<p style='color:green;'>Connected to the database</p>";
            // take the data from database and check the type of users
            // $select_cmd = "SELECT * FROM users_tb WHERE user_id='".$user_id."'";
            // if ($user_id == $row['user_id'] && $pass)
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $salt = $row['salt'];
                }    
                $tmpPass = md5($pass.$salt);
                echo $tmpPass;// working
                $select_cmd = "SELECT * FROM users_tb WHERE user_id='".$user_id."' AND password='".$tmpPass."'";
                $result = $dbCon->query($select_cmd);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo $row['fname']." is logged in";
                        header("Location: dashboard.php");
                        exit();
                    }
                }
                // $userType = $row['user_type'];
                // if ($userType == 'admin') {
                //     echo "admin";
                // } elseif ($userType == 'teacher') {
                //     echo "teacher";
                // } else {
                //     echo "student";
                // }

            } else {
                echo "<p style='color:red;'>User ID or password is wrong</p>";
            }
        }
    }
?>
</body>
</html>
