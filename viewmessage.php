<link rel="stylesheet" href="styles.css">
<style>
.tb{
  width: 50%;
  margin-top: 40px;
}

.tb,.trow,.tdat,.thed {
  border: 0px solid black;
  border-collapse: collapse;
}
</style>
<?php
include "header.php";
include "sidebar.php";
session_start();
$id = $_SESSION["id"];
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "select * from message where receive_id='$id'";
$result = mysqli_query($conn, $sql);
?>
<center>
<table class="tb">
    <!-- <th class="thed"> Sender </th>
    <th class="thed"> Time </th>
    <th class="thed"> Message </th>
    <th class="thed"> Reply </th> -->
<?php
while ($row = mysqli_fetch_array($result)) {
    $var = $row["send_id"];
    $sql2 = "select * from signup where id='$var'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    ?>
            <tr class="trow">
                <td class="tdat"><?php echo $row2["fname"]; ?></td>
                <td class="tdat"><?php echo $row["time"]; ?></td>
                <td class="tdat"><?php echo $row["message"]; ?></td>
                <td class="tdat"><input type="submit" name="reply" value="reply"></td>
            </tr>
</table>
 <?php
}?>