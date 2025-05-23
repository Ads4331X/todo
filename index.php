<?php include 'data.php';

session_start();
$name = $_SESSION["username"];
$user_id = $_SESSION['user_id'];
echo "<form method ='POST'><div class='Sign_out_right'><button class='Sign_out' name = 'SignOut'>Sign Out</button></div></form>";
echo "<h1 style='text-align: center;'>$name's Todo</h1><br> ";
if ($_SESSION["username"] == "") {
    setcookie("PHPSESSID", "");
    header("Location: form.html");
    exit();
}

if (isset($_POST['SignOut'])) {
    session_destroy();
    setcookie("PHPSESSID", "");
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $position = $_GET["status_position"];
    $status = $_GET["status"];
    $new_status = $status === '1' ? 0 : 1;
    $update_task = "update todotable
    set status = $new_status 
    where position = $position and user_id = $user_id";
    mysqli_query($conn, $update_task);
    header("Location: index.php");
    exit();
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $position = $_GET["delete_position"];
    if ($position == 1) {
        $del_data = "delete from todotable where id = '$id'";
        mysqli_query($conn, $del_data);
        mysqli_query($conn, "UPDATE todotable set position = position - 1 where position > $position and user_id = $user_id");
    } else {
        $del_data = "delete from todotable where id = '$id'";
        $updated_position = "UPDATE todotable set position = position - 1 where position > $position and user_id = $user_id";
        mysqli_query($conn, $updated_position);
        mysqli_query($conn, $del_data);
    }
    header("Location: index.php");
    exit();
}

if (isset($_GET['up_position'])) {
    $position = (int)$_GET['up_position'];
    if ($position > 1) {
        $up_position = $_GET['up_position'] - 1;
        $temp_move_task = "UPDATE todotable SET position = -1 WHERE position = $up_position and user_id = $user_id";
        mysqli_query($conn, $temp_move_task);
        $move_task = "UPDATE todotable SET position = $up_position WHERE position = $position and user_id = $user_id";
        mysqli_query($conn, $move_task);
        $move_task_down = "UPDATE todotable SET position = $position WHERE position = -1 and user_id = $user_id";
        mysqli_query($conn, $move_task_down);
        header("Location: index.php");
        exit();
    }
}

if (isset($_GET['down_position'])) {
    $position = (int)$_GET['down_position'];
    $query = "SELECT max(position) as last_position from todotable where user_id = $user_id ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $max_position = (int)$row['last_position'];
    if ($position < $max_position) {
        $down_position = $_GET['down_position'] + 1;
        $temp_move_task = "UPDATE todotable SET position = -1 WHERE position = $down_position and user_id = $user_id";
        mysqli_query($conn, $temp_move_task);
        $move_task = "UPDATE todotable SET position = $down_position WHERE position = $position and user_id = $user_id";
        mysqli_query($conn, $move_task);
        $move_task_down = "UPDATE todotable SET position = $position WHERE position = -1 and user_id = $user_id";
        mysqli_query($conn, $move_task_down);
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>ToDo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<form action="save.php" method="post">
    <div id="head">
        <span class="centerinput">
            <br>
            <label style="color: wheat;
          font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                Add a task: &nbsp;</label>
            <input type="text" placeholder="Enter a task" id="task" name="task">
            <input type="hidden" id="edit_id" name="edit_id" value="0"> <!-- for edit task id it sends to save.php !-->
            <input type="hidden" id="position_id" name="position_id" value="0"> &nbsp;&nbsp;
            <input type="submit" id="Submit">
        </span>
    </div>

</form>


<div class='task_process'>
    <span class='process_of_task'>
        <button class='All_task tab' id='All_task' onclick="All_task()">All Tasks</button>
        <button class='Completed_task tab ' id="Completed_task" onclick="Completed_task()">Completed Tasks </button>
        <button class='Pending_task tab' id="Pending_task" onclick="Pending_task()"> Pending Tasks </button>
    </span>
</div>



<form method="post">
    <ul start="1">
        <?php
        $i = 1;
        $last_query = "SELECT max(position) as last_position from todotable where user_id = $user_id";
        $last_result = mysqli_query($conn, $last_query);
        $last_row = mysqli_fetch_assoc($last_result);
        $last_position = $last_row['last_position'];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($user_id == $row['user_id']) {
                    $is_completed = $row["status"] ? "Completed" : "Pending";
                    $completed_class = $row['status'] ? 'completed' : '';
                    $style_first_position = ($row['position'] == 1) ? 'first_position' : '';
                    $status_text =  $row["status"] ? "<i class='fa-regular fa-circle-check'></i>" : "<i class='fa-regular fa-circle'></i>";
                    if ($last_position != 1) {
                        $style_last_position = ($row['position'] == $last_position) ? 'last_position' : '';
                    } else if ($row['position'] == 1 & $last_position == 1) {
                        $style_last_position = 'last_position';
                        $style_first_position = 'first_position';
                    } else {
                        $style_last_position = ($row['position'] == $last_position) ? '' : '';
                    }
                    echo "<div class='tasks_width' todo-item-status='{$row['status']}'>
                     <div class='center_tasks'>
                     <li class='todo-item ' data-status='{$row['status']}'>
                     <div>
                        <span data-index>  $i </span>
                        &nbsp;&nbsp;
                     <span class='task $completed_class'>{$row['task']}
                    </span> </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div>
                        <a data-position ='{$row['position']}'  class='up_arrow $style_first_position' name='up' value='up' href='?up_position={$row['position']}'  ><i class='fa-solid fa-arrow-up'></i> </a>
                        <a class='down_arrow $style_last_position'  name='down' value='down' href='?down_position={$row['position']}' ><i class='fa-solid fa-arrow-down'></i></a>
                        <a data-position = '{$row['position']}' data-icon='pen' data-status='{$row['status']}' data-task-id='{$row['id']}' data-task='{$row['task']}' onclick='onEdit(this)' class='edit' id='edit' href='?edit_id={$row['id']}'>                        
                        <i class='fa-solid fa-pen' data-status='1'></i></a>
                        <a class='status-icon' name='completed' value='completed' href='?status_position={$row['position']}&status={$row['status']}&id='{$row['id']}>$status_text</a>
                        <a class='Delete' name='Delete' value='Delete' href='?delete_id={$row['id']}&delete_position={$row['position']}'><i class='fa-solid fa-trash'></i></a>
                        </div>
                    </li></div> </div>";
                    $i++;
                }
            }
        } else {
            echo "<br><div class = 'zero_result'>0 results</div>";
        }
        ?>
    </ul>
