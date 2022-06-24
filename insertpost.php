<?php
session_start();
$mysql_host = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_database = 'facebook';
$id = $_SESSION["id"];
// Check if image file is a actual image or fake image
if (isset($_POST["subimg"])) {
    $target_dir = "post/";
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

    $statement = $mysqli->prepare("insert into post(sender_id,image) values('$id','$target_file')");
    if ($statement->execute()) {
        ?>
	<script>
		alert('Values have been inserted');
        location.replace("post.php");
	</script>
<?php
} else {
        echo mysqli_error($mysqli);
        ?>
	<script>
		alert('Values did not insert');
	</script>
<?php
}}
?>