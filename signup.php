<?php
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error());
$fname = $_POST["fname"];
$sname = $_POST["sname"];
$email = $_POST["email"];
$password = $_POST["password"];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$query = "INSERT INTO signup(fname,sname,emph,password,dob,gender) VALUES('$fname','$sname','$email','$password','$dob','$gender')";
if (mysqli_query($conn, $query)) {
    ?>
            <script>
              alert('Entered Successfully'); {
               document.location.href = 'index.html'
             };
            </script>

          <?php
} else {
    ?>
            <script>
              alert('Something went wrong.Try again');
            </script>
          <?php
}

?>
