<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type='text/css' href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Bug Report</title>
</head>

<body>
    <?php include "navbar.php"; ?>
    <h1>BUG REPORT</h1>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="cal">Bug_id</th>
                <th scope="cal">Bug_title</th>
                <th scope="cal">Bug_project</th>
                <th scope="cal">Bug_status</th>
                <th scope="cal">Bug_priority</th>
                <th scope="cal">Bug_type</th>
                <th scope="cal">Assigned_user</th>
                <th scope="cal">Created_user</th>
                <th scope="cal">Created_date</th>
                <th scope="cal">Resolved_date</th>
                <th scope="cal">Description</th>
                <th scope="cal">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            include "config.php";
            //prepare a sql SELECT statement 
            $sql = 'SELECT * FROM my_bugs';
            $result = $mysqli->query($sql);
            $b1 = "EDIT";
            $b2 = "DELETE";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['bug_id'] . "</td><td>" . $row['bug_title'] . "</td><td>" . $row['bug_project'] . "</td><td>" .
                        $row['bug_status'] . "</td><td>" . $row['bug_priority'] . "</td><td>" . $row['bug_type'] . "</td><td>" . $row['bug_assigned_to'] . "</td><td>" . $row['bug_created_by'] . "</td><td>" . $row['created_date'] . "</td><td>" . $row['resolved_date'] . "</td><td>" . $row['description'] . "</td><td>" . "<a href='edit.php'> EDIT </a>" . '<&nbsp>' . "<a href='delete.php'> DELETE </a>" . "</td></tr>";
                }
            } else {
                echo "no data found in respective table";
            }
            ?>
        </tbody>
    </table>

    <?php include "footer.php"; ?>
</body>

</html>