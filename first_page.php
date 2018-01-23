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
   
    <body align='center'>
	
	
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

       <div class="container" style="width:100%">
		<div class="MostPlayedSongs" style="max-width=200px" align='center'>		
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
				
			echo '
			<h3> Most played songs </h3>
			';
			$query1 = "select tid, count(ptime) from plays group by tid order by count(ptime) desc limit 10";
			
			$result1=mysqli_query($con,$query1);
			echo '<div style="overflow-x: auto; overflow-x: scroll height: 200px">
			<table width="100%" style="border-collapse: collapse;text-align: left;" >
			<tr>
			';
			while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
			{
				echo '<div style=" display: inline; float:left; height:150px">';
				$trackid = $row1['tid'];
					$url = "https://open.spotify.com/embed?uri=spotify:track:";
					$url .= $trackid;
					
					echo '
					<td style="padding:12px;">
					<td style="padding:8px">
					<div>
						<iframe src='.$url.' width="240" height="100" frameborder="0" allowtransparency="true">
						</iframe>
					</div>
					</td>					
					';
					
					$PlayMPSTrackID = "PlayMPS_";
					$PlayMPSTrackID .= $trackid;
				
					$RateMPSTrackID = "RateMPS_";
					$RateMPSTrackID .= $trackid;
					
					echo' 
						<td style="padding:8px">
						<form action="" method="post">
							<button type="submit" class="btn btn-primary" name="to_do" value='.$PlayMPSTrackID.'> Play </button>
							<input type="hidden" name="user_id" value='.$username.'>
							<input type="hidden" name="track_id" value='.$trackid.'>							
							<input type="hidden" name="source" value="search">
							<input type="hidden" name="source_id" value="">
						</form>
						</td>  
						';
					
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{
					if($_POST['to_do'] == "$PlayMPSTrackID")	
					{
						$user_id = $_POST['user_id'];
						$track_id = $_POST['track_id'];
						$source = $_POST['source'];
						$source_id = $_POST['source_id'];
						$sql1 = "INSERT INTO plays (userid, tid, ptime, source, sourceid) VALUES ('$user_id', '$track_id', sysdate(), '$source', '$source_id')";
						mysqli_query($con, $sql1);
 						/*if (mysqli_query($con, $sql1)) {
							echo "User $user_id has been registred succesfully <br><br>";
						} else {
								echo "Error: " . $sql1 . "<br>" . mysqli_error($con);
						}*/
					}
					}
					echo '
					<td style="padding:8px">
					<form action="" method="post">
						<select name="score" style="width:120px">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<input type="hidden" name="user_id" value='.$username.'>
						<input type="hidden" name="track_id" value='.$trackid.'>						
						</select>		
					<button type="submit" class="btn btn-primary" name="to_do" value='.$RateMPSTrackID.' style="width:120px">Submit Rating</button>
					</form>
					</td>	
					';
					
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{
					if($_POST['to_do'] == "$RateMPSTrackID")	
					{
						$user_id = $_POST['user_id'];
						$track_id = $_POST['track_id'];
						$score = $_POST['score'];
						
					$queryR= "select count(*) as counter1 from rates where tid='$track_id' and userid='$user_id'";
					$resultR=mysqli_query($con,$queryR); 
					while($rowR = mysqli_fetch_array($resultR,MYSQLI_ASSOC)) 
					{
						$counter1=$rowR['counter1'];
					}
					if($counter1!=0)
					{
						$sqlR = "UPDATE rates SET score = $score, rtime = sysdate() WHERE userid = '$user_id' and tid = '$track_id'";
					}
					else
					{
						$sqlR = "INSERT INTO rates (userid, tid, score, rtime) VALUES ('$user_id', '$track_id', $score, sysdate())";
					}	
					
					mysqli_query($con, $sqlR);
					
					}
					}
					
					echo '
					<td style="padding:8px">
					';
					$queryavgR= "select round(avg(cast(score as decimal)), 1) as avg_score from rates where tid='$trackid' group by tid";
					$resultavgR= mysqli_query($con,$queryavgR);
					if(mysqli_num_rows($resultavgR) == 0)
					{
						echo "Average Rating <br><br> 0.0";
					}
					else
					{	
						while($rowavgR = mysqli_fetch_array($resultavgR,MYSQLI_ASSOC)) 
						{
							$avg_score =$rowavgR['avg_score'];
							echo "Average Rating <br><br> $avg_score";
						}
						
					}
					echo '
					</td>
					</td>';
				echo '</div>';
			}				
			echo '
			</tr>
			</table>
			</div>';
		?>		
		</div>
        </div>	
		
		<br>
		<br>
		
       <div class="container" style="width:100%">
		<div class="RecentPlaylists" style="max-width="200px">
         <?php 

			
			echo '
			<h3> Most recent playlists you may like </h3>
			';
			$query1 = "select distinct plid, pltitle from playlists pl, users u, follows fl where fl.userid='$username' and u.userid = fl.userid and pltype = 'public' and pl.userid = fl.flid order by pldate desc limit 3";
			$result1=mysqli_query($con,$query1);
			echo '<div style="width: 100%; ">
			';
			if (mysqli_num_rows($result1) == 0)
			{
				echo "No likable playlists found";
			}
			
			while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
			{
				echo '<div style="float:left; width:33.33%; height:300px; overflow-y: auto">';
				$playlistid = $row1['plid'];
				$playlisttitle = $row1['pltitle'];
				
				echo '<h4>'.$playlisttitle.' </h4>';
				
				$query2 = "select pt.tid from tracks t, playlisttracks pt where pt.plid = $playlistid and pt.tid = t.tid";
				$result2=mysqli_query($con,$query2);
				
				echo '
				<table align="center">
				<tr style="padding:20px">
				<td style="padding:10px">
				';
				
				while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
				{
					$trackid = $row2['tid'];
					$url = "https://open.spotify.com/embed?uri=spotify:track:";
					$url .= $trackid;
					
					echo '
					<div>
						<iframe src='.$url.' width="300" height="100" frameborder="0" allowtransparency="true">
						</iframe>
					</div>
					';
					
					$PlayPLTrackID = "PlayPL_";
					$PlayPLTrackID .= $trackid;
				
					$RatePLTrackID = "RatePL_";
					$RatePLTrackID .= $trackid;
					
					echo' <form action="" method="post" style="margin-up: -150px">
							<button type="submit" class="btn btn-primary" name="to_do" value='.$PlayPLTrackID.'> Play </button>
							<input type="hidden" name="user_id" value='.$username.'>
							<input type="hidden" name="track_id" value='.$trackid.'>							
							<input type="hidden" name="source" value="playlist">
							<input type="hidden" name="source_id" value='.$playlistid.'>
							<br>
						  </form>
						';
						
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{
					if($_POST['to_do'] == "$PlayPLTrackID")
					{
						$user_id = $_POST['user_id'];
						$track_id = $_POST['track_id'];
						$source = $_POST['source'];
						$source_id = $_POST['source_id'];
						$sql1 = "INSERT INTO plays (userid, tid, ptime, source, sourceid) VALUES ('$user_id', '$track_id', sysdate(), '$source', '$source_id')";
						mysqli_query($con, $sql1);
 						/*if (mysqli_query($con, $sql1)) {
							echo "User $user_id has been registred succesfully <br><br>";
						} else {
								echo "Error: " . $sql1 . "<br>" . mysqli_error($con);
						}*/
					}
					}
					
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
					<button type="submit" class="btn btn-primary" name="to_do" value='.$RatePLTrackID.'>Submit Rating</button>
					</form>';
					
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{
					if($_POST['to_do'] == "$RatePLTrackID")	
					{
						$user_id = $_POST['user_id'];
						$track_id = $_POST['track_id'];
						$score = $_POST['score'];
						
					$queryR= "select count(*) as counter1 from rates where tid='$track_id' and userid='$user_id'";
					$resultR=mysqli_query($con,$queryR); 
					while($rowR = mysqli_fetch_array($resultR,MYSQLI_ASSOC)) 
					{
						$counter1=$rowR['counter1'];
					}
					if($counter1!=0)
					{
						$sqlR = "UPDATE rates SET score = $score, rtime = sysdate() WHERE userid = '$user_id' and tid = '$track_id'";
					}
					else
					{
						$sqlR = "INSERT INTO rates (userid, tid, score, rtime) VALUES ('$user_id', '$track_id', $score, sysdate())";
					}	
					
					mysqli_query($con, $sqlR);
					
					}
					}
					
					$queryavgR= "select round(avg(cast(score as decimal)), 1) as avg_score from rates where tid='$trackid' group by tid";
					$resultavgR= mysqli_query($con,$queryavgR);
					if(mysqli_num_rows($resultavgR) == 0)
					{
						echo "Average Rating: 0.0 <br><br><br><br><br><br>";
					}
					else
					{	
						while($rowavgR = mysqli_fetch_array($resultavgR,MYSQLI_ASSOC)) 
						{
							$avg_score =$rowavgR['avg_score'];
							echo "Average Rating: $avg_score <br><br><br><br><br><br>";
						}
						
					}
					
					
				}
				
				echo '
				</td>
				</tr>
				</table>
				';
				echo '</div>';
			}
			echo '</div>';
		?>		
		</div>
        </div>
		
		<br>
		<br>
		
       <div class="container" style="width:100%">
		<div class="RecentAlbums" style="max-width="200px">		
		<?php 

			
			echo '
			<h3> Most recent albums you may like </h3>
			';
			$query1 = "select distinct albums.albid, albtitle from albums, likes, albumtracks, tracks where likes.userid = '$username' and albumtracks.tid = tracks.tid and tracks.aid = likes.aid order by albdate limit 3";
			
			$result1=mysqli_query($con,$query1);
			echo '<div style="width: 100%; ">';
				
			if (mysqli_num_rows($result1) == 0)
			{
				echo "No likable albums found";
			}
			
			while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
			{
				echo '<div style="float:left; width:33.33%; height:300px; overflow-y: auto">';
				$albumid = $row1['albid'];
				$albumtitle = $row1['albtitle'];
				
				echo '<h4>'.$albumtitle.' </h4>';
				
				$query2 = "select at.tid from tracks t, albumtracks at where at.albid = '$albumid' and at.tid = t.tid";
				$result2=mysqli_query($con,$query2);
				
				echo '
				<table align="center">
				<tr style="padding:20px">
				<td style="padding:10px">
				';	
				
				while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
				{
					$trackid = $row2['tid'];
					$url = "https://open.spotify.com/embed?uri=spotify:track:";
					$url .= $trackid;
					
					echo '
					<div>
						<iframe src='.$url.' width="300" height="100" frameborder="0" allowtransparency="true">
						</iframe>
					</div>
					';
					
					$PlayALBTrackID = "PlayALB_";
					$PlayALBTrackID .= $trackid;
				
					$RateALBTrackID = "RateALB_";
					$RateALBTrackID .= $trackid;					
					
					echo' <form action="" method="post" style="margin-up: -150px">
							<button type="submit" class="btn btn-primary" name="to_do" value='.$PlayALBTrackID.'> Play </button>
							<input type="hidden" name="user_id" value='.$username.'>
							<input type="hidden" name="track_id" value='.$trackid.'>							
							<input type="hidden" name="source" value="album">
							<input type="hidden" name="source_id" value='.$albumid.'>
						  </form>
						';
					
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{
					if($_POST['to_do'] == "$PlayALBTrackID")	
					{
						$user_id = $_POST['user_id'];
						$track_id = $_POST['track_id'];
						$source = $_POST['source'];
						$source_id = $_POST['source_id'];
						$sql1 = "INSERT INTO plays (userid, tid, ptime, source, sourceid) VALUES ('$user_id', '$track_id', sysdate(), '$source', '$source_id')";
						mysqli_query($con, $sql1);
 						/*if (mysqli_query($con, $sql1)) {
							echo "User $user_id has been registred succesfully <br><br>";
						} else {
								echo "Error: " . $sql1 . "<br>" . mysqli_error($con);
						}*/
					}
					}
					
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
					<button type="submit" class="btn btn-primary" name="to_do" value='.$RateALBTrackID.'>Submit Rating</button>
					</form>';
					
					if($_SERVER["REQUEST_METHOD"]=="POST")
					{
					if($_POST['to_do'] == "$RateALBTrackID")	
					{
						$user_id = $_POST['user_id'];
						$track_id = $_POST['track_id'];
						$score = $_POST['score'];
						
					$queryR= "select count(*) as counter1 from rates where tid='$track_id' and userid='$user_id'";
					$resultR=mysqli_query($con,$queryR); 
					while($rowR = mysqli_fetch_array($resultR,MYSQLI_ASSOC)) 
					{
						$counter1=$rowR['counter1'];
					}
					if($counter1!=0)
					{
						$sqlR = "UPDATE rates SET score = $score, rtime = sysdate() WHERE userid = '$user_id' and tid = '$track_id'";
					}
					else
					{
						$sqlR = "INSERT INTO rates (userid, tid, score, rtime) VALUES ('$user_id', '$track_id', $score, sysdate())";
					}	
					
					mysqli_query($con, $sqlR);
					
					}
					}
					
					$queryavgR= "select round(avg(cast(score as decimal)), 1) as avg_score from rates where tid='$trackid' group by tid";
					$resultavgR= mysqli_query($con,$queryavgR);
					if(mysqli_num_rows($resultavgR) == 0)
					{
						echo "Average Rating: 0.0 <br><br><br><br><br><br>";
					}
					else
					{	
						while($rowavgR = mysqli_fetch_array($resultavgR,MYSQLI_ASSOC)) 
						{
							$avg_score =$rowavgR['avg_score'];
							echo "Average Rating: $avg_score <br><br><br><br><br><br>";
						}
						
					}
					
				}
				
				echo '
				</td>
				</tr>
				</table>
				';	
			echo '</div>';
			}
			echo '</div>';
		?>		
		</div>
        </div>
</body>
</html>
<?php 
}	
else
{
 	Print '<script>alert("Please login first!");</script>'; 
  	Print '<script>window.location.assign("index.php");</script>'; 
}
 ?>


