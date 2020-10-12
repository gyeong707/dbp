<?php
    $link = mysqli_connect("localhost", "admin", "admin", "employees");
    if(isset($_GET['emp_no'])) {
        $filtered_id = mysqli_real_escape_string($link, $_GET['emp_no']);
    } else {
        $filtered_id = mysqli_real_escape_string($link, $_POST['emp_no']);
    }
    
    $query = "
        SELECT *
        FROM employees
        WHERE emp_no='{$filtered_id}'
    ";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>직원 관리 시스템</title>
</head>

<body>
<h1>직원 관리 시스템</h1>
    <a href="emp_select.php">(1) 직원 정보 조회</a><br>
    <a href="emp_insert.php">(2) 신규 직원 등록</a><br>
    <form action="emp_update.php" method="POST">
        (3) 직원 정보 수정: <br>
        <input type="text" name="emp_no" placeholder="emp_no">
        <input type="submit" value="Search">
    </form>
    <form action="emp_delete.php" method="POST">
        (4) 직원 정보 삭제: <br>
        <input type="text" name="emp_no" placeholder="emp_no">
        <input type="submit" value="Delete">
    </form>
    
<h2><a href="index.php">직원 관리 시스템</a> | 직원 정보 삭제</h2>
    <form action="emp_delete_process.php" method="POST">
        <label>emp_no: </label>
        <input type="text" name="emp_no" value="<?=$row['emp_no']?>" placeholder="emp_no" readonly><br>
        <label>birth_date:(0000-00-00) </label>
        <input type="text" name="birth_date" value="<?=$row['birth_date']?>" placeholder="birth_date" readonly><br>
        <label>first_name: </label>
        <input type="text" name="first_name" value="<?=$row['first_name']?>" placeholder="first_name" readonly><br>
        <label>last_name: </label>
        <input type="text" name="last_name" value="<?=$row['last_name']?>" placeholder="last_name" readonly><br>
        <label>gender: </label>
        <input type="text" name="gender" value="<?=$row['gender']?>" placeholder="gender" readonly><br>
        <label>hire_date: </label>
        <input type="text" name="hire_date" value="<?=$row['hire_date']?>" placeholder="hire_date" readonly><br>
        <input type="submit" value="Delete">
    </form>
</body>

</html>