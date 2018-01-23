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
                      <input type="text", name="keyword" style="text-align: center", class="form-control" required = "reduired" placeholder="Search Music">
                   </div>
                     <button type="submit" class="btn btn-default" name="to_do" value = "search">Search</button>
                   </form>
              
                </div>
              </div>
            </nav>

          <div class="container"; style="max-width: 500px">
          <form class="form-horizontal" action="login.php" method="POST">
          <fieldset>
          <div class="col-sm-offset-2 col-sm-10">
            <legend>Log In</legend>
           </div> 
            <div class="form-group">
               <label class="control-label col-sm-2" for="email">Username:</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pwd">Password:</label>
              <div class="col-sm-10">          
              <input type="password" class="form-control" id="pwd" placeholder="Password" type="password" name="password" required>
            </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="reset" class="btn btn-default">Cancel</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Log In!</button>
              </div>
            </div>
            <input type="hidden" name="to_do" value="login_page">
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
	}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
 $con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error()); 

  if($_POST['to_do']=='login_page')
  {
    $username=mysqli_real_escape_string($con,$_POST['username']);

    $_SESSION['username'] = $username;
    $password=mysqli_real_escape_string($con,$_POST['password']);
	$queryhash = "select password('$password') as hash_pw";
	$resulthash= mysqli_query($con,$queryhash);
	while($rowhash = mysqli_fetch_array($resulthash,MYSQLI_ASSOC)) 
	{
		$password = $rowhash['hash_pw'];
	}	
  }
  else
  {
    $username=$_SESSION['username'] ;
  }
  if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $username))
    {
      Print '<script>alert("Please enter Characters or Numbers only");</script>'; 
        exit;
    }
  
  $_SESSION['logged_in'] = false;
  $user_exists=false;
  $password_not_matched=false;

  $query = "select userid,password from users";
  $result=mysqli_query($con,$query);

  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
  {
    $table_users = $row['userid'];
    if($username == $table_users)
    {
      $user_exists = true;
      $table_password = $row['password'];
          if($password != $table_password)
          {
            $password_not_matched = true;
          }
          break;
    }
  }

  if($user_exists == false)
  {
    print '<script>alert("Username does not exist, please register or try again!!!");</script>';
    Print '<script>window.location.assign("login.php");</script>';
  }

  if($password_not_matched == true)
  {
    print '<script>alert("Password does not match!!!");</script>';
    Print '<script>window.location.assign("login.php");</script>';
  }
  $_SESSION['logged_in'] = true;
  Print '<script>window.location.assign("first_page.php");</script>';
} 
?>
