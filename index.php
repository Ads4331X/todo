<?php include 'data.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<h1>My Todo's</h1>
<form action="save.php" method="post">
    <div id="head">
        <br>
        <label style="color: wheat;
          font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            Add a task</label>
        <input type="text" placeholder="Enter a task" id="task" name="task">
        <input type="submit" id="Submit" onclick="submit()">
    </div>

</form>
<form method="post">
    <ul start="1">
        <?php
        $i = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $is_completed = $row["status"] ? "Completed" : "Pending";
                $completed_class = $row['status'] ? 'completed' : '';
                $status_text =  $row["status"] ? "<i class='fa-regular fa-circle-check'></i>" : "<i class='fa-regular fa-circle'></i>";
                echo "<li class='todo-item'><div>
                $i &nbsp;&nbsp; <span class='task $completed_class'>{$row['task']}
                </span> </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div>
                        <a class='status-icon' name='completed' id='Submit' value='completed' href='?completed_id={$row['id']}&status={$row['status']}'>$status_text</a>
                        <a class='Delete' name='Delete' id='Submit' value='Delete' href='?delete_id={$row['id']}'>Delete</a>
                        </div>
                    </li>";
                $i++;
            }
        } else {
            echo "0 results";
        }
        ?>
    </ul>
</form>
</body>
<?php

if (isset($_GET['completed_id'])) {
    echo "<h1>hello world</h1>";
    $id = $_GET["completed_id"];
    $status = $_GET["status"];
    $new_status =  $status === '1' ? 0 : 1;
    $update_task = "update todotable
    set status = $new_status where id = '$id'";
    mysqli_query($conn, $update_task);
    header("Location: index.php");
    exit();
}

if (isset($_GET['delete_id'])) {
    $id = $_GET["delete_id"];
    $del_data = "delete from todotable where id = '$id'";
    mysqli_query($conn, $del_data);
    header("Location: index.php");
    exit();
}
?>


</html>