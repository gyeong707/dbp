<?php
  $link = mysqli_connect('localhost', 'root', 'ROOTROOT', 'dbp');
  $query = "SELECT * FROM d_grade";
  $result = mysqli_query($link, $query);
  $grade_info = '';

  while ($row = mysqli_fetch_array($result)) {
      $filtered = array(
      'id' => htmlspecialchars($row['id']),
      'grade' => htmlspecialchars($row['grade']),
      'grade_desc' => htmlspecialchars($row['grade_desc'])
    );
      $grade_info .= '<tr>';
      $grade_info .= '<td>'.$filtered['id'].'</td>';
      $grade_info .= '<td>'.$filtered['grade'].'</td>';
      $grade_info .= '<td>'.$filtered['grade_desc'].'</td>';
      $grade_info .= '<td><a href="grade.php?id='.$filtered['id'].'">수정</a></td>';
      $grade_info .= '
      <td>
        <form action="process_delete_grade.php" method="post">
          <input type="hidden" name="id" value="'.$filtered['id'].'">
          <input type="submit" value="Del">
        </form>
      </td>
      ';
      $grade_info .= '</tr>';
  }

  $escaped = array(
    'grade' => '',
    'grade_desc' => ''
  );

  $form_action = 'process_create_grade.php';
  $label_submit = 'Create grade';
  $form_id = '';

if (isset($_GET['id'])) {
    $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
    settype($filtered_id, 'integer');
    $query = "SELECT * FROM d_grade WHERE id = {$filtered_id}";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $escaped['grade'] = htmlspecialchars($row['grade']);
    $escaped['grade_desc'] = htmlspecialchars($row['grade_desc']);
    $form_action = 'process_update_grade.php';
    $label_submit = 'Update grade';
    $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = 'utf-8'>
    <title>DATABASE</title>
</head>
<body>
  <h1><a href='index.php'>DUNKIN</a></h1>
  <p><a href="index.php">홈으로 돌아가기</a></p>

  <table border="1">
    <tr>
      <th>아이디</th>
      <th>등급</th>
      <th>등급설명</th>
      <th>수정</th>
      <th>삭제</th>
    </tr>
      <?= $grade_info ?>
  </table>
  <br>
  <form action="<?= $form_action ?>" method="POST">
    <?= $form_id ?>
    <label for="fname">grade:</label><br>
    <input type="text" id="grade" name="grade" placeholder="grade" value="<?=$escaped['grade']?>"><br>
    <label for="lname">description:</label><br>
    <input type="text" id="grade_desc" name="grade_desc" placeholder="description" value="<?=$escaped['grade_desc']?>"><br>
    <input type="submit" value="<?= $label_submit ?>">
  </form>


</body>
</html>