</form>
</body>

<script>
    function onEdit(target) {
        const task = target.getAttribute('data-task')
        const id = target.getAttribute('data-task-id')
        const status = target.getAttribute('data-status')
        if (status == 0) {
            document.querySelector('#task').value = task
            document.querySelector('#task').name = "edit"
            document.querySelector('#edit_id').value = id

        } else {
            document.getElementById("edit").disabled = true;
        }
        event.preventDefault();
    }

    window.onload = function() {
        All_task();
    }



    function All_task() {
        document.getElementById("All_task").style.textDecoration = "underline";
        document.getElementById("All_task").style.textUnderlineOffset = "5px";
        document.getElementById("All_task").style.textDecorationColor = "lightskyblue";
        document.getElementById("All_task").style.color = "rgb(0, 200, 255)";
        document.getElementById("Pending_task").style.textDecoration = "none";
        document.getElementById("Pending_task").style.color = "black";
        document.getElementById("Completed_task").style.textDecoration = "none";
        document.getElementById("Completed_task").style.color = "black";
        let tasks = document.querySelectorAll("[todo-item-status]")
        let index = 1
        for (let i = 0; i < tasks.length; i++) {
            tasks[i].style.display = "flex";
            tasks[i].querySelector('[data-index]').innerHTML = index++ + "."
        }

        console.log("all");

    }

    function Completed_task() {
        console.log("completed");

        document.getElementById("All_task").style.textDecoration = "none";
        document.getElementById("All_task").style.color = "black";
        document.getElementById("Pending_task").style.textDecoration = "none";
        document.getElementById("Pending_task").style.color = "black";
        document.getElementById("Completed_task").style.textDecoration = "underline";
        document.getElementById("Completed_task").style.textUnderlineOffset = "5px";
        document.getElementById("Completed_task").style.textDecorationColor = "lightskyblue";
        document.getElementById("Completed_task").style.color = "rgb(0, 200, 255)";
        let tasks = document.querySelectorAll("[todo-item-status]");

        let index = 1
        for (let i = 0; i < tasks.length; i++) {
            let status = parseInt(tasks[i].getAttribute('todo-item-status'));
            if (status === 1) {
                tasks[i].style.display = "flex";
                tasks[i].querySelector('[data-index]').innerHTML = index++ + "."
            } else {
                tasks[i].style.display = "none";
            }

        }
        event.preventDefault();
    }

    function Pending_task() {
        document.getElementById("All_task").style.textDecoration = "none";
        document.getElementById("All_task").style.color = "black";
        document.getElementById("Completed_task").style.textDecoration = "none";
        document.getElementById("Completed_task").style.color = "black";
        document.getElementById("Pending_task").style.color = "rgb(0, 200, 255)";
        document.getElementById("Pending_task").style.textDecorationColor = "lightskyblue";
        document.getElementById("Pending_task").style.textUnderlineOffset = "5px";
        document.getElementById("Pending_task").style.textDecoration = "underline";
        let tasks = document.querySelectorAll("[todo-item-status]");
        let index = 1
        for (let i = 0; i < tasks.length; i++) {
            let status = parseInt(tasks[i].getAttribute('todo-item-status'));
            if (status === 1) {
                tasks[i].style.display = "none";
            } else {
                tasks[i].style.display = "flex";
                tasks[i].querySelector('[data-index]').innerHTML = index++ + "."
            }

        }
    }
</script>

</html>