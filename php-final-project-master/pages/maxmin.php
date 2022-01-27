<!-- Naoki -->
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF']."maxmin"?>">
            <label for="stuName">Student Name</label>
            <input type="text" name="stuName">
            <button type="submit">Chose</button>
        </form>
        <table>
            <tr>
                <th>Course name</th>
                <th>Teacher name</th>
                <th>Maximum number of student</th>
                <th>Minimum number of student</th>
            </tr>
        </table>
    </div>
<?php
    // from here take the data from database and show it
?>
