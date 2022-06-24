<?php
session_start();
$id = $_SESSION["id"];
$email = $_POST["num1"];
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
$sql = "update signup set emph='$email' where id='$id'";
$result = mysqli_query($conn, $sql);
$ret = "successfull";
echo $ret;
?>
<?php ?>
