
    <?php
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            //$_SESSION["formdisplay"]=1; 
            $con=connect_to_database();
            if($con->connect_error){
                die("Connection failed");
            }   
            $select="SELECT * FROM users_tb WHERE user_id='".$_GET["form"]."'";   
            $result=$con->query($select);
            if($result->num_rows==1){
                while($row=$result->fetch_assoc()){
                    $userid=$row["user_id"];
                    $email=$row["email"];
                    $fname=$row["fname"];
                    $lname=$row["lname"];
                    $dob=$row["dob"];
                    $profile_pic=$row["profile_pic"];
                    $vaccine=$row["vaccine"];
                    $gender=$row["gender"];
                    $address=$row["address"];
                    $country=$row["country"];
                    $position=$row["position"];
                    $user_type=$row["user_type"];
                }
                $_SESSION["userid"]=$userid;//take user id for condition for command
            }     
            $con->close(); 
            $inputvalue=1; //for input value
            //$_SESSION["tabledisplay"]=0;
        }
        // if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["edit"]=="Edit"){            
        //     $con=connect_to_database();
        //     if($con->connect_error){
        //         die("Connection failed");
        //     }
        //     //$_SESSION["tabledisplay"]=1;
        //     $dir="";  
        //     if(!empty($_FILES["pics"]["name"])){
        //         $dir="./images/".basename($_FILES["pics"]["name"]);
        //         upload_pics($_FILES["pics"]["tmp_name"],$dir);
        //     }
        //     $updatecmd="UPDATE `users_tb` SET `fname`='".$_POST["fname"]."',`lname`='".$_POST["lname"]."',`dob`='".$_POST["dob"]."',`profile_pic`='".$dir."',`vaccine`='".$_POST["vaccine"]."',`gender`='".$_POST["gender"]."',`address`='".$_POST["address"]."',`country`='".$_POST["country"]."',`position`='".$_POST["position"]."',`user_type`='".$_POST["usertype"]."' WHERE user_id='".$_SESSION["userid"]."'";
        //     $result=$con->query($updatecmd);
        //     // $select="SELECT * FROM users_tb WHERE user_type='".$_POST["usertype"]."'";
        //     // $result=$con->query($select);
        //     // if($result->num_rows>0){
        //     //     echo "<table><tr><th>User ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Date of birth</th><th>Profile Picture</th><th>Vaccine</th><th>Gender</th><th>Address</th><th>Country</th><th>Position</th><th>User type</th></tr>";
        //     //     while($row=$result->fetch_assoc()){
        //     //         echo "<tr><td><a href='".$_SERVER["PHP_SELF"]."?add=edit_admin&form=".$row["user_id"]."'>".$row["user_id"]."</a></td><td>".$row["email"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["dob"]."</td><td>";
        //     //             if(!empty($row["profile_pic"])){
        //     //                 echo "<img style='width:20px; height:20px;' src='".$row["profile_pic"]."'>";
        //     //             }
        //     //         echo "</td><td>".$row["vaccine"]."</td><td>".$row["gender"]."</td><td>".$row["address"]."</td><td>".$row["country"]."</td><td>".$row["position"]."</td><td>".$row["user_type"]."</td></tr>";
        //     //     }    
        //     //     echo "</table>";
        //     // }
        //     // echo "done";
        //     $con->close(); 
        //     $inputvalue=0;
        // }
        ?>
        
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?add=edit_admin&form=".$_SESSION["userid"].""?>" enctype="multipart/form-data"> 
                    <div>
                        <div>
                            <label for="floatingid">User ID: </label><br>
                            <input value="<?php if($inputvalue==1){echo $userid;}?>" type="number" name="userid" id="floatingid" placeholder="User ID" disabled>
                        </div>  
                        <div>
                            <label for="floatingemail">Email: </label><br>
                            <input value="<?php if($inputvalue==1){echo $email;}?>" type="email" name="email"  id="floatingemail" placeholder="Email" required>
                        </div>             
                        <div>
                            <label for="floatingfname">First Name: </label><br>
                            <input value="<?php if($inputvalue==1){echo $fname;}?>" type="text" name="fname"  id="floatingfname" placeholder="First Name" required>
                        </div>  
                        <div>
                            <label for="floatinglname">Last Name: </label><br>
                            <input value="<?php if($inputvalue==1){echo $lname;}?>" type="text" name="lname"  id="floatinglname" placeholder="Last Name" required>
                        </div>  
                        <div>
                            <label for="floatingdob">Date of Birth: </label><br>
                            <input value="<?php if($inputvalue==1){echo $dob;}?>" type="date" name="dob"  id="floatingdob" required>
                        </div> 
                        <div>
                            <label for="floatingpropic">Profile picture: </label><br>
                            <input value="<?php if($inputvalue==1){echo $profile_pic;}?>" style="width:280px;" name="pics" type="file" id="floatingpropic" placeholder="Profile picture">
                        </div>
                        
                        <div>
                            <label for="floatingSelect2">Vaccine</label><br>
                            <select name="vaccine" id="floatingSelect2" required>
                                <option selected></option>
                                <option value="full">Full vaccinated</option>
                                <option value="one">One dose</option>
                                <option value="deny">Prefer not to say</option>
                            </select>
                        </div>
                        <div>
                            <label for="floatingSelect3">Gender</label><br>
                            <select name="gender" id="floatingSelect3" required>
                                <option selected></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="deny">Prefer not to say</option>
                            </select>
                        </div>
                        <div>
                            <label for="floatingaddress">Address: </label><br>
                            <input value="<?php if($inputvalue==1){echo $address;}?>" type="text" name="address"  id="floatingaddress" placeholder="Address" required>
                        </div>  
                        <div>
                            <label for="floatingcountry">Country: </label><br>
                            <input value="<?php if($inputvalue==1){echo $country;}?>" type="text" name="country"  id="floatingcountry" placeholder="Country">
                        </div>
                        <div>
                            <label for="floatingposition">Position: </label><br>
                            <input value="<?php if($inputvalue==1){echo $position;}?>" type="text" name="position" id="floatingposition" placeholder="Position"  required>
                        </div>
                        <div>
                            <label for="floatingSelect1">User type</label><br>
                            <select id="floatingSelect1" name="usertype" required >
                                <option selected></option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                    </div>
                
                <input id="submiting" type="submit" name="edit" value="Edit">
        </form>