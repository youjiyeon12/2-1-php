<?php
// 세션 시작
session_start();
    
// 세션에서 사용자 정보 가져오기
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";
if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
else $userlevel = "";
?>		

<div id="top">
    <h3>
        <a href="index.php">GrooveHub</a> <!-- 사이트 로고 링크 -->
    </h3>
    <ul id="top_menu">  
<?php
// 로그인되지 않은 경우
if(!$userid) {
?>                
        <li><a href="member_form.php">회원 가입</a></li> <!-- 회원 가입 링크 -->
        <li> | </li>
        <li><a href="login_form.php">로그인</a></li> <!-- 로그인 링크 -->
<?php
// 로그인한 경우
} else if($userid && $userlevel == 1) {
    $userlevel_text = "관리자";
    $logged = $username."(".$userid.")님 [등급 : ".$userlevel_text."]"; // 로그인 정보 표시
?>
        <li><?=$logged?> </li>
        <li> | </li>
        <li><a href="logout.php">로그아웃</a></li> <!-- 로그아웃 링크 -->
        <li> | </li>
        <li><a href="member_modify_form.php">마이페이지</a></li> <!-- 정보 수정 링크 -->
<?php
// 뮤지션 등급 사용자인 경우
} else if($userid && $userlevel == 2) {
    $userlevel_text = "뮤지션";
    $logged = $username."(".$userid.")님 [등급 : ".$userlevel_text."]"; // 로그인 정보 표시
?>
        <li><?=$logged?> </li>
        <li> | </li>
        <li><a href="logout.php">로그아웃</a></li> <!-- 로그아웃 링크 -->
        <li> | </li>
        <li><a href="member_modify_form.php">마이페이지</a></li> <!-- 정보 수정 링크 -->
<?php
// 일반 사용자인 경우
} else if($userid && $userlevel == 9) {
    $userlevel_text = "일반";
    $logged = $username."(".$userid.")님 [등급 : ".$userlevel_text."]"; // 로그인 정보 표시
?>
        <li><?=$logged?> </li>
        <li> | </li>
        <li><a href="logout.php">로그아웃</a></li> <!-- 로그아웃 링크 -->
        <li> | </li>
        <li><a href="member_modify_form.php">마이페이지</a></li> <!-- 정보 수정 링크 -->
<?php
    }
?>               

<?php
// 관리자 등급 사용자인 경우
if($userlevel==1) {
?>
        <li> | </li>
        <li><a href="admin.php">관리자 모드</a></li> <!-- 관리자 모드 링크 -->
<?php
}
?>
</ul>
</div>
<div id="menu_bar">
    <ul>  
        <li><a href="index.php">HOME</a></li> <!-- 홈 링크 -->
        <li><a href="message_form.php">쪽지</a></li> <!-- 쪽지 링크 -->
        <li><a href="board_list.php">자유 게시판</a></li> <!-- 자유 게시판 링크 -->
        <li><a href="musicianboard_list.php">뮤지션 게시판</a></li> <!-- 뮤지션 게시판 링크 -->
        <li><a href="managerboard_list.php">공연 공지 게시판</a></li> <!-- 공연 공지 게시판 링크 -->
    </ul>
</div>
