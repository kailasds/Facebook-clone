<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="signup.css">
</head>
<script>
function validate()
{
var x=document.form.email.value;
var atposition=x.indexOf("@");
var dotposition=x.lastIndexOf(".");
if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){
  alert("Please enter a valid e-mail address");
  return false;
  }

var name=document.form.fname.value;
var password=document.form.password.value;

if (name==null || name==""){
  alert("Name can't be blank");
  return false;
}else if(password.length<6){
  alert("Password must be at least 6 characters long.");
  return false;
  }
}
</script>
<body>
  <div class="col-form">
    <form name="form" action="signup.php" method="POST" onsubmit="return validate();">
      <div class="form-container">
        <h2>Sign up</h2>
        <h3>It's quick and easy.</h3>
        <input type="text" id="fname" name="fname" placeholder="First name">
        <input type="text" id="sname" name="sname" placeholder="Sur name">
        <input type="text" name="email" placeholder="Email address">
        <input type="password" name="password" placeholder="New Password">
        <input type="date" name="dob">
      </div>
      <div class="question">
        <label>Gender</label>
        <div class="question-answer">
          <div>
            <input type="radio" value="male" id="radio_4" name="gender" />
            <label for="radio_4" class="radio"><span>Male</span></label>&emsp;
          </div>
          <div>
            <input type="radio" value="female" id="radio_5" name="gender" />
            <label for="radio_5" class="radio"><span>Female</span></label>
          </div>
        </div>
      </div>
      <p>By clicking Sign Up, you agree to our <a href="#">Terms,</a> <a href="#">Data Policy </a>and Cookie Policy. You
        may receive SMS notifications from us and can opt out at any time.</p>
      <input type="submit" class="btn-signup" value="Signup" name="Signup" >
    </form>
  </div>
</body>
</html>
