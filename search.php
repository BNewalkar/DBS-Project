<?php session_start();
$con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error()); 
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
                  
                   <?php
                   if (! empty($_SESSION['logged_in']))
                    {
                      $username=$_SESSION['username'];
                      $_SESSION['logged_in'] = true;
                    ?>
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
                  <?php
                    }
                  else
                  { ?>
                   <ul class="nav navbar-nav navbar-right">
                    <li><a href="sign_up_page.php">Sign Up</a></li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php">Log In</a></li>
                   </ul>
                   <?php } ?>
                    <form class="navbar-form navbar-nav" role="search" action="" method="POST">
                   <div class="form-group">
                      <input type="text", name="keyword" style="text-align: center", class="form-control" required = "reduired" placeholder="Search Music">
                   </div>
                     <button type="submit" class="btn btn-default" name="to_do" value = "search">Search</button>
                   </form>
                </div>
              </div>
            </nav>

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

        if($_SERVER["REQUEST_METHOD"]=="GET")
        {
            $tags = $_GET['tag'];
			$_SESSION['tags'] = $tags;
        }
		else
		{
			$tags=$_SESSION['tags'] ;
		}  

		$query = "call search ('$tags')";
		$result = mysqli_query($con,$query);
		   
		if(mysqli_num_rows($result) == 0)
		{
			echo '<div style="width: 100%; margin-left: 70">';
			echo "<h3> No results matching $tags</h3>";
			echo "<h4> Please refine your search</h4>";
			echo '</div>';
		}
		else
		{
		
		echo '<div style="width: 100%; margin-left: 70">';
		echo "<h3> Search results for $tags </h3> </br>";
		

		echo '<table id="searchresult" class="table table-bordered table-hover" style="text-align:center;width:90%">
		<tr class="info">
		<th style="text-align:center">Song title</th>
		<th style="text-align:center">Play</th>
		<th style="text-align:center">Rate</th>
		<th  style="text-align:center">Average Rating</th>
		</tr>
		';	
		
		
		$con1=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error()); 
		
	
		while($row = mysqli_fetch_array($result,MYSQLI_BOTH))
			{
				echo '<tr>
				<td>';
				
				$trackid = $row['tid'];
				$url = "https://open.spotify.com/embed?uri=spotify:track:";
				$url .= $trackid;
				echo '
					<div>
					<iframe src='.$url.' width="300" height="100" frameborder="0" allowtransparency="true">
					</iframe>
					</div>
				';
				
				echo '
				</td>
				<td>';
				$PlayTrackID = "Play_";
				$PlayTrackID .= $trackid;
				
				$RateTrackID = "Rate_";
				$RateTrackID .= $trackid;
				
//				echo "$PlayTrackID";
				echo' <form action="" method="post" style="margin-up: -150px">
						<button type="submit" class="btn btn-primary" name="to_do" value='.$PlayTrackID.'> Play </button>
						<input type="hidden" name="user_id" value='.$username.'>
						<input type="hidden" name="track_id" value='.$trackid.'>              
						<input type="hidden" name="source" value="search">
						<input type="hidden" name="source_id" value="">
						</form>
					';
				
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{				
					
					if($_POST['to_do'] == "$PlayTrackID")	
					{
						$user_id = $_POST['user_id'];
						$track_id = $_POST['track_id'];
						$source = $_POST['source'];
						$source_id = $_POST['source_id'];
						$sql1 = "INSERT INTO plays (userid, tid, ptime, source, sourceid) VALUES ('$user_id', '$track_id', sysdate(), '$source', '$source_id')";
						// echo 'reached here';
						mysqli_query($con1, $sql1);
						/*if (mysqli_query($con1, $sql1)) {
							echo "Played <br><br>";
						} else {
								echo "Error: " . $sql1 . "<br>" . mysqli_error($con);
						}*/	
					}
					
					}
				
				
				echo '
				</td>
				<td>';
				
					echo '
					<form action="" method="post">
						<select name="score">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<input type="hidden" name="user_id" value='.$username.'>
						<input type="hidden" name="track_id" value='.$trackid.'>						
						</select>
					<button type="submit" class="btn btn-primary" name="to_do" value='.$RateTrackID.'>Submit Rating</button>
					</form>';
					
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{
						if($_POST['to_do'] == "$RateTrackID")	
						{
						$user_id = $_POST['user_id'];
						$track_id = $_POST['track_id'];
						$score = $_POST['score'];
							
						$queryR= "select * from rates where tid='$track_id' and userid='$user_id'";
						$resultR = mysqli_query($con1,$queryR); 
						if(mysqli_num_rows($resultR) != 0)
						{	
							$sqlR = "UPDATE rates SET score = $score, rtime = sysdate() WHERE userid = '$user_id' and tid = '$track_id'";
							//echo 'Update record';
							
						}
						else
						{
							//echo 'New record';
							$sqlR = "INSERT INTO rates (userid, tid, score, rtime) VALUES ('$user_id', '$track_id', $score, sysdate())";
						}							
						mysqli_query($con1, $sqlR);
						/*if (mysqli_query($con1, $sqlR)) {
							echo "Played <br><br>";
						} else {
								echo "Error: " . $sql1 . "<br>" . mysqli_error($con1);
						}*/
						}
					}
					
				echo '
				</td>
				<td>';
				
				$queryavgR= "select round(avg(cast(score as decimal)), 1) as avg_score from rates where tid='$trackid' group by tid";
				$resultavgR= mysqli_query($con1,$queryavgR);
				if(mysqli_num_rows($resultavgR) == 0)
				{
					echo '0';
				}
				else
				{	
					while($rowavgR = mysqli_fetch_array($resultavgR,MYSQLI_ASSOC)) 
					{
					$avg_score=$rowavgR['avg_score'];
					}
				echo "$avg_score";
				}
				echo '
				</td>
				</tr>';			
			}
			
/*		do
		{
			echo 'storing result <br />';
			mysqli_store_result($con);
		}
		while(mysqli_next_result($con)); */
		}
		echo '</table>';
		echo '</div>';
	
//		echo '</div>';				
		
?>
<?php 
}	
else
{
 	Print '<script>alert("Please login first!");</script>'; 
  	Print '<script>window.location.assign("index.php");</script>'; 
}
 ?>


</body>
</html>
