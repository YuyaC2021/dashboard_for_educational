    <div id="admin_dash"> <!-- bgcolor-->
        <form method="POST" id="registe_form" action="<?php echo $_SERVER["PHP_SELF"]."?add=register_yuya"?>" enctype="multipart/form-data">
            <div id="contentpage" class><!--Form content-->
                <div id="fistpage" class="regi_pages"> <!--first page-->  
                    <h3>General Information</h3>
                    <div>
                        <div class="form-floating">
                            <label for="floatingid">User ID: </label><br>
                            <input type="number" name="usetid" class="form-control-first required" id="floatingid" placeholder="User ID" required>
                        </div>             
                        <div class="form-floating">
                            <label for="floatingfname">First Name: </label><br>
                            <input type="text" name="fname" class="form-control-first required" id="floatingfname" placeholder="First Name" required>
                        </div>  
                        <div class="form-floating">
                            <label for="floatinglname">Last Name: </label><br>
                            <input type="text" name="lname" class="form-control-first required" id="floatinglname" placeholder="Last Name" required>
                        </div>  
                        <div class="form-floating">
                            <label for="floatingemail">Email: </label><br>
                            <input type="email" name="email" class="form-control-first required" id="floatingemail" placeholder="Email" required>
                        </div>  
                        <div class="form-floating">
                            <label for="floatingPassword">Password: </label><br>
                            <input type="password" name="pass" class="form-control-first required" id="floatingPassword" placeholder="Password" required>
                        </div> 
                      
                    </div> 
                    <div>
                        <span onclick="page_handling(this,1)" class="page_handle_button" style="margin-left:290px;">Next</span>
                    </div>
                </div><!--end first page-->
            
                <div id="secondpage" class="regi_pages"><!--second page-->
                    <h3>General Information</h3>
                    <div>
                        <div class="form-floating">
                            <label for="floatingdob">Date of Birth: </label><br>
                            <input type="date" name="dob" class="form-control-second required" id="floatingdob" required>
                        </div> 
                        <div class="form-floating">
                            <label for="floatingaddress">Address: </label><br>
                            <input type="text" name="address" class="form-control-second required" id="floatingaddress" placeholder="Address" required>
                        </div>  
                        <div class="form-floating">
                            <label for="floatingposition">Position: </label><br>
                            <input type="text" name="position" class="form-control-second required" id="floatingposition" placeholder="Position"  required>
                        </div>
                        <div class="form-floating">
                            <label for="floatingSelect1">User type</label><br>
                            <select id="floatingSelect1" name="usertype" class="form-control-second required" required>
                                <option selected></option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <span onclick="page_handling(this,-1)" class="page_handle_button">Previous</span>
                        <span onclick="page_handling(this,1)" class="page_handle_button">Next</span>
                    </div>
                </div><!--end second page-->

                <div id="thirdpage" class="regi_pages"><!--third page-->
                    <h3>Optional Information</h3>
                    <div>
                        <div class="form-floating">
                            <label for="floatingSelect3">Gender</label><br>
                            <select class="form-select" name="gender" id="floatingSelect3">
                                <option selected></option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="deny2">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="form-floating">
                            <label for="floatingcountry">Country: </label><br>
                            <input type="text" name="country" class="form-select" id="floatingcountry" placeholder="Country">
                        </div>
                        <div class="form-floating">
                            <label for="floatingpropic">Profile picture: </label><br>
                            <input style="width:280px;" name="pics" class="form-select" type="file" id="floatingpropic" placeholder="Profile picture">
                        </div>
                        <div class="form-floating">
                            <label for="floatingSelect2">Vaccinated</label><br>
                            <select class="form-select" name="vaccine" id="floatingSelect2">
                                <option selected></option>
                                <option value="full">Full vaccinated</option>
                                <option value="one">One dose</option>
                                <option value="deny">Prefer not to say</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <span onclick="page_handling(this,-1)" class="page_handle_button">Previous</span>
                        <span onclick="page_handling(this,1)" class="page_handle_button">Review</span>
                    </div>
                </div><!--end third page--> 
                <input id="submiting" type="submit" name="submit" 
                style=" background-color: rgba(128, 128, 128, 0.527);
                padding: 5px 10px;
                margin-top:20px;
                font-size: 18px;
                border: none;
                outline: none;
                width:60%;
                margin-left:20%;
                ">
            </div><!--end Form content-->
        </form>
    </div><!-- end bgcolor-->

    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            try{
                if(!empty($_POST["usetid"]) && !empty($_POST["fname"]) && !empty($_POST["lname"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["dob"]) && !empty($_POST["position"]) && !empty($_POST["usertype"]) && !empty($_POST["address"])){
                    $con=connect_to_database();
                    if($con->connect_error){
                        throw new Exception("Connection failed",0);
                    }
                    $selectcmd="SELECT * FROM users_tb where email='".$_POST["email"]."' OR user_id='".$_POST["usetid"]."'";
                    $result=$con->query($selectcmd);
                    if($result->num_rows>0){
                        echo "<p>Already exist username or user id</p>";
                    }
                    else{
                        //need to change
                        if(isset($_FILES["pics"]["name"])){
                            $dir="./profile_pictures/".basename($_FILES["pics"]["name"]);
                            upload_pics($_FILES["pics"]["tmp_name"],$dir);
                        }
                       

                        $salt=random_number();
                        $tmp=md5($_POST["pass"].$salt);
                        $insert=$con->prepare("INSERT INTO users_tb (user_id,email,password,fname,lname,dob,profile_pic,vaccine,gender,address,country,position,salt,user_type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $insert->bind_param("isssssssssssss",$_POST["usetid"],$_POST["email"],$tmp,$_POST["fname"],$_POST["lname"],$_POST["dob"],$dir,$_POST["vaccine"],$_POST["gender"],$_POST["address"],$_POST["country"],$_POST["position"],$salt,$_POST["usertype"]);
                        $insert->execute();
                        echo "done";

                        $insert->close();
                        $con->close();
                        
                    }

                }
                else{
                    echo "<p>Please fill out General Information</p>";
                }
            }catch(Exception $ex){
                echo "Error code: ".$ex->getCode()."<br>".$ex->getMessage();
            } 
        }
    ?>

<script>
    $("#submiting").hide();
    $(".regi_pages").hide();
    $("#fistpage").show();
    var pagecount=0;
    function page_handling(event,count){
        let checkcount=0;
            if(event==$(".page_handle_button")[0]){
                console.log("first");
                for(let i=0;i<$(".form-control-first").length;i++){
                    if($(".form-control-first")[i].value==""){
                        checkcount++;
                        $(".form-control-first")[i].style.border="1px solid red";
                    }
                    else{
                        $(".form-control-first")[i].style.border="1px solid rgba(131, 197, 111, 1.000)";
                    }
                }
            }
            else if(event==$(".page_handle_button")[2]){
                console.log("second");
                for(let i=0;i<$(".form-control-second").length;i++){
                    if($(".form-control-second")[i].value==""){
                        checkcount++;
                        $(".form-control-second")[i].style.border="1px solid red";
                    }
                    else{
                        $(".form-control-second")[i].style.border="1px solid green";
                    }
                }
            }  
            if(checkcount==0){
                pagecount+=count;
                $(".regi_pages").hide();
                $("#submiting").hide();
                if(pagecount==0){
                    console.log(pagecount);
                    $("#fistpage").show();                    
                }
                else if(pagecount==1){
                    console.log(pagecount);
                    $("#secondpage").show();     
                }
                else if(pagecount==2){
                    console.log(pagecount);
                    $("#thirdpage").show();  
                }
                else{
                    $(".page_handle_button").hide();
                    $(".regi_pages").show();
                    $("#submiting").show();
                      
                }
            }
        }
</script>
