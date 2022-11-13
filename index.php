<?php
    $errors = "";
    
    $db = mysqli_connect('localhost', 'root', '', 'todos');

    if(isset($_POST['submit'])) {
        $task = $_POST['task'];
        if(empty($task)) {
            $errors = "You must fill the task section!";
        } else{
                  mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
                  header('location: index.php');
    }
}
    //delete
    if(isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
        header('location: index.php');
    }


    $tasks = mysqli_query($db, "SELECT * FROM tasks");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO LIST APP</title>
</head>
<body>
    <div class="heading">
    <h2>TODO LIST APP</h2>
    </div>

    <form method="POST" action="index.php">
    <?php if(isset($errors)) { ?> 
        <p><?php echo $errors; ?> </p>
    <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <!-- fixing id numbers after deletion-->
           <?php $i = 1; 
            while ($row = mysqli_fetch_array($tasks)) {  ?>
            <tr>
                <!-- id -->
                  <td>  <?php echo $i; ?>
                    <?php // echo $row ['id']; ?> </td> 
                <!-- task -->
                <td class="task"><?php echo $row['task']; ?> </td>
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
                </td>
            </tr>
            <!-- increment for the new id implement-->
            <?php $i++; } ?> 
        </tbody>
    </table>
</body>
</html>