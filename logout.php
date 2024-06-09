<?php
  session_start(); // 세션 시작
  
  // 세션 변수 삭제
  unset($_SESSION["userid"]); // 세션 변수 "userid" 삭제
  unset($_SESSION["username"]); // 세션 변수 "username" 삭제
  unset($_SESSION["userlevel"]); // 세션 변수 "userlevel" 삭제

  
  // 아래 내용은 메인 페이지로 이동하는 JavaScript 코드
  echo("
       <script>
          location.href = 'index.php'; // 메인 페이지(index.php)로 이동
         </script>
       ");
?>
