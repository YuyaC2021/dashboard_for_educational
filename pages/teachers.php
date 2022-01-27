<?php
  include('../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      /* margin: 0;
      padding: 0; */
    }
    table, th, td {
      border:1px solid black;
    } 
    td {
      height: 50px;
    }
    input {
      width: 100%;
      height: 100%;
      text-align: center;
    }
    textarea {
      width: 100%;
      height: 100%;
      text-align: center;
    }
  </style>
  <title>Teachers</title>
</head>
<body>
  <h3>Mark page</h3>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
      <label for="stuId">Student ID:</label><br>
      <input type="text" id="course" name="stuId"><br>
      <label for="fname">Course ID</label><br>
      <input type="text" name="course"><br>
      <input type="submit" value="chose" name="chose">Chose</input>
    </form>
    <table style="width:100%">
      <tr>
        <th>Student ID</th>
        <th>Student First Name</th>
        <th>Marks</th>
        <th>Comments</th>
      </tr>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
        <?php
          // ★ couldn't connect to mark_tb so tried to make with another database and change the code later
          // this is just showing data in the table. ★ will add a function to edit the score and comment
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['chose']) {
            try {
              $dbConn = connect_to_database();
              $select_cmd = "SELECT * FROM marks_tb WHERE student_id ='".$_POST['stuId']."AND course_id =".$_POST['course']."'";
              $result = $dbConn->query($select_cmd);
              if ($dbConn->connect_error) {
                throw new Exception('Connection error');
              } else {
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr style='text-align:center;'><td><input value='".$row['student_id']."'></td><td><input value='".$row['fname']."'></td><td><input value='".$row['mark']."' name='mark'></td><td><textarea name='comment'>".$row['comment']."</textarea></td></tr>";
                  }
                } else {
                  echo "<p style='color:red;'>Something went wrong</p>";
                }
              }
              $dbConn->close();  
            } catch (Exception $ex) {
              echo $ex->getMessage();
            }
          }
        ?>
        <input type="submit" value="save" name="save">Save changes</input>
      </form>
    </table>
    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['save']) {
        try {
          $dbConn = connect_to_database();
          $select_cmd = "SELECT * FROM marks_tb WHERE student_id ='".$_POST['stuId']."AND course_id =".$_POST['course']."'";
          $result = $dbConn->query($select_cmd);
          if ($dbConn->connect_error) {
            throw new Exception('Connection error');
          } else {
            $insert_cmd = "UPDATE marks_tb SET mark='100' comment='good' WHERE student_id='111'";
            if ($dbConn->query($insert_cmd)) {
              echo "<p style='color:green;'>Successfully saved</p>";
            } else {
              echo "<p style='color:red;'>Something went wrong</p>";
            }
          }
          $dbConn->close();  
        } catch (Exception $ex) {
          echo $ex->getMessage();
        }

      }
    ?>
</body>
</html>  
  







