<?php
  $link = mysqli_connect('localhost', 'root', 'ROOTROOT', 'dbp');
  $query = "SELECT * FROM dunkin";
  $result = mysqli_query($link, $query);
  $list = "";
  while ($row = mysqli_fetch_array($result)) {
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['name']}</a></li>";
  }

  $article = array(
    'name' => '던킨 도넛을 소개합니다!',
    'description' => '던킨도너츠는 70년의 역사를 지닌 세계 최대의 커피&도넛 전문 브랜드로, 전세계 26개국에서 11,300여개의 점포를 운영하고 있습니다. [출처] 던킨도너츠 공식홈페이지'
  );

  if (isset($_GET['id'])) {
      $query = "SELECT * FROM dunkin WHERE id={$_GET['id']}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article = array(
        'name' => $row['name'],
        'description' => $row['description']
    );
  }

  $query = "SELECT * FROM d_grade";
  $result = mysqli_query($link, $query);
  $select_form = '<select name="grade_id">';
  while ($row = mysqli_fetch_array($result)) {
      $select_form .= '<option value="'.$row['id'].'">'.$row['grade_desc'].'</option>';
  }
  $select_form .= '</select>';
 ?>

 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title> DUNKIN </title>
     <link rel=stylesheet href="style.css" type="text/css">
 </head>
 <body>
   <div id='main_board'>
     <div id='title_bar'>
       <span id='title'> <a href='index.php'> DUNKIN</a></span>
       <span id='title_c'>'</span>
     </div>
     <div id='reco_board'>
       <h3 class='board_title'> 던킨 아르바이트 2년차가 추천하는 메뉴를 알아보자 </h3>
       <div class="list">
         <ul class='reco_list'> <?= $list ?> </ul>
         <h4 class='board_content'> 클릭하여 메뉴 설명과 추천 이유를 보실 수 있습니다.</h4>
       </div>
     </div>
     <div id='content_board'>
       <h2>< <?= $article['name'] ?> ></h2>
       <div class="description"> <?= $article['description'] ?> </div>
       <br><br><br>
       <hr>
       <h3 class='board_title'> 이외에도 여러분이 맛있게 먹은 메뉴가 있다면 추가해주세요! </h3>
       <a href="create.php"><새로운 메뉴 추가></a>
     </div>
    <form action="process_create.php" method="post">
      <p><input type="text" name="name" placeholder="이름"></p>
      <p><textarea name="description", placeholder="메뉴에 대한 간단한 설명과 좋아하는 이유를 적어주세요!"></textarea></p>
      <?= $select_form ?>
      <p><input type="submit"></p>
    </form>
  </div>

</body>
</html>
