<?php
  $link = mysqli_connect("localhost", "root", "ROOTROOT", "dbp");
  $filtered = array(
    'grade' => mysqli_real_escape_string($link, $_POST['grade']),
    'grade_desc' => mysqli_real_escape_string($link, $_POST['grade_desc'])
  );
  $query = "
    INSERT INTO d_grade (
      grade, grade_desc
      ) VALUE (
        '{$filtered['grade']}',
        '{$filtered['grade_desc']}'
        )";

  $result = mysqli_multi_query($link, $query);
  if ($result == false) {
      echo '저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
      error_log(mysqli_error($link));
  } else {
      header('Location: grade.php');
  }
