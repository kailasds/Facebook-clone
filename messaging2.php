<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php
include "header.php";
include "sidebar.php";
session_start();
$id = $_SESSION["id"];
unset($_SESSION['fid']);
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql4 = "select * from friends_list inner join signup on signup.id=friends_list.person2_id where person1_id='$id'  ";
$result2 = mysqli_query($conn, $sql4);?>
<div>
  <center>
 <form action="chat2.php" method="POST">
<table>
  <tr><td>
  <label >Choose friend:</label></td><td>
  <select name="friend">
 <?php while ($rows2 = mysqli_fetch_array($result2)) {
    ?>
    <option value="<?php echo $rows2['id']; ?>"><?php echo $rows2['fname']; ?></option>
   <?php }
?>
  </select></td></tr><br><br>
  <tr><td>
</table><br>
  <input type="submit" name="submit" value="submit">
</form>
 </center>
</div>