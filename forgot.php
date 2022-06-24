<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->

<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
session_start();
$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST['sub'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    function generateNumericOTP($n)
    {

        // Take a generator string which consist of
        // all numeric digits
        $generator = "1357902468";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        // Return result
        return $result;
    }
    function mailto($adr, $otp)
    {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "dskailas2001@gmail.com";
        $mail->Password = "";
        $mail->IsHTML(true);
        $mail->AddAddress("dskailas2001@gmail.com", "recipient-name");
        $mail->SetFrom($adr, "from-name");
        $mail->AddReplyTo("dskailas2001@gmail.com", "reply-to-name");
        $mail->Subject = "OTP";
        $content = "<b>Your OTP is $otp</b>";
        $mail->MsgHTML($content);
        if (!$mail->Send()) {
            echo "<script>alert('Error while sending Email.');</script>";
            var_dump($mail);
        } else {
            echo "<script>alert('OTP sent.');</script>";
        }
    }
    $otp = generateNumericOTP(4);
    $_SESSION['username'] = $username;
    $_SESSION['otp'] = $otp;
    mailto($email, $otp);

    #echo "<script>alert('OTP is $otp');</script>;";
    echo "<script>alert('Change password now');window.location.href='forgot2.php'</script>";

}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Trendz Login Form Responsive Widget Template :: W3layouts</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords"
		content="Trendz Login Form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
    <script>
		function check(){
			pass1=document.getElementById('pass1').value;
			var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
			if(pass1.match(passw))
			{

			return true;
			}
			else
			{
			alert('Try password with correct format');
			return false;
}

		}
	</script>
	<!-- //Meta tag Keywords -->
	<!--/Style-CSS -->
	<link rel="stylesheet" href="css2/style.css" type="text/css" media="all" />
	<!--//Style-CSS -->
</head>

<body>
	<!-- /login-section -->

	<section class="w3l-forms-23">
		<div class="forms23-block-hny">
			<div class="wrapper">
				<h1>Saloon Management</h1>
				<!-- if logo is image enable this
					<a class="logo" href="index.html">
					  <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
					</a>
				-->
				<div class="d-grid forms23-grids">
					<div class="form23">
						<div class="main-bg">
							<h6 class="sec-one">Forgot password<h6>
							<div class="speci-login first-look">
								<img src="images2/user.png" alt="" class="img-responsive">
							</div>
						</div>
						<div class="bottom-content">
							<form action="forgot.php" method="post" onsubmit="return check()">

								<input type="email" name="email" class="input-form" placeholder="Your Email"
										required="required" />
                                <input type="text" name="username" class="input-form" placeholder="Username"
                                required="required" />
								<button type="submit" class="loginhny-btn btn" name='sub'>Get OTP</button>

							</form>

						</div>
					</div>
				</div>
				<div class="w3l-copy-right text-center">
					<p>© 2020 Trendz Login Form. All rights reserved | Design by
						<a href="http://w3layouts.com/" target="_blank">W3l</a></p>
				</div>
			</div>
		</div>
	</section>
	<!-- //login-section -->
</body>

</html>