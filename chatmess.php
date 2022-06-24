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
                alert('Entered Successfully');
               // location.reload();
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