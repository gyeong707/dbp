<h1> 13주차 학습 회고 </h1>

13주차 회고록을 다음과 같은 순서로 작성합니다.<br>

동작화면은 [이것](https://drive.google.com/file/d/19NkVDpTDsP2_sgAT5h0Z1t4msNmfjA8A/view?usp=sharing)을 눌러주세요.

- 새로 배운 내용
- 문제 발생 / 고민 / 해결 과정
- 참고할만한 내용
- 회고 (+,-,!)
<br><br>

<h1> 1. 새로 배운 내용 </h1><br>

- JSP란 Java Server Page의 약자로 HTML 내부에 JAVA 코드를 입력하여 웹 서버에서 동적으로 웹 브라우저를 관리하는 언어이다.  
- 윈도우에서 JSP를 사용할 수 있게 도와주는 것이 톰캣이다.  
- 최근에는 많이 쓰지 않는다고 한다. (트렌디하지는 않다.  
- 하지만 기존에 개발된 많은 웹들이 JAVA와 JSP 기반으로 제작되었기 때문에 개발자로서 유지,보수 입장을 보았을 때 JSP 또한 반드시 공부해두어야 하는 부분이다. 

<br><br>

<h1> 2. 문제 발생 / 고민 / 해결 과정 </h1><br>
연결 드라이버 없음이 자꾸 떠서 왜 그런가 했다.  

슬랙에서 이것 저것 찾아보고, 데이터베이스를 껐다가 다시 켜보기도 했는데 잘 안됐다.  

그래서 구글에 자바 oracle 연동을 쳐서 이것저것 (그렇지만 이미 교수님 강의에서 배운 것과 같은) 애들을 체크해보았지만 안됐다.

강의에서 오라클 연결하는 부분 처음부터 다시 해봤는데도 안됐다. 

한 두시간은 씨름했다. 그러다 문득 왜 이생각을 못했지? 하며 교수님 코드를 복붙해서 돌려보았다. 되었다.

현기증이 날 것 같았다. 교수님이랑 똑같이 쓴 건데 왜 대체 안되는걸까? 하면서 하나하나 비교해봤는데도 다른 점을 찾을 수 없었다. 

결국 최후의 수단으로 텍스트를 비교하는 사이트를 찾아서 교수님 코드와 내 코드를 넣고 대체 어디가 다른지 봤다.

driver 정의 하는 부분에서 오타가 나있었다.  
String driver = "oracle.jdbc.driverOracleDriver";  
이 부분에서 driver.Oracle인데 driverOracle (.을 안적었다)

너무 슬프다. 절대 잊혀지질 않을 오류를 하나 또 배우게 된 것 같다.
<br><br>


<h1> 3. 참고할 만한 내용 </h1>
https://www.diffchecker.com/diff  

코드 뿐만 아니라 다양한 텍스트를 비교할 수 있는 사이트입니다.   
이걸 이제야 알게 된 것이 정말 아쉽습니다...

<br><br>

<h1> 4. 회고 (+, - , !) </h1>
- (+) : 금요일인데도 생각보다 사람들이 과제를 많이 제출하지 않은 모습이었다. 뭔가 상대적으로 일찍 듣는 기분이라 좋았다.
<br><br>
- (-) : 자바에 들어오고 나서 오류를 잡는 시간이 부쩍 많이 늘어나 힘이든다. 옛날에는 코드 한자 한자 같이 쳐 나가니까 오류잡기도 좋았는데 자바는 휙휙 지나가는 느낌이어서 따라가기가 조금 힘들고, 오류가 나도 어디서부터 어떻게 해결해야할 지도 모르는 느낌이라서 힘들었다. 
<br><br>
- (!) :  지난 시간 까지는 코드로 작성한 내용을 웹페이지에서 바로 확인할 수 없어서 와닿지가 않았는데, 오늘 직접 작성한 내용이 웹에서 어떻게 표현되는지 보니 훨씬 재밌게 느껴졌다.
<br><br>
<br><br>

오늘도 좋은 강의 감사합니다.


