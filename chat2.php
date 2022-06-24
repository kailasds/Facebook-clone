<link rel="stylesheet" href="styles.css">
<script src="https://kit.fontawesome.com/a684c606ac.js" crossorigin="anonymous"></script>
<style>
.tb{
  width: 100%;
  margin-top: 40px;
}

.tb,.trow,.tdat,.thed {
  border: 0px solid black;
  border-collapse: collapse;

}


.tdatr{
    text-align: right;
}

.receiver{
	min-width: 60px;
	max-width: 400px;
	padding: 14px 18px;
    margin: 6px 8px;
	background-color:#dcf8c6;
	border-radius: 16px 16px 0 16px;
	border: 0px solid #443f56;
}

.sender {
	min-width: 60px;
	max-width: 700px;
	padding: 14px 18px;
    margin: 6px 8px;
	background-color: #ffffff;
	border-radius: 16px 16px 16px 0;
	border: 0px solid #54788e;
}

.sendtime{
  font-size: 14px;
  color: grey;
}
.receivetime{
  font-size: 14px;
  color: grey;
}

.msg-inputarea {
  display: flex;
  padding: 10px;
  border-top: var(--border);
  background: #eee;
  width: 736px;
}
.msg-inputarea * {
  padding: 10px;
  border: none;
  border-radius: 3px;
  font-size: 1em;
}
.msg-input {
  flex: 1;
  background: #ddd;
}

div.scroll {
                margin:4px, 4px;
                padding:4px;
                background-color:#e5ddd5;
                width: 40%;
                height: 710px;
                overflow-x: hidden;
                overflow-y: auto;
                text-align:justify;
            }

.tb2{
    width: 30%;
}

</style>
<?php
include "header.php";
include "sidebar.php";
session_start();
$id = $_SESSION["id"];

if ($_SESSION["fid"]) {
    $send = $_SESSION["fid"];
} else {
    $send = $_POST["friend"];
    $_SESSION["fid"] = $send;
}
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "select * from message where (receive_id='$id' and send_id='$send') or (receive_id='$send' and send_id='$id') order by time ";
$result = mysqli_query($conn, $sql);
?>
<center>
<div class="scroll">
<table class="tb">

<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
            <tr class="trow">
                <div>
                    <?php if ($row['receive_id'] == $id) {?>
                <td class="tdat"><div >
                    <div class="sender"><?php if ($row["message"]) {
        echo $row["message"];} else {
        echo '<img src="' . $row["img"] . '" width="100px" height="100px" >';
        ?>
       <a href="<?php echo $row["img"] ?>" download><i class="fas fa-download"></i></a>
       <?php
}
        ?></div>
                    <p class="sendtime"><?php echo $row["time"]; ?></p></div></td>
                <td class="tdat"></td>
                   <?php } else {?>
                    <td class="tdat"></td>
                    <td class="tdatr"><div></p>

                    <div class="receiver"><?php if ($row["message"]) {
        echo $row["message"];} else {
        echo '<img src="' . $row["img"] . '" width="100px" height="100px" >';

    }?></div>
                    <p class="receivetime"><?php echo $row["time"]; ?></div></td>
                <?php }?>
                </div>
            </tr>
 <?php
}?>

</table></div>
<table class="tb2">
<tr colspan="2"><td>
<form class="msg-inputarea" action="" method="POST">
    <input type="text" name="friend" value="<?php echo $send ?>" hidden>
    <input type="text" class="msg-input" name="user_text" placeholder="Enter your message...">&emsp;
    <input type="submit" name="send" value="Send">
  </form>
  </td></tr>
  <tr><td>
  <form action="insertimg.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="num3" name="image">
            <input type="text" name="friend" value="<?php echo $send ?>" hidden>
            <input type="submit" name="subimg" value="sub image">
        </form>
</td>
</tr>
</table>







<?php
if (isset($_POST["send"])) {
    session_start();
    $id = $_SESSION["id"];
    $receiver = $_POST["friend"];
    $message = $_POST["user_text"];
    $conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
//$time = date("h:i:sa");
    $sql2 = "insert into message(send_id,receive_id,message) values('$id','$receiver','$message')";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2) {
        ?>
              <script>
               // alert('Entered Successfully');
                location.replace("chat2.php");
               // document.location.href = 'chat2.php'
              </script>

            <?php
} else {
        echo mysqli_error($conn);
        ?>
    <script>
      alert('not Successfull');
      //document.location.href = 'chat2.php'
    </script>

  <?php

    }}
?>











