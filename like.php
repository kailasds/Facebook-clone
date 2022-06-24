<?php
$image = $_POST["num2"];
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
$sql = "update post set likes = likes+1 where id='$image'";
$result = mysqli_query($conn, $sql);
$ret = "successfull";
echo $ret;
/*if (mysqli_error($conn)) {
echo mysqli_error($conn);
} else {

$ret = "successfull";
echo $ret;
}*/

?>
<?php ?>
