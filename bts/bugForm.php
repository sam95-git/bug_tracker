<?php

//include config file
require_once 'config.php';

//define varibales and initialize with empty values 

$bug_id = $bugTitle = $bugProjectName = $bugStatus = $bugPriority = $bugType = $description = $assignedUser = $createdUser = $createdDate = $resolvedDate = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    //prepare a insert statement 
    $sql = 'INSERT INTO my_bugs (bug_id, bug_title, bug_project, bug_status, bug_priority, bug_type, bug_assigned_to, bug_created_by, created_date, resolved_date, description)
            VALUES (?,?,?,?,?,?,?,?,?,?,?)';

    if ($stmt = mysqli_prepare($mysqli, $sql)) {
        //bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, 'issssssssss', $bug_id, $bugTitle, $bugProjectName, $bugStatus, $bugPriority, $bugType, $assignedUser, $createdUser, $createdDate, $resolvedDate, $description);
        $bug_id = null;
        $bugTitle = trim($_POST['bug_title']);
        $bugProjectName = trim($_POST['bug_project_name']);
        $bugStatus = trim($_POST['bug_Status']);
        $bugPriority = trim($_POST['bug_priority']);
        $bugType = trim($_POST['bug_type']);
        $assignedUser = trim($_POST['assigned_user_name']);
        $createdUser = trim($_POST['created_user_name']);
        $createdDate = trim(date('Y-m-d'));
        $resolvedDate = null;
        $description = trim($_POST['bug_desc']);
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to home page
            header("location: bugReport.php");
        } else {
            echo "statement execution failed";
        }

        //close statement
        mysqli_stmt_close($stmt);
    }
    //close connection
    mysqli_close($mysqli);
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type='text/css' href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type='text/css' href="custom.css">
    <title>Add bug Page</title>
</head>

<body>
    <?php include "navbar.php"; ?>
    <h1>ADD BUG</h1>
    <form id="Bugform" action="bugForm.php" method="POST">

        <div class="form-group">
            <label for="bug_title">Bug Title</label>
            <input type="text" class="form-control" name="bug_title" id="bug_title">
        </div>

        <?php
        $projectNames = $mysqli->query("SELECT project_title FROM my_projects");
        ?>

        <div class="form-group">
            <label for="bug_project_name">Bug Project name</label>
            <select type="text" class="form-control" id="bug_project_name" name="bug_project_name">
                <?php
                while ($rows = $projectNames->fetch_assoc()) {
                    $prj_name = $rows['project_title'];
                    echo "<option value='$prj_name'>$prj_name</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="bug_Status">Bug Status</label>
            <select type="text" class="form-control" id="bug_Status" name="bug_Status">
                <option>New</option>
                <option>Open</option>
                <option>Assign</option>
                <option>Test</option>
                <option>Verified</option>
                <option>Closed</option>
            </select>
        </div>
        <div class="form-group">
            <label for="bug_priority">Bug priority</label>

            <select type="text" class="form-control" id="bug_priority" name="bug_priority">
                <option>Important</option>
                <option>Very Important</option>
                <option>Urgent</option>

            </select>
        </div>
        <div class="form-group">
            <label for="bug_type">Bug Type</label>
            <select type="text" class="form-control" id="bug_type" name="bug_type">

                <!-- This is a broad type of error that happens whenever software doesn’t behave as intended -->
                <option>Functional</option>
                <!-- A syntax error occurs in the source code of a program when there are one or more missing or incorrect characters in the code. -->
                <option>Syntax</option>
                <!-- A logic error represents a mistake in the software flow and causes the software to behave incorrectly.-->
                <option>Logical</option>
                <!-- Anytime software returns an incorrect value — whether it’s one the end user sees or one that’s passed to another program — that’s a calculation error -->
                <option>Calculation</option>
                <!-- After your software is initially coded, you need to see how it works through unit testing — taking a small,
                 logical section of code and verifying that it performs as designed. This is where various bugs are often uncovered and called unit test bugs.-->
                <option>Unit level</option>
                <!-- This type of bug occurs when two or more pieces of software from separate subsystems interact erroneously. -->
                <option>System level</option>
                <!-- these types of software bugs show up when the end user interacts with the software in ways that weren’t expected.
                 This often occurs when the user sets a parameter outside the limits of intended use, such as entering a significantly 
                 larger or smaller number than coded for or inputting an unexpected data type, like text where a number should be. -->
                <option>Out of bounds</option>

            </select>
        </div>

        <?php
        $userNames = $mysqli->query("SELECT user_name FROM my_user");
        ?>
        <div class="form-group">
            <label for="assigned_user_name">Assigned User Name</label>
            <select type="text" class="form-control" id="assigned_user_name" name="assigned_user_name">
                <?php
                while ($rows = $userNames->fetch_assoc()) {
                    $usr_name = $rows['user_name'];
                    echo "<option value='$usr_name'>$usr_name</option>";
                }
                ?>
            </select>
        </div>
        <?php
        $userNames = $mysqli->query("SELECT user_name FROM my_user");
        ?>
        <div class="form-group">
            <label for="created_user_name">Created User Name</label>
            <select type="text" class="form-control" id="created_user_name" name="created_user_name">
                <?php
                while ($rows = $userNames->fetch_assoc()) {
                    $usr_name = $rows['user_name'];
                    echo "<option value='$usr_name'>$usr_name</option>";
                }
                ?>
            </select>
        </div>
        <!--  <div class="form-group">
            <label for="bug_c_date">Bug Created Date</label>
            <input type="date" class="form-control" name="bug_c_date" id="bug_c_date">
        </div>
        <div class="form-group">
            <label for="bug_r_date">Bug Resolved Date</label>
            <input type="date" class="form-control" name="bug_r_date" id="bug_r_date">
        </div>-->
        <div class="form-group">
            <label for="bug_desc">Bug Description</label>
            <textarea class="form-control" name="bug_desc" rows="3" id="bug_desc"></textarea>
        </div>
        <div class="btn">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <?php
    include "footer.php";
    ?>
</body>

</html>