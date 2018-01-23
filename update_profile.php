<?php session_start();
if (! empty($_SESSION['logged_in']))
{
?>
<?php
$con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error());   
$username=$_SESSION['username'] ;
$query = "select uname,uemail,ucity from users where userid='$username'";
$result=mysqli_query($con,$query); 
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $uname = $row['uname']; 
      $uemail = $row['uemail']; 
      $ucity = $row['ucity'];
    }
?>
<html>
    <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
           <title>GrooveIt_Website</title>
         <link href="css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
       <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Things To Do <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                      <li><a href="update_profile.php", target="_top">Update Profile</a></li>
                      <li><a href="create_playlist.php", target="_top">Create Playlist</a></li>
                      <li><a href="manage_playlist.php", target="_top">Manage Playlist</a></li>
                      <li><a href="allartists.php", target="_top">View all Artists</a></li>
                      <li><a href="allusers.php", target="_top">View all Users</a></li>
             </ul>
           </li>
        </ul>
  

               <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Log Out</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
               <li><img src = "user2.png" alt="user pic" style="position:absolute; TOP:6px;RIGHT:-8px; "></li>
                <li><a href="Users.php?user=<?php echo $username?>"><b><?php echo $username?></b></a></li>
               </ul>
               <form class="navbar-form navbar-left" role="search" action="" method="POST">
               <div class="form-group">
                  <input type="text", name="keyword" style="text-align: center", class="form-control" required = "required" placeholder="Search Music">
               </div>
                 <button type="submit" class="btn btn-default" name="to_do" value = "search">Search</button>
               </form>
          
            </div>
          </div>
</nav> 

          <div class="container"; style="max-width: 1000px">
          <form class="form-horizontal" action="update_profile.php" method="POST">
          <fieldset>
          <div class="col-sm-offset-2 col-sm-10">
            <legend>Enter Your Details: </legend>
            <p style="font-size: 13px"> (Current Values are Dispalyed)</p>
           </div> 
            <div class="form-group">
               <label class="control-label col-sm-2" for="uname">Name:</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" name="uname" type="text" value="<?php echo $uname; ?>">
              </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="uemail">Email:</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" name="uemail" type="text" value="<?php echo $uemail; ?>">
              </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="ucity">City:</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" name="ucity" type="text" value="<?php echo $ucity; ?>">
              </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="password">Password:</label>
               <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder = "Password">
              </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-2" for="repassword">Retype:</label>
               <div class="col-sm-10">
                <input type="password" class="form-control" name="repassword" placeholder="Retype Password">
              </div>
            </div>
   
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="reset" class="btn btn-default">Cancel</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Update Profile!</button>
              </div>
            </div>
            
          </fieldset>
        </form>
        </div>


   

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

		$ucity=mysqli_real_escape_string($con,$_POST['ucity']);
    $uname=mysqli_real_escape_string($con,$_POST['uname']);
		$uemail=mysqli_real_escape_string($con,$_POST['uemail']);
		$password=mysqli_real_escape_string($con,$_POST['password']);
    $repassword=mysqli_real_escape_string($con,$_POST['repassword']);
    if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬]/", $ucity))
    {
      Print '<script>alert("Please enter Characters Only");</script>'; 
        exit;
    }
    if (preg_match("/[\'^£$%&*()}{#~?><>,|=_+¬-]/", $uemail))
    {
      Print '<script>alert("Please enter Characters or @ Only");</script>'; 
        exit;
    }
    if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $uname))
    {
      Print '<script>alert("Please enter Characters or Numbers only");</script>'; 
        exit;
    }


    if($password != $repassword) 
    {
      Print '<script>alert("Password must match");</script>'; 
      exit;
    }
   elseif(empty($password) && empty($repassword))
    {
      $query = "update users set ucity='$ucity', uname='$uname', uemail='$uemail' where userid='$username'";
    }
    else
    {
		$query = "update users set ucity='$ucity', uname='$uname', uemail='$uemail', password = '$password' where userid='$username'";
    }
		mysqli_query($con,$query); 

		Print '<script>alert("Successfully Updated your profile!");</script>'; 
    Print '<script>window.location.assign("update_profile.php");</script>'; 


}
?>
<?php 
 }
 else
 {
  Print '<script>alert("Please login first!");</script>'; 
  Print '<script>window.location.assign("index.php");</script>'; 
 }?>
 </div>
 </body>
</html>