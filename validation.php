<?php
if (isset($_POST["submit"])) {

    function password($password)
    {
        $uppercase = preg_match('/[A-Z]/', $password);
        $lowercase = preg_match('/[a-z]/', $password);
        $number = preg_match('/[0-9]/', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 6) {
            echo "Pls make sure that you have included a uppercase,lowercase and a number in your password and it is min 6 char long <br>";
        } else {
            echo "password entered successfully<br>";
        }
    }

    function valid_email($email)
    {
        return (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)); //? false : true;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<center>
  <form action="validation.php" method="POST">
    <input type="text" name="num" placeholder="number">
    <input type="password" name="password" placeholder="password">
    <input type="email" name="email" placeholder="email">
    <input type="submit" name="sub">
  </form>
</center>
<?php
if (isset($_POST["sub"])) {
    $num = $_POST["num"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    password($password);
    if (valid_email($email)) {
        echo "Valid email address.<br>";
    } else {
        echo "Invalid email address.<br>";
    }
    valid_num($num);

}

?>


</body>
</html>
