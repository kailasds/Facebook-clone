<?php

if (isset($_POST["request"])) {
    session_start();
    $id = $_SESSION["id"];
    $sender_name = $_POST["sender_name"];
    $receiver_id = (int) $_POST["receiver_id"];
    $img = $_POST["img"];
    $conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error());
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql2 = "insert into friend_request (sender_id,receiver_id,sender_name,img,status) values ('$id', '$receiver_id','$sender_name' , '$img' , '1')";

    if (mysqli_query($conn, $sql2)) {
        ?>
                <script>
                  alert('Requested Successfully');
                  document.location.href = 'dashboard.php'
                </script>

              <?php
} else {

        echo mysqli_error($conn);

    }
}
?>
<?php?>
