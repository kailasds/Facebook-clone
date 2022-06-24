<link rel="stylesheet" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section>
    <div class="update">
<?php
session_start();
$id = $_SESSION["id"];
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "select * from signup where id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<h3><center>UPDATE PROFILE</center></h3>
        <img src="<?php echo $row["img"]; ?>" width="100px" height="100px">
        <?php echo $row["fname"]; ?>
        <form action="dashboard.php" method="POST" enctype="multipart/form-data">
<br>Image
            <input type="file" id="num3" name="image">
            <input type="submit" name="submit" value="submit">
        </form>
        <form>
            <table>
                <br>
                <tr>
                    <td>Email or PhNo</td>
                    <td><input type="text" id="num1" value="<?php echo $row["emph"]; ?>"></td>
                </tr>
                <tr>
                    <td><button class="myButton3" id="btn1">Update</button></td>
                </tr>
            </table>
        </form>
        <p id="result"></p>

        <script>$("#btn1").click(function () {
                num1 = document.getElementById("num1").value;
                $.ajax({
                    url: "update.php",
                    type: "post",
                    datatype: "json",
                    data: {
                        num1: num1
                    },
                    success: function (result) {
                        alert("success");
                        $("#result").html(result);
                    }
                })
            })
        </script>
<br><br>
<h3><center>YOUR FRIENDS</center></h3>
<?php
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql4 = "select * from friends_list inner join signup on signup.id=friends_list.person2_id where person1_id='$id'  ";
$result3 = mysqli_query($conn, $sql4);
while ($rows3 = mysqli_fetch_array($result3)) {
    ?>
        <img src="<?php echo $rows3["img"]; ?>" width="100px" height="100px" >
            <?php echo $rows3["fname"]; ?>&emsp;&emsp;&emsp;
            <br>
<?php }
?>
        </div>
    </section>
