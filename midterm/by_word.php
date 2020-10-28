<?php
  $link = mysqli_connect('localhost', 'root', 'exam', 'midterm', 3307);
  if(mysqli_connect_errno()){
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    // initial value
    $word = "Enter the word you want to search for";
    $sentiment_label = "--Select Sentiment--";
    $sentiment = "";
    $totalRowNum = 1600000;
    $query = "SELECT * FROM TWITTER LIMIT 10";
    $senti_query = "
    SELECT target sentiment, count(*) cnt FROM twitter GROUP BY target";
    
    // Select Word
    if(isset($_POST['word'])) {
        $word = mysqli_real_escape_string($link, $_POST['word']);
        $subquery = "SELECT count(*) FROM twitter WHERE text like '%".$word."%'";
        $subresult = mysqli_query($link, $subquery);
        $subrow = mysqli_fetch_array($subresult);
        $totalRowNum = $subrow['count(*)'];
        $senti_query = "
        SELECT target sentiment, count(*) cnt FROM TWITTER WHERE text like '%".$word."%' group by target;";
        $query =  "
        SELECT * FROM twitter WHERE text like '%".$word."%' LIMIT 10";
        }

    // Select Sentiment + Word
    if(isset($_GET['sentiment'])){
        $word = $_GET['word'];
        $sentiment = mysqli_real_escape_string($link, $_GET['sentiment']);
        $subquery = "
        SELECT count(*) FROM twitter WHERE text like '%".$word."%' AND target='{$sentiment}'";
        $subresult = mysqli_query($link, $subquery);
        $subrow = mysqli_fetch_array($subresult);
        $totalRowNum = $subrow['count(*)'];
        $query = "
        SELECT * FROM twitter WHERE text like '%".$word."%' AND target='{$sentiment}' LIMIT 10";
        $senti_query = "
        SELECT target sentiment, count(*) cnt FROM TWITTER WHERE text like '%".$word."%' group by target;";
        if($sentiment == "0") {
            $sentiment_label = "Current :: negative";
        }
        elseif($sentiment == "4"){
            $sentiment_label = "Current :: positive";
        }
    }

    // Moving Page Event + Word + Sentiment
    $currentPage = 1;
    if (isset($_GET["currentPage"])) {
        $currentPage = $_GET["currentPage"];
        $word = $_GET['word'];

        //not filtering sentiment
        if ($sentiment_label == "--Select Sentiment--") {
            $subquery = "
            SELECT count(*) FROM twitter WHERE text like '%".$word."%'";
            $subresult = mysqli_query($link, $subquery);
            $subrow = mysqli_fetch_array($subresult);
            $totalRowNum = $subrow['count(*)'];
            $rowPerPage = 10; 
            $begin = ($currentPage -1) * $rowPerPage;
            $query = "
            SELECT * FROM TWITTER WHERE text like '%".$word."%' LIMIT ".$begin.",".$rowPerPage."";
        }

        // filtering sentiment
        else {
            $sentiment = $_GET['sentiment'];
            $subquery = "
            SELECT count(*) FROM twitter WHERE text like '%".$word."%' AND target='{$sentiment}'";
            $subresult = mysqli_query($link, $subquery);
            $subrow = mysqli_fetch_array($subresult);
            $totalRowNum = $subrow['count(*)'];
            $rowPerPage = 10; 
            $begin = ($currentPage -1) * $rowPerPage;
            $query = "
            SELECT * FROM TWITTER WHERE text like '%".$word."%' AND target='{$sentiment}' LIMIT ".$begin.",".$rowPerPage."";
            if($sentiment == "0") {
                $sentiment_label = "Current :: negative";
            }
            elseif($sentiment == "4"){
                $sentiment_label = "Current :: positive";
            }
        }
        $senti_query = "
        SELECT target sentiment, count(*) cnt FROM TWITTER WHERE text like '%".$word."%' group by target;";
    }

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

      $senti_result = mysqli_query($link, $senti_query);
      $senti_info = "";
      while($senti_row = mysqli_fetch_array($senti_result)) {
          $senti = array(
              'sentiment' => htmlspecialchars($senti_row['sentiment']),
              'cnt' => htmlspecialchars($senti_row['cnt'])
          );
          $senti_info .= '<tr>';
          $senti_info .= '<td>'.$senti['sentiment'].'</td>';
          $senti_info .= '<td>'.$senti['cnt'].'</td>';
          $senti_info .= '</tr>';
      }

     // 할당된 리소스 해제
    mysqli_free_result($result);
    mysqli_free_result($senti_result);
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title> Tweets categorized by word</title>
    <link rel=stylesheet href="style.css" type="text/css">

    <style></style>

    <body>
        <div id="report">
            <img src="brain.png" id="report_cover">
            <span id="report_title"><a href='index.php'>DBP Midterm Report</a></span>
            <h3 id="report_name">20160965 통계학과 강미경</h3> 
            <h3 id="report_top">Sungshin Women's University</h3>

            <!-- Analysis Info -->
            <div id="report_inner">
            <div class="section">
                <h1 class="section_title">Analysis 3. 특정 단어가 포함된 트윗 조회하기</h1>
                <hr>
                <span class="section_dataset_info">
                특정 단어가 포함된 트윗을 조회합니다. <br><br>
                이를 통해 특정 단어가 포함된 트윗이 보통 어떤 감정라벨에 해당되는지 파악할 수 있습니다.<br><br>
                ex) happy가 포함된 트윗은 positive(label: 4)일 가능성이 높을 것이다.<br><br>
                이때 조회된 데이터셋에서 특정 감정을 가진 트윗만 필터링할 수 있도록 '결과 내 재검색' 기능을 추가하였습니다.<br>
                </span>

                <!-- Summary Table -->
                <table class="summary_dataset">
                    <tr>
                    <th>sentiment</th>
                    <th>cnt</th>
                    </tr>
                    <?=$senti_info?>
                </table>
                <br>
                <span class="section_dataset_info">
                    0 : Negative  |  4 : Positive <br>
                </span>
                <br><br><hr>

                <!-- Dataset Table -->
                <h2 class="section_dataset_subtitle">[Tweets categorized by word]</h2>
                <div class="analysis_form">
                    <form action="by_word.php" method="POST">
                        <label>다음 단어가 포함된 글 검색: </label>
                        <input type="text" name="word" placeholder='<?=$word?>'>
                        <input type="submit" value="submit"><br><br>
                    </form>
                </div>
                <div class="analysis_form">
                    <form action="by_word.php" method="GET">
                        <label>결과 내 감정 재검색:</label>
                        <select name="sentiment">
                            <option value=""><?=$sentiment_label?></option>
                            <option value="0">negative</option>
                            <option value="4">positive</option>
                        </select>
                        <input type="hidden" name="word" value=<?=$word?>>
                        <input type="submit" value="Select">
                    </form>
                </div>
                <div class="section_rownum">총 <?=$totalRowNum?> 개의 행이 검색되었습니다.</div>
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

                <!-- Buttons -->
                <form action='by_word.php' method="GET" class="form_buttons">
                    <input type="hidden" name="sentiment" value='<?=$sentiment?>'>
                    <input type="hidden" name="word" value='<?=$word?>'>
                    <input type="hidden" name="currentPage" value='<?=($currentPage-1)?>'>
                    <input type="submit" name="back" value="Back">
                </form>

                <form action='by_word.php' method="GET" class="form_buttons">
                    <input type="hidden" name="sentiment" value='<?=$sentiment?>'>
                    <input type="hidden" name="word" value='<?=$word?>'>
                    <input type="hidden" name="currentPage" value='<?=($currentPage+1)?>'>
                    <input type="submit" name="next" value="Next">
                </form>

                <div class="back_to">
                    <a href="by_word.php">처음으로 돌아가기</a><br><br>
                    <a href="index.php">메인으로 돌아가기</a>
                </div>
            </div>
        </div>
    </body>
</head>
</html>
