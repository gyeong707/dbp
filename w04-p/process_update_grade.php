<?php
  $link = mysqli_connect("localhost", "root", "ROOTROOT", "dbp");
  $filtered = array(
    'id' => mysqli_real_escape_string($link, $_POST['id']),
    'grade' => mysqli_real_escape_string($link, $_POST['grade']),
    'grade_desc' => mysqli_real_escape_string($link, $_POST['grade_desc'])
  );
  $query = "
    UPDATE d_grade
      SET
        grade = '{$filtered['grade']}',
        grade_desc = '{$filtered['grade_desc']}'
      WHERE
        id = '{$filtered['id']}'
    ";

  // die($query);
  // 인자로 들어오는 쿼리의 내용을 화면에 출력하고, 프로그램을 종료시키는 함수
  $result = mysqli_query($link, $query);
  if ($result == false) {
      echo '수정하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
      error_log(mysqli_error($link));
  } else {
      header('Location: grade.php');
  }
