<script src="https://kit.fontawesome.com/a684c606ac.js" crossorigin="anonymous"></script>
<style>
    .msg-inputarea {
  display: flex;
  padding: 10px;
  border-top: var(--border);
  background: #eee;
  width: 736px;
}
.msg-inputarea * {
  padding: 10px;
  border: none;
  border-radius: 3px;
  font-size: 1em;
}
.msg-input {
  flex: 1;
  background: #ddd;
}

div.scroll {
                margin:4px, 4px;
                padding:4px;
                width: 40%;
                height: 710px;
                overflow-x: hidden;
                overflow-y: auto;
                text-align:justify;
            }



</style>

<?php
include "header.php";
include "sidebar.php";

session_start();
$id = $_SESSION["id"];
?><center>
<form class="msg-inputarea" action="insertpost.php" method="POST" enctype="multipart/form-data">
        <input type="file" class="msg-input" id="num3" name="image">
        <input type="submit" name="subimg" value="sub image">
</form>
  </center>


<?php
session_start();
$id = $_SESSION["id"];

$conn = mysqli_connect("localhost", "root", "", "facebook") or die(mysqli_error($conn));
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "select date,image,post.id,sender_id,likes from post left join friends_list on post.sender_id=friends_list.person2_id where friends_list.person1_id=$id   order by date ";
$result = mysqli_query($conn, $sql);?>
<center>
<div class="scroll">

  <?php
while ($row = mysqli_fetch_array($result)) {
    $send = $row['sender_id'];
    $sql2 = "select * from signup where id= $send ";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    echo '<img src="' . $row2["img"] . '" width="50px" height="50px" >';
    echo $row2["fname"];?>
    <br>
    <?php
echo $row['date'];
    ?>
    <br>
    <?php
echo '<img src="' . $row["image"] . '" style="border-radius:0%"; width="500px" height="500px" >';
    ?><br>
    <input type="number" id="num2" value="<?php echo $row["id"]; ?>" hidden>
    <button  id="btn2"><i class="far fa-thumbs-up" ></i></button>

<p id="result"><?php echo $row["likes"]; ?></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
$("#btn2").click(function () {
                num2 = document.getElementById("num2").value;
                $.ajax({
                    url: "like.php",
                    type: "post",
                    datatype: "json",
                    data: {
                        num2: num2
                    },
                    success: function (result) {
                        alert("success");
                        $("#result").html(result);
                    },
                    error: function(result){
                      alert(result);
                    }
                });
            })
          })
        </script>
<br><?php
}?>
</div>