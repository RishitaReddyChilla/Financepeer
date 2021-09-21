<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<link rel="stylesheet" href="registration.css" />
<style>
         .form{
        margin-left:30%;
        margin-top:40px;
        border: 5px solid black;
        align-content: center;
        padding:20px;
        width:400px;
    }
        </style>
</head>
<body>

    <div class="login">
<?php
require('db.php');
if (isset($_POST['username']))
{
    $var = 0;

    $username = stripslashes($_POST['username']);
	$username = mysqli_real_escape_string($conn,$username); 

    $Email = stripslashes($_POST['Email']);
    $Email = mysqli_real_escape_string($conn,$Email);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn,$password);


    if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
    {
        $msg = 'The Email you have entered is invalid, please try again.';
        echo $msg;
    }else{

        $query = "INSERT INTO `users` (`username`, `password`, `Email`) VALUES ('$username', '".md5($password)."', '$Email');"; 
        $result1 = mysqli_query($conn,$query);

        if($result1)
        {
            echo "<div class='form'>
            <h3>You are registered successfully.</h3>
            <br/>Click here to start <a href='start.php'>Login</a></div>";
        }
       

  }  
  $conn->close();
    
        }

else{
?>
<div class="form">
<h1>Register Here!!</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="username" required />
<input type="Email" name="Email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<br><br>
<input type="submit" name="submit" value="Click me to Register" />
</form>
</div>
<?php } ?>
</body>
</html>