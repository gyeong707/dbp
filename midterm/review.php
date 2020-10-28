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
                <h1 class="section_title">REVIEW</h1>
                <hr>
                <h2 class="review_subtitle"> 1. 개발 환경 소개 </h2>
                <span class="section_dataset_info">
                    
                    <h3 class="review_list_title">① MariaDB vs Mysql</h3>
                    mysql이 오라클에 인수되면서 기존 개발자가 나와 호환되게 만든 것이 MariaDB! <br><br>
                    MariaDB는 mysql과 완벽하게 호환되면서 더 가볍고 빠르다는 장점이 있다고 배웠습니다.<br><br>
                    그리고 저는 이전에 oracle을 이용한 수업에서 이것이 제 RAM을 무지막지하게 잡아먹는 것을 보고 충격을 먹은 적이 있기 때문에..<br><br>
                    메모리 사용량에 초점을 맞추고, 보다 더 가벼운 MariaDB를 선택했습니다.<br><br>
                    
                    <h3 class="review_list_title">② Linux vs Window</h3>
                    개발자에게 윈도우가 좋지 못하단 사실은 익히 들어 알고 있었습니다.<br><br>
                    그래도 혹시 모를 장점이 있을까 이런저런 영상을 보았지만.. <br><br>
                    아무도 개발 시 윈도우의 장점을 말하지 않았습니다. 모두들 맥을 쓰라고 한더군요..맥이 없으면 리눅스를 쓰라고..<br><br>
                    <br>
                    그럼에도 저는 윈도우를 선택했습니다. <br><br>
                    왜냐하면 지금 과제를 수행하는 데에는 리눅스의 장점이 돋보일만한 테스크가 없다고 판단했기 때문입니다.<br><br>
                    리눅스 기반의 OS의 큰 장점 중 하나가 소프트웨어 설치가 윈도우보다 간단하다는 것인데, (수업 시간 때 배웠던 것처럼요!)<br><br>
                    현재 과제 내에서는 딱히 여러 개의 소프트웨어를 설치할 필요가 없으며<br><br>
                    또 가상 머신을 통해 원격으로 접속할 시에 그 조작방법이 윈도우와 크게 차이가 나지 않으므로<br><br>
                    가상머신을 켰다 껐다 하는 수고를 들여서까지 리눅스를 선택하지 않아도 될 것이라 판단했습니다.<br><br>

                    <h3 class="review_list_title">③ etc</h3>
                    나머지 백앤드 서버 사이드 언어는 PHP, 프론트 엔드 사이드 언어는 HTML, CSS를 사용했습니다<div class=""></div>
                </span>
                <br><hr>

                <h2 class="review_subtitle"> 2. 발견한 정보 소개 </h2>
                <span class="section_dataset_info">
                    특정 Column 요소를 통한 Filtering을 바탕으로, Target인 감정의 분포를 파악할 수 있도록 구성하였습니다.<br><br>
                    따라서, 발견한 정보들은 대부분 ~별 감정의 분포가 됩니다!<br><br>
                    <br>
                    <h3 class="review_list_title">① 감정별 트윗 조회하기</h3>
                    감정별로 트윗을 조회하고, 이를 바탕으로 감정의 분포를 알아보았습니다.<br><br>
                    트윗은 정확히 절반씩 Negative / Positive로 나뉘어져 있었습니다.<br><br>
                    총 160만개의 트윗이며 각각의 감정은 80만개씩 존재합니다.<br><br>

                    <h3 class="review_list_title">② 특정 사용자가 쓴 글 조회하기</h3>
                    form 태그를 이용해 특정 사용자가 쓴 글만 조회할 수 있도록 쿼리를 구성하였고,<br><br>
                    이 쿼리를 바탕으로 해당 사용자가 작성한 트윗의 감정 분포를 알아볼 수 있었습니다.<br><br>
                    예를 들어 'Karoli'이라는 사용자는 작성한 50개의 트윗 중 <br><br>
                    17개가 Negative였으며, 33개가 Positive인 것으로 보아 <br><br>
                    부정적인 트윗보다는 긍정적인 트윗을 많이 작성하는 사람이라고 생각할 수 있을 것입니다.<br><br>
                    
                    <h3 class="review_list_title">③ 특정 단어가 포함된 트윗 조회하기</h3>
                    마찬가지로 form 태그를 이용해 특정 단어가 포함된 트윗을 조회할 수 있도록 구성하였습니다.<br><br>
                    이 쿼리를 바탕으로, 특정 단어가 포함된 트윗의 감성 분포를 알아볼 수 있습니다.<br><br>
                    예를 들어, 'sad'라는 단어가 포함된 트윗은 총 27,300개의 트윗 중 25,164개가 Negative인 트윗인 것으로 보아<br><br>
                    예상대로 'sad'가 들어간 트윗은 대부분 부정적인 느낌을 보인다고 생각할 수 있습니다.<br><br>
                    <br>
                    또 이 부분에서는 특히 디테일에 신경을 많이 썼는데,<br><br>
                    특정 단어가 포함된 트윗은 보통 target이 0인, Negative 부터 정렬됩니다. <br><br>
                    때문에 dataset에 Next 버튼을 구성해놓았다 하더라도, 이를 Positive 까지 넘기기에는 오랜 시간이 걸릴 수 있기 때문에<br><br>
                    '결과 내 감정 재검색' 기능을 만들어,<br><br>
                    특정 단어가 포함된 트윗을 검색한 결과 중 negative, positive 결과만 따로 또 필터링할 수 있도록 했습니다.<br><br>

                </span>
                <br><hr>

                <h2 class="review_subtitle"> 3. 동작 화면 소개</h2>
                동작화면을 녹화한 링크는 아래와 같습니다.
                (링크 첨부)
                <br><br>

                <h2 class="review_subtitle"> +) 어려움 및 극복과정</h2>
                배운 것을 바탕으로 백지부터 시작한 과제이기 때문에 굉장히 시행착오가 많았습니다. <br><br>
                그래도 역시 직접 오류를 해결해나가는 것이 가장 빨리 실력이 느는 길임을 몸소 느꼈습니다. <br><br>
                겪었던 어려움과 극복을 간단하게 시간순서대로 정리해보겠습니다.<br><br>
                <br>

                <h3 class="review_list_title">① MariaDB 포트 변경</h3>
                Window를 선택하고 보니, window에서는 bitnami 세트를 설치하면서 Mysql를 사용했었지! 생각이 났습니다.<br><br>
                그러면 MariaDB는 어떻게 사용하지? 비트나미에서는 Mysql만 지원하는거 아닌가?! 했지만<br><br>
                여러가지 검색결과, MariaDB를 사용하고 싶으면 포트 번호를 Mysql이 사용하는 것 다음 것인 3307로 설정하면 된다는 글을 보았고<br><br>
                이를 바탕으로 이 문제는 비교적 쉽게 해결할 수 있었습니다<br><br>

                <h3 class="review_list_title">② Kaggle Data Infile 문제</h3>
                Kaggle 데이터를 다운받아 로컬 컴퓨터에 csv 파일로 가지고는 있는데, 이걸 어떻게 MariaDB에 보내지? 했습니다.<br><br>
                또 여러가지 검색 결과, load infile 문을 바탕으로 가능하다는 글을 보았고 여러가지 예제를 찾아보았는데 <br><br>
                된 것 같으면서도 막상 MariaDB 내에서 Select 해보면 target이 0으로만 불러진다든지, 160만개의 행이 다 불러지지 않는다든지, <br><br>
                등의 다양한 문제가 발생했습니다. 원인을 알 수가 없어 매우 답답했지만 다양한 예제를 바탕으로 <br><br>
                내 데이터 셋에 맞는 옵션들을 이리저리 조절하면서 찾음으로써 해결할 수 있었습니다. <br><br>
                [최종 쿼리문] <br><br>
                LOAD DATA LOCAL INFILE 'C:/..twit.csv' INTO TABLE twit COLUMNS TERMINATED BY ',' IGNORE 1 LINES;<br><br>
                <br>
                <h3 class="review_list_title">③ NEXT, BACK 버튼 만들기 - PAGING 문제</h3>
                여기서 진짜 눈물이 찔끔 났습니다.. 페이징 정말 어려웠어요 <br><br>
                또 제 원래 데이터셋에는 따로 행 번호가 기록된 ID 컬럼이 없었기 때문에 한참을 헤매었습니다. <br><br>
                페이징 자체에 필요한 변수나 계산 등도 너무 많고, <br><br>
                일단 대부분 ROW NUMBER을 사용해서 @ROWNUM:=0인가 하는 여러가지 쿼리문도 구성해보고 <br><br>
                정말 다채로운 시도를 반복하다 결국 데이터셋 내의 행번호를 쓰지 않는 방식으로 페이징을 서툴게 구현할 수 있었지만<br><br>
                페이징이 잘 되고 있음을 확인하기 위해서는 결국 행 번호가 필요하더군요..<br><br>
                <br>
                PYTHON의 PANDAS 라이브러리를 바탕으로 필요없는 컬럼을 제거하고, <br><br>
                행 번호(INDEX)와 같은 필요한 행은 추가하는 방향으로 원본 데이터 파일을 수정하고 <br><br>
                다시 로드함으로써 원본 데이터에 행번호를 추가할 수 있었습니다.<br><br>
                페이지 넘버(1page, 2page...Npage)가 전부 다 출력되면 좋겠지만 아직 실력이 부족하여<br><br>
                지금은 총 행의 개수 출력 및 이전(BACK)/다음(NEXT) 버튼 구현해놓는 것으로 만족해야겠습니다.<br><br>
                <br><br>

                <h2> +) 참고자료 </h2> 
                <div class="reference_a">
                    <h3><a href="https://engineering.stanford.edu/magazine/article/researchers-look-fruit-fly-help-understand-human-brain">프레임에 사용된 뇌 이미지</a></h3>
                    <h3><a href="https://jang2r.tistory.com/43">페이징을 위한 행 번호 넣기</a></h3>
                    <h3><a href="https://lkg3796.tistory.com/62">페이징 참고자료 1</a></h3>
                    <h3><a href="https://yonoo88.tistory.com/62">페이징 참고자료 2</a></h3>
                    <h3><a href="https://m.blog.naver.com/PostView.nhn?blogId=rwans0397&logNo=220696890907&proxyReferer=https:%2F%2Fwww.google.com%2F">CSS 버튼 디자인 소스</a></h3>
                    <h3><a href="https://webdir.tistory.com/432">Select문 디자인 소스</a></h3>
                    <h3><a href="https://stackoverrun.com/ko/q/10127828">Select문 선택된 항목 변수에 전달</a></h3>
                </div>
            </div>
            </div>
        </div>
    </body>
</head>
</html>
