<?php session_start();?>
<html>
    <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
           <title>GrooveIt_Website</title>

          <!-- Bootstrap -->
         
         <link href="css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
         
    </head>

    <body>
        <nav class="navbar navbar-default">
                <div class="container-fluid", style="background-color: #2c3e50">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.php">GrooveIt &nbsp;<b>|</b></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                   <ul class="nav navbar-nav">
                     <li><a href="explore.php">Explore</a></li>
                   </ul>
                   <ul class="nav navbar-nav">
                     <li><a href="aboutus.php">About Us</a></li>
                   </ul>
                    <ul class="nav navbar-nav">
                     <li><a href="first_page.php">Your World</a></li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right">
                    <li><a href="sign_up_page.php">Sign Up</a></li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php">Log In</a></li>
                   </ul>
                   <form class="navbar-form navbar-left" role="search" action="" method="POST">
                   <div class="form-group">
                      <input type="text" name="keyword" class="form-control" style="text-align: center" required = "reduired" placeholder="Search Music">
                   </div>
                     <button type="submit" class="btn btn-default" name="to_do" value = "search">Search</button>
                   </form>
              
                </div>
              </div>
            </nav>

          <div class="container"; style="max-width: 550px">
          <form class="form-horizontal" action="sign_up_page.php" method="POST">
          <fieldset>
          <div class="col-sm-offset-2 col-sm-10">
            <legend>Sign Up</legend>
           </div> 
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">Username:</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" id="username" placeholder="Unique Username" name="userid" required>
              </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">Name:</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" id="username" placeholder="Your Name" name="uname" required>
              </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">Email:</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" id="username" placeholder="Email" name="email" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">City:</label>
              <div class="col-sm-10">          
              <input type="text" class="form-control" id="pwd" placeholder="City of Residence" type="City" name="city" required>
            </div>
           </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Password:</label>
              <div class="col-sm-10">          
              <input type="password" class="form-control" id="pwd" placeholder="Password" type="password" name="password" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Retype:</label>
              <div class="col-sm-10">          
              <input type="password" class="form-control" id="pwd" placeholder="Retype Password" type="password" name="re_password" required>
            </div>
           </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="reset" class="btn btn-default">Cancel</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="to_do" value="create_account">Create Account</button>
              </div>
            </div>
          </fieldset>
        </form>
        </div>

    </body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{	
	if($_POST['to_do'] == "search")				
	{
		//echo "reached";
		$tag = $_POST['keyword'];
		//echo "$tag";
		Print '<script>window.location.assign("search.php?tag='.$tag.'");</script>';
	}
	
	if($_POST['to_do'] == "create_account")
	{	
		$user_exists=false;
		$email_exists=false;
		$credit_card=true;
		$password_match=true;
		
		$con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error()); 
		
		


		$username=mysqli_real_escape_string($con,$_POST['userid']);
		$uname=mysqli_real_escape_string($con,$_POST['uname']);
		$email=mysqli_real_escape_string($con,$_POST['email']);
		$email=strtolower($email);
		$password=mysqli_real_escape_string($con,$_POST['password']);
		$re_password=mysqli_real_escape_string($con,$_POST['re_password']);
		$city=mysqli_real_escape_string($con,$_POST['city']);
		$query = "Select userid,uemail from users";
		$result=mysqli_query($con,$query); 
		if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $username))
		{
			Print '<script>alert("Please enter Characters or Numbers only");</script>'; 
				exit;
		}
		if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $uname))
		{
			Print '<script>alert("Please enter Characters or Numbers only");</script>'; 
				exit;
		}


		
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
		{
			$table_users = $row['userid']; 
			if($username == $table_users) 
			{
				$user_exists = true; 
				Print '<script>alert("Username already present!");</script>'; 
				exit;
			}

			$table_email = $row['uemail']; 
			if($email == $table_email) 
			{
				$email_exists = true; 
				Print '<script>alert("Email Already Exists!");</script>'; 
				exit;
			}
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
  			Print '<script>alert("Enter email in valid format!");</script>';
  			exit;
		}	
		elseif($password != $re_password) 
		{
			$password_match=false;
			Print '<script>alert("Password must match");</script>'; 
			exit;
		}
		
		
		if($user_exists==false && $email_exists==false && $password_match==true)
		{
			$query = "insert into users values ('$username',password('$password'),'$uname','$email','$city')";
			mysqli_query($con,$query); 
			Print '<script>alert("Successfully Registered!");</script>'; 
			Print '<script>alert("Please login with the new credentials to continue!");</script>'; 
			Print '<script>window.location.assign("login.php");</script>'; 
		}
	}
}
?>