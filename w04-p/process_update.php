<?php
  $link = mysqli_connect("localhost", "root", "ROOTROOT", "dbp");
  $filtered = array(
    'id' => mysqli_real_escape_string($link, $_POST['id']),
    'name' => mysqli_real_escape_string($link, $_POST['name']),
    'description' => mysqli_real_escape_string($link, $_POST['description']),
    'grade_id' => mysqli_real_escape_string($link, $_POST['grade_id'])
  );
  $query = "
    UPDATE DUNKIN
      SET
        name = '{$filtered['name']}',
        description = '{$filtered['description']}',
        grade_id = '{$filtered['grade_id']}'
      WHERE
        id = '{$filtered['id']}'
    ";

  $result = mysqli_multi_query($link, $query);
  if ($result == false) {
      echo '수정하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
      error_log(mysqli_error($link));
  } else {
      echo '성공했습니다. <a href="index.php">돌아가기</a>';
  }
