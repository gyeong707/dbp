<?php
  $link = mysqli_connect('localhost', 'root', 'exam', 'midterm', 3307);
  $query = "
  SELECT * FROM TWITTER LIMIT 7";
  $result = mysqli_query($link, $query);
  $twit_info = "";

  while ($row = mysqli_fetch_array($result)) {
    $filtered = array(
      'id' => htmlspecialchars($row['id']),
      'target' => htmlspecialchars($row['target']),
      'date' => htmlspecialchars($row['date']),
      'user' => htmlspecialchars($row['user']),
      'text' => htmlspecialchars($row['text'])
    );
      $twit_info .= '<tr>';
      $twit_info .= '<td>'.$filtered['id'].'</td>';
      $twit_info .= '<td>'.$filtered['target'].'</td>';
      $twit_info .= '<td>'.$filtered['date'].'</td>';
      $twit_info .= '<td>'.$filtered['user'].'</td>';
      $twit_info .= '<td>'.$filtered['text'].'</td>';
      $twit_info .= '</tr>';
  }
  
  // 할당된 리소스 해제
  mysqli_free_result($result);
  mysqli_close($link);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> DBP Midterm Report </title>
    <link rel=stylesheet href="style.css" type="text/css">
</head>
<body>
  <div id="report">
    <img src="brain.png" id="report_cover">
    <span id="report_title"><a href='index.php'>DBP Midterm Report</a></span>
    <h3 id="report_name">20160965 통계학과 강미경</h3> 
    <h3 id="report_top">Sungshin Women's University</h3>
    <h3</h3>
    <div id="report_inner">

      <div class="section">
        <h1 class="section_title">ㆍMYDATAㆍ</h1>
        <hr>
        <h2 class="section_dataset_title">Semtiment140 dataset with 1.6 million tweets</h2>
        <span class="section_dataset_info">
          평소 심리학에 관심이 있어 관련된 주제를 찾아보다 <br><br>
          Kaggle에서 160만개의 트윗과 해당 트윗의 감성을 라벨링한 데이터셋을 발견하여 사용하게 되었습니다.<br>
        </span>
        <br><br>
        [link] <span class="section_dataset_link">https://www.kaggle.com/kazanova/sentiment140</span>

        <h2 class="section_dataset_subtitle">[ DATA INFO ]</h2>
        <table class="datainfo">
          <thead>
          <tr>
              <th scope="cols">Column</th>
              <th scope="cols">Info</th>
          </tr>
          </thead>
          <tbody>
          <tr>
              <th scope="row">id</th>
              <td>row number</td>
          </tr>
          <tr>
              <th scope="row">target</th>
              <td>the polarity of the tweet<br>(0 = negative, 2 = neutral, 4 = positive)</td>
          </tr>
          <tr>
              <th scope="row">date</th>
              <td>the date of the tweet</td>
          </tr>
          <tr>
              <th scope="row">user</th>
              <td>the user that tweeted</td>
          </tr>
          <tr>
              <th scope="row">text</th>
              <td>the text of the tweet</td>
          </tr>
          </tbody>
      </table>
      <br><br>
      <span class="section_dataset_info">
        데이터는 트윗의 작성 날짜, 작성자, 내용 그리고 해당 내용에 대한 라벨(negative / positive)로 구성되어 있습니다.<br><br>
        SQL 쿼리 문을 통해 데이터셋으로부터 의미 있는 정보를 출력해 확인해보도록 하겠습니다.<br>
        </span>

        <h2 class="section_dataset_subtitle">[ DATA PREVIEW ]</h2>
        <table class="dataset">
          <tr>
            <th>id</th>
            <th>target</th>
            <th>date</th>
            <th>user</th>
            <th>text</th>
          </tr>
          <?= $twit_info ?>
        </table>
      </div>

      <div class="section">
        <h1 class="section_title">ㆍANALYSISㆍ</h1>
        <hr>
        <span class="section_dataset_info">
          이 데이터셋의 가장 중요한 정보는 target, 즉 글에 내재된 감정(sentiment)입니다.<br><br>
          따라서 모든 정보는 sentiment를 기준으로 합니다.<br><br>
          찾은 정보는 다음과 같으며, 각각을 클릭하여 자세한 사항을 살펴볼 수 있습니다.<br>
        </span>
        <div class="analysis_content">
          <h3><a href="by_sentiment.php">감정별 트윗 조회하기</a></h3>
          <h3><a href="by_user.php">특정 사용자가 쓴 글 조회하기</a></h3>
          <h3><a href="by_word.php">특정 단어가 포함된 트윗 조회하기</a></h3>
        </div>
      </div>

      <div class="section">
        <h1 class="section_title">ㆍREVIEWㆍ</h1>
        <hr>
        <h3 class="review_content">
          회고록으로 이동하기
          <br><br> 
          <a href="review.php">page</a> / <a href="">github</a>
        </h3>
      </div>
    </div>
  </div>
</body>
</html>
