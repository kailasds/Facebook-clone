<?php
session_start();
$email = $_POST["email"];
$password = $_POST["password"];

$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error());

if ($email && $password) {

    $sql = "select * from signup where emph = '$email' and password = '$password' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION["id"] = $row["id"];
        ?>
		<script>
			alert('Login successful'); {

				document.location.href = 'dashboard.php'
			};
		</script>

	<?php
} else {
        ?>
		<script>
			alert('Login failed');
		</script>
<?php

    }
} else {
    die("Please enter  email and Password!");
}

?>