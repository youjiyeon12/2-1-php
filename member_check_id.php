<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px; /* h3 태그의 왼쪽에 여백을 줌 */
   border-left: solid 5px #edbf07; /* h3 태그의 왼쪽에 노란색 선을 그어줌 */
}
#close {
   margin:20px 0 0 80px; /* close 아이콘의 위치를 조정 */
   cursor:pointer; /* 마우스 커서를 손가락 모양으로 변경 */
}
</style>
</head>
<body>
<h3>아이디 중복체크</h3> <!-- 페이지 제목 -->
<p>
<?php
   $id = $_GET["id"]; // GET 방식으로 전달된 id 값을 변수 $id에 저장

   if(!$id) // id가 비어있는 경우
   {
      echo("<li>아이디를 입력해 주세요!</li>"); // 메시지를 출력하여 아이디를 입력하라는 안내
   }
   else
   {
      $con = mysqli_connect("localhost", "user1", "12345", "music"); // 데이터베이스에 연결

      $sql = "select * from members where id='$id'"; // 입력된 아이디와 동일한 id를 가진 데이터를 조회하는 SQL 쿼리
      $result = mysqli_query($con, $sql); // 쿼리를 실행하고 결과를 저장

      $num_record = mysqli_num_rows($result); // 결과 레코드 수를 저장

      if ($num_record) // 결과 레코드가 존재하는 경우
      {
         echo "<li>".$id." 아이디는 중복됩니다.</li>"; // 아이디가 중복되었다는 메시지 출력
         echo "<li>다른 아이디를 사용해 주세요!</li>"; // 다른 아이디를 사용하도록 안내
      }
      else
      {
         echo "<li>".$id." 아이디는 사용 가능합니다.</li>"; // 아이디가 중복되지 않았다는 메시지 출력
      }
    
      mysqli_close($con); // 데이터베이스 연결 종료
   }
?>
</p>
<div id="close">
   <img src="./img/close.png" onclick="javascript:self.close()"> <!-- 닫기 버튼 이미지 -->
</div>
</body>
</html>
