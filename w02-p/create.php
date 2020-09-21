<?php
  $link = mysqli_connect('localhost', 'root', 'ROOTROOT', 'dbp');
  $query = "SELECT * FROM dunkin";
  $result = mysqli_query($link, $query);
  $list = "";
  while ($row = mysqli_fetch_array($result)){
    $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['name']}</a></li>";
  }

  $article = array(
    'name' => '던킨 도넛을 소개합니다!',
    'description' => '던킨도너츠는 70년의 역사를 지닌 세계 최대의 커피&도넛 전문 브랜드로, 전세계 26개국에서 11,300여개의 점포를 운영하고 있습니다. [출처] 던킨도너츠 공식홈페이지'
  );

  if( isset($_GET['id'])) {
    $query = "SELECT * FROM dunkin WHERE id={$_GET['id']}";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $article = array(
        'name' => $row['name'],
        'description' => $row['description']
    );
  }

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> DUNKIN </title>
</head>
<body>
  <h1> <a href='index.php'> DUNKIN </a></h1>
  <h3> 던킨 아르바이트 2년차가 추천하는 메뉴! </h3>
  <ol> <?= $list ?> </ol>
  <h3> 이외에도 여러분이 맛있게 먹은 메뉴가 있다면 추가해주세요! </h3>
  <form action="process_create.php" method="post">
    <p><input type="text" name="name" placeholder="이름"></p>
    <p><textarea name="description", placeholder="메뉴에 대한 간단한 설명과 좋아하는 이유를 적어주세요!"></textarea></p>
    <p><input type="submit"></p>
  </form>
</body>
</html>
