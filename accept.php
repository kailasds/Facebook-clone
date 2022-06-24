<?php

if (isset($_POST["accept"])) {
    session_start();
    $id = $_SESSION["id"];
    $sender_id = $_POST["sender_id"];
    $conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error());
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql2 = "update friend_request set status=0 where sender_id=$sender_id and receiver_id=$id";

    if (mysqli_query($conn, $sql2)) {
        $sql = "insert into friends_list(person1_id,person2_id,status) values('$sender_id','$id','1')";
        $result2 = mysqli_query($conn, $sql);
        $sql3 = "insert into friends_list(person1_id,person2_id,status) values('$id','$sender_id','1')";
        $result3 = mysqli_query($conn, $sql3);
        ?>
                <script>
                  alert('Accepted Successfully');
                  document.location.href = 'dashboard.php'
                </script>

              <?php
} else {
        echo mysqli_error($conn);
    }
}

?>
<?php?>