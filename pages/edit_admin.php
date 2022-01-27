<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?add=edit_admin"?>">
    <h3>Make Table</h3>
    User type: <select name="usertype">
        <option selected></option>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
    </select>
    <input type="submit" name="user" value="Select">
</form>

<?php
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $_SESSION["tabledisplay"]=0;
    }

    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(!empty($_POST["usertype"])){ 
                if($_SESSION["tabledisplay"]!=1 || !isset($_SESSION["tabledisplay"])){
                    echo "he";
                    $con=connect_to_database();
                    if($con->connect_error){
                        die("Connction failed");
                    }
                    if(isset($_POST["fname"])){
                        $dir="";  
                        if(!empty($_FILES["pics"]["name"])){
                            $dir="./images/".basename($_FILES["pics"]["name"]);
                            upload_pics($_FILES["pics"]["tmp_name"],$dir);
                        }
                        $updatecmd="UPDATE `users_tb` SET `fname`='".$_POST["fname"]."',`lname`='".$_POST["lname"]."',`dob`='".$_POST["dob"]."',`profile_pic`='".$dir."',`vaccine`='".$_POST["vaccine"]."',`gender`='".$_POST["gender"]."',`address`='".$_POST["address"]."',`country`='".$_POST["country"]."',`position`='".$_POST["position"]."',`user_type`='".$_POST["usertype"]."' WHERE user_id='".$_SESSION["userid"]."'";
                        $result=$con->query($updatecmd);
                    }
                       
                    $select="SELECT * FROM users_tb WHERE user_type='".$_POST["usertype"]."'";
                    $result=$con->query($select);
                    if($result->num_rows>0){
                        if($_POST["usertype"]=="teacher"){
                            echo "<h3>Teachers</h3>";
                        }
                        else{
                            echo "<h3>Students</h3>";
                        }
                        echo "<table>
                        <tr><th>User ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Date of birth</th><th>Profile Picture</th><th>Vaccine</th><th>Gender</th><th>Address</th><th>Country</th><th>Position</th><th>User type</th></tr>
                        ";
                        while($row=$result->fetch_assoc()){
                        
                            echo "<tr><td><a href='".$_SERVER["PHP_SELF"]."?add=edit_admin&form=".$row["user_id"]."'>".$row["user_id"]."</a></td><td>".$row["email"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["dob"]."</td><td>";
                                if(!empty($row["profile_pic"])){
                                    echo "<img style='width:20px; height:20px;' src='".$row["profile_pic"]."'>";
                                }
                            echo "</td><td>".$row["vaccine"]."</td><td>".$row["gender"]."</td><td>".$row["address"]."</td><td>".$row["country"]."</td><td>".$row["position"]."</td><td>".$row["user_type"]."</td></tr>";
                        }    
                        echo "</table>";
                        $_SESSION["tabledisplay"]=0;
                    }
                }
            }
        
    }
?>

<div>
    <?php
        if(isset($_GET["form"])){
            include "pages/edit.admin.form.php";
        }   
       
    ?>
</div>
