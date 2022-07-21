<?
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
     
    $text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
     
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
}
?>

<div id="chatbox"><?php
if(file_exists("log.html") && filesize("log.html") > 0){
     
    $contents = file_get_contents("log.html");         
    echo $contents;
}
?></div>
