<?php session_start();

if (! empty($_SESSION['logged_in']))
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
			
          <!-- Bootstrap -->

         <link href="css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">         
		 <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">	
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
</nav>  </br>

          <div class="container"; style="max-width: 550px">
          <form class="form-horizontal" action="" method="POST">
          <fieldset>
          <div class="col-sm-offset-2 col-sm-10">
            <legend>Create a new playlist</legend>
           </div> 
            <div class="form-group">
               <label class="control-label col-sm-2" for="pltitle">Title:</label>
               <div class="col-sm-10">
                <input type="text" class="form-control" id="pltitle" placeholder="Enter Playlist Title" name="pltitle" required>
              </div>
            </div>
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="pltitle">Type:</label>
				<div class="col-sm-10">
				<select class="selectpicker" style="position:absolute; TOP:13px; " name="pltype">
					<option value="public"> Public </option>
					<option value="private"> Private </option>
				</select>
				</div>
			</div>	
			
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="reset" class="btn btn-default">Cancel</button>&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary" name="to_do" value="create_PL">Create Playlist</button>
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
	
		if($_POST['to_do'] == "create_PL")
		{

		$user_exists=false;
		$email_exists=false;
		$credit_card=true;
		$password_match=true;
		
		$con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error()); 
    
		
		$PlaylistTitle = mysqli_real_escape_string($con,$_POST['pltitle']);
		$PLType = mysqli_real_escape_string($con,$_POST['pltype']);
		
		// echo "$PlaylistTitle and $PLType and $username";
				
		$queryPL= "select (max(plid) + 1) as new_pl_id from playlists";
		$resultPL= mysqli_query($con,$queryPL);
		if(mysqli_num_rows($resultPL) == 0)
		{
			$PlaylistID = '1001';
		}
		else
		{	
			while($rowPL = mysqli_fetch_array($resultPL,MYSQLI_ASSOC)) 
			{
				$PlaylistID =$rowPL['new_pl_id'];
			}
			
		}
		
		// echo "<br><br>$PlaylistID";
		
		$sqlCPL = "INSERT INTO playlists (plid, pltitle, pldate, pltype, userid) VALUES ($PlaylistID, '$PlaylistTitle', DATE(sysdate()), '$PLType', '$username')";
		if(mysqli_query($con, $sqlCPL)){
		Print '<script>alert("Playlist '.$PlaylistTitle.' Successfully Created!");</script>'; 
//		Print '<script>alert("Click okay to continue!");</script>'; 
		Print '<script>window.location.assign("search_for_playlist.php?PlaylistID='.$PlaylistID.'");</script>';
		}
		else
		{
		//echo "Error: " . $sqlCPL . "<br>" . mysqli_error($con);	
		Print '<script>alert("Something went wrong!");</script>';
		}
		}
	}		
?>

<?php 
}	
else
{
 	Print '<script>alert("Please login first!");</script>'; 
  	Print '<script>window.location.assign("index.php");</script>'; 
}
 ?>