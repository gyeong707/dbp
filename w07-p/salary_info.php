<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'employees');
    if(mysqli_connect_errno()){
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }
    $query = "
        SELECT title, avg(salary) as avg_salary
        FROM titles
        INNER JOIN employees ON titles.emp_no = employees.emp_no
        INNER JOIN salaries ON salaries.emp_no = employees.emp_no
        GROUP BY title
        ORDER BY avg(salary) desc";

    $article = '';
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= $row['title'];
        $article .= '</td><td>';
        $article .= $row['avg_salary'];
        $article .= '</td></tr>';
    }
    
    // 할당된 리소스 해제
    mysqli_free_result($result);
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title> 업무별 연봉 정보 </title>
    <style>
        body{
            font-family: Consolas, monospace;
            font-family: 12px;
        }
        table{
            width: 50%;
            margin: auto;
            text-align: center;
            background-color: #e3f2fd;
        }
        th, td{
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }

        th {
            background-color: #bbdefb;
        }
    </style>
    <body>
        <h2 style=text-align:center;margin:50px><a href="index.php">직원 관리 시스템</a> | 업무별 연봉 정보</h2>
        <table>
            <tr>
                <th>업무</th>
                <th>평균 연봉</th>
            </tr>
            <?= $article ?>
        </table>
    </body>
</head>
</html>