<?php session_start();
if (!empty($_SESSION['logged_in']))
{
  $_SESSION['logged_in'] = true;
  $con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error()); 
    $username=$_SESSION['username'] ;
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

<form class="navbar-form navbar-left" role="search" action="allusers.php" style="position:absolute; RIGHT:40%;" method="POST">
     <div class="form-group">
      <input type="text", name="keyword1" style="text-align: center", class="form-control" required = "required" placeholder="Search Users">
     </div>
    <button type="submit" class="btn btn-primary" name="to_do" value="search_in">Search</button>
</form></br></br></br>


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

print "<div class='container'; style='position:absolute; left:10px'>";


if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if($_POST['to_do'] == "search_in"){
	$keyword1=mysqli_real_escape_string($con,$_POST['keyword1']);
	$query= "select userid,ucity from users where userid like '%".$keyword1."%'";
  }
}
else
{
  $query= "select userid,ucity from users";
}

$result=mysqli_query($con,$query);
    if (mysqli_num_rows($result) == 0)
      {
        print "<h4>Nothing matching your search criteria was found</h4>";
        print "<h4>Please refine your search</h4>";
      }
      else
      {
    print "<h3>All Users: </h3>";
    print "<table class='table table-bordered table-hover' style='text-align:center;width:95%'>

        <col style='width:25%'>
        <col style='width:55%'>
        <col style='width:15%'>
       
        <thead>";
      
    print "<tr class='info'>";
    print "<th style='text-align:center' >User Name</th>";
    print "<th style='text-align:center'>City of Residence</th>";
    print "<th style='text-align:center'> </th>";
    print "</tr>";

    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
        $uid= $row['userid'];
        $ucity=$row['ucity'];

        print "<tr>";
        print "<td><a href='Users.php?user=".$uid."'target='_top'>".$uid."</td>";
        print "<td>".$ucity."</td>";
        print "<td>";
       
        $query2 = "select count(*) from follows where userid='$username' and flid = '$uid'";
        $result2=mysqli_query($con,$query2); 
        while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
          {
            $count = $row2['count(*)']; 
          }
            if($count >= 1)
            {
                print "<form class='form-horizontal' action='follow.php' method='POST'>
                <input type='hidden' name='follow_parameter' value='".$uid."'>
                <button  type='submit' class='btn btn-info' name= 'to_do' value= 'unfollow'>Unfollow!</button></form>";
			}
            else
            {
                print "<form class='form-horizontal' action='follow.php' method='POST'>
                <input type='hidden' name='follow_parameter' value='".$uid."'>
                <button  type='submit' class='btn btn-info' name= 'to_do' value= 'follow'>Follow!</button></form>";
            }
          
        
        print "</td>";
 

  
    }
  }
    print "</div>";  






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
