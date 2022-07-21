<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
 
        <title>Tuts+ Chat Application</title>
        <meta name="description" content="Tuts+ Chat Application" />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Welcome, <b></b></p>
                <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
            </div>
 
            <div id="chatbox"></div>
 
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" />
                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {});
        </script>
    </body>
</html>

* {
    margin: 0;
    padding: 0;
  }
   
  body {
    margin: 20px auto;
    font-family: "Lato";
    font-weight: 300;
  }
   
  form {
    padding: 15px 25px;
    display: flex;
    gap: 10px;
    justify-content: center;
  }
   
  form label {
    font-size: 1.5rem;
    font-weight: bold;
  }
   
  input {
    font-family: "Lato";
  }
   
  a {
    color: #0000ff;
    text-decoration: none;
  }
   
  a:hover {
    text-decoration: underline;
  }
   
  #wrapper,
  #loginform {
    margin: 0 auto;
    padding-bottom: 25px;
    background: #eee;
    width: 600px;
    max-width: 100%;
    border: 2px solid #212121;
    border-radius: 4px;
  }
   
  #loginform {
    padding-top: 18px;
    text-align: center;
  }
   
  #loginform p {
    padding: 15px 25px;
    font-size: 1.4rem;
    font-weight: bold;
  }
   
  #chatbox {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 10px;
    background: #fff;
    height: 300px;
    width: 530px;
    border: 1px solid #a7a7a7;
    overflow: auto;
    border-radius: 4px;
    border-bottom: 4px solid #a7a7a7;
  }
   
  #usermsg {
    flex: 1;
    border-radius: 4px;
    border: 1px solid #ff9800;
  }
   
  #name {
    border-radius: 4px;
    border: 1px solid #ff9800;
    padding: 2px 8px;
  }
   
  #submitmsg,
  #enter{
    background: #ff9800;
    border: 2px solid #e65100;
    color: white;
    padding: 4px 10px;
    font-weight: bold;
    border-radius: 4px;
  }
   
  .error {
    color: #ff0000;
  }
   
  #menu {
    padding: 15px 25px;
    display: flex;
  }
   
  #menu p.welcome {
    flex: 1;
  }
   
  a#exit {
    color: white;
    background: #c62828;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
  }
   
  .msgln {
    margin: 0 0 5px 0;
  }
   
  .msgln span.left-info {
    color: orangered;
  }
   
  .msgln span.chat-time {
    color: #666;
    font-size: 60%;
    vertical-align: super;
  }
   
  .msgln b.user-name, .msgln b.user-name-left {
    font-weight: bold;
    background: #546e7a;
    color: white;
    padding: 2px 4px;
    font-size: 90%;
    border-radius: 4px;
    margin: 0 5px 0 0;
  }
   
  .msgln b.user-name-left {
    background: orangered;
  }
  
  <?php
session_start();
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">Please type in a name</span>';
    }
}
 
function loginForm(){
    echo'
    <div id="loginform">
      <p>Please enter your name to continue!</p>
      <form action="index.php" method="post">
        <label for="name">Name &mdash;</label>
        <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="enter" value="Enter" />
      </form>
    </div>
    ';
}
?>

<?php
if(!isset($_SESSION['name'])){
    loginForm();
}
else{
?>
<div id="wrapper">
    <div id="menu">
        <p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>
        <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
    </div>
 
    <div id="chatbox">
    <?php
    if(file_exists("log.html") && filesize("log.html") > 0){
         
        $contents = file_get_contents("log.html");
        echo $contents;
    }
    ?>
    </div>
 
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" />
        <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
    </form>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
});
</script>
<?php
}
?>

<p class="welcome">Welcome, <b><?php echo $_SESSION['name']; ?></b></p>

<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
    //If user wants to end session
    $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the session?");
        if(exit==true){window.location = 'index.php?logout=true';}      
    });
});
</script>

if(isset($_GET['logout'])){ 
     
    //Simple exit message
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> has left the chat session.</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
     
    session_destroy();
    header("Location: index.php"); //Redirect the user
}

//If user submits the form
$("#submitmsg").click(function () {
    var clientmsg = $("#usermsg").val();
    $.post("post.php", { text: clientmsg });
    $("#usermsg").val("");
    return false;
});
