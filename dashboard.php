<?php
session_start();
$mysql_host = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_database = 'facebook';
$id = $_SESSION["id"];

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $var = 0;
        } else {
            echo $_FILES["image"]["tmp_name"];
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $statement = $mysqli->prepare("update signup set img='$target_file' where id='$id'");
    if ($statement->execute()) {
        ?>
	<script>
		alert('Values have been inserted.Now Sign In');
	</script>
<?php
} else {
        ?>
	<script>
		alert('Values did not insert');
	</script>
<?php
}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>


<body>
    <?php include "header.php";?>
    <?php include "sidebar.php";?>
    <h2><center>Suggestions</center></h2>
<?php
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select * from signup left join friends_list on signup.id=friends_list.person1_id  where signup.id!='$id' ";
$result = mysqli_query($conn, $sql);
while ($rows = mysqli_fetch_array($result)) {
    if ($rows['person1_id'] != null) {continue;}
    ?>
    <table style="padding: 20px;">
        <form action="request.php" method="POST">
        <img src="<?php echo $rows["img"]; ?>" width="100px" height="100px" >
            <?php echo $rows["fname"]; ?>&emsp;&emsp;&emsp;
            <input type="number" name="sender_id" value="id" hidden>
            <input type="number" name="receiver_id" value="<?php echo $rows['id']; ?>" hidden>
            <input type="text" name="sender_name" value="<?php echo $row['fname']; ?>" hidden>
            <input type="text" name="img" value="<?php echo $row['img']; ?>" hidden>
            <input type="submit" name="request" value="request">
        </form>
    </table>
   <?php }

?>

<?php
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql3 = "select * from friend_request where receiver_id='$id' and status!=0";
$result2 = mysqli_query($conn, $sql3);
$norow = mysqli_num_rows($result2);
if ($norow != 0) {
    ?>
<h2><center>Pending Requests</center></h2>
<?php }
while ($rows2 = mysqli_fetch_array($result2)) {
    ?>
        <form action="accept.php" method="POST">
        <img src="<?php echo $rows2["img"]; ?>" width="100px" height="100px" >
            <?php echo $rows2["sender_name"]; ?>&emsp;&emsp;&emsp;
            <input type="number" name="sender_id" value="<?php echo $rows2["sender_id"]; ?>" hidden>
            <input type="submit" name="accept" value="accept">
        </form>

   <?php }
?>
<center>

<a href="post.php" class="myButton5">POST</a>&emsp;&emsp;&emsp;
<a href="messaging.php" class="myButton5">CHAT</a>&emsp;&emsp;&emsp;
<a href="viewmessage.php" class="myButton5">VIEW MESSAGE</a>&emsp;&emsp;&emsp;
<a href="messaging2.php" class="myButton5">CHAT2</a>
</body>
</html>