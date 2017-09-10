<?php
	include("config.php");
	session_start();
	$error="";
	$count=0;
	$result="";
	if($_POST){
		
		$myusername = mysqli_real_escape_string($db,$_POST['username']);
		$mypassword = mysqli_real_escape_string($db,$_POST['password']);
		$sql = "SELECT user_id FROM login WHERE user_name = '$myusername' and user_password = '$mypassword'";
		
		if($result = mysqli_query($db,$sql)){
			$count = mysqli_num_rows($result);
		}
		
		if($count == 1) {
			$_SESSION['current_username']=$myusername;
			$sql = "SELECT user_full_name FROM login WHERE user_name = '$myusername'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			$_SESSION['current_name'] = $row['user_full_name'];
			header("Location: Welcome.php");
		}else {
         $error = "Your UserName or Password is invalid";
		}
		
		/*if(count($errors) == 0){
			ob_start();
			exit(header('Location: Welcome.php'));
		}*/
	}
?>


<html lang="en">
<head>
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2 align="center">Login To Fantasy</h2>
  <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">UserName:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="username">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
      </div>
	  <p><?php echo "$error";?></p>
    </div>
  </form>
</div>

</body>
</html>
<?php
/*<html>
	<head>
		<h2 align="center">Welcome to tha login vro<h2>
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
			<label>UserName : </label>
			<input type="text" name = "username"><br>
			<label>Password : </label>
			<input type="password" name = "password"><br>
			<input type="submit" name="submit" value = "submit"><br>
		</form>
		<p><?php echo "$error";?></p>
	</body>
</html>*/
?>