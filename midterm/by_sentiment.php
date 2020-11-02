<?php
  $link = mysqli_connect('localhost', 'root', 'exam', 'midterm', 3307);
  if(mysqli_connect_errno()){
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    // initial value
    $totalRowNum = 1600000;
    $sentiment_label = "Sentiment(negative: 0 | positive: 4)";
    $query = "
    SELECT * FROM TWITTER LIMIT 10";

    // Select Sentiment
    if(isset($_POST['sentiment'])) {
        $sentiment = mysqli_real_escape_string($link, $_POST['sentiment']);
        $subquery = "SELECT count(*) FROM twitter WHERE target='{$sentiment}'";
        $subresult = mysqli_query($link, $subquery);
        $subrow = mysqli_fetch_array($subresult);
        $totalRowNum = $subrow['count(*)'];
        $query =  "
        SELECT * FROM twitter WHERE target = '{$sentiment}' LIMIT 0, 10";
        if($sentiment == "0") {
            $sentiment_label = "Current :: negative";
        }
        elseif($sentiment == "4"){
            $sentiment_label = "Current :: positive";
        }
    } 

    // Moving Page Event + Sentiment
    $currentPage = 1;
        if (isset($_GET["currentPage"])) {
            $currentPage = $_GET["currentPage"];
            $sentiment = $_GET['sentiment'];
            $subquery = "SELECT count(*) FROM twitter WHERE target='{$sentiment}'";
            $subresult = mysqli_query($link, $subquery);
            $subrow = mysqli_fetch_array($subresult);
            $totalRowNum = $subrow['count(*)'];
            $rowPerPage = 10; 
            $begin = ($currentPage -1) * $rowPerPage;
            $query = "
            SELECT * FROM TWITTER WHERE TARGET='{$sentiment}' LIMIT ".$begin.",".$rowPerPage."";
            if($sentiment == "0") {
                $sentiment_label = "Current :: negative";
            }
            elseif($sentiment == "4"){
                $sentiment_label = "Current :: positive";
            }
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

    // Summary Table
    $senti_query = "
                    SELECT target sentiment, COUNT(*) cnt FROM TWITTER GROUP BY TARGET";
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
    <title> Tweets categorized by sentiment</title>
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
                <h1 class="section_title">Analysis 1. 감정별 트윗 조회하기</h1>
                <hr>
                <span class="section_dataset_info">
                어떤 감정 라벨들이 있으며 감정별로 어떤 트윗들이 있는지 확인할 수 있습니다. <br><br><br>
                <span class="section_class_info">[감정분류] 0 : Negative | 2 : Neutral | 4 : Positive</span><br><br><br>
                이 데이터셋에서는 Negative와 Positive만 존재하며<br><br>
                그 분포는 800000 : 800000 으로 정확히 반반입니다.
                <br>
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
                <h2 class="section_dataset_subtitle">[Tweets categorized by sentiment]</h2>
                <div class="analysis_form">
                    <form action="by_sentiment.php" method="POST">
                        <label>다른 감성 검색: </label>
                        <input type="text" name="sentiment" placeholder="<?=$sentiment_label?>">
                        <input type="submit" value="submit"><br><br>
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
                <form action='by_sentiment.php' method="GET" class="form_buttons">
                    <input type="hidden" name="sentiment" value='<?=$sentiment?>'>
                    <input type="hidden" name="currentPage" value='<?=($currentPage-1)?>'>
                    <input type="submit" name="back" value="Back">
                </form>

                <form action='by_sentiment.php' method="GET" class="form_buttons">
                    <input type="hidden" name="sentiment" value='<?=$sentiment?>'>
                    <input type="hidden" name="currentPage" value='<?=($currentPage+1)?>'>
                    <input type="submit" name="next" value="Next">
                </form>

                <br>
                <div class="back_to">
                    <a href="by_sentiment.php">처음으로 돌아가기</a><br><br>
                    <a href="index.php">메인으로 돌아가기</a>
                </div>
            </div>
        </div>
    </body>
</head>
</html>
