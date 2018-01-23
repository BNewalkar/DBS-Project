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
</nav> 
</br>
    </body>
	
	<style>
	.list ul {
	list-style-type: none;
	}	
	
	</style> 
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

	print '<div style="margin-left: 60; margin-right: 80">';
//	print "<span class='header1'> Playlists created by $username </span>";
	
	print '<ul id="list" style="list-style-type: none">';
	
	$query1 = "select plid, pltitle from playlists where userid = '$username'";
    $result1=mysqli_query($con,$query1); 
	if(mysqli_num_rows($result1) == 0 )
	{
		print'<h2>No playlists are created</h2>';
	}
	else
	{	
    while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
    {
		print '<li>';
		$PlaylistID = $row1['plid'];
		$PlaylistTitle = $row1['pltitle'];	
	   $query3 = "select count(*) from playlisttracks where plid = '$PlaylistID'";	
	    $result3=mysqli_query($con,$query3); 
	    $flag  = false;
	   
	   while($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC))
	    {
	    	$count_of_tracks = $row3['count(*)'];
	    	if($count_of_tracks=="0")
	    	{
	    		$flag = true;
	    	}
	    }
		
		$AddToPL = "Add_";
		$AddToPL .= $PlaylistID;

		$DeletePL = "Delete_";
		$DeletePL .= $PlaylistID;

		print "<table class='table table-bordered table-hover'>
		<form action='' method = 'POST'>  <h3>Playlist 
			$PlaylistTitle </h3>
			
			<button type='submit' class='btn btn-primary' name='to_do' value = $AddToPL > Add Tracks </button> &emsp;&emsp;
			<button type='submit' class='btn btn-primary' name='to_do' value = $DeletePL > Delete Playlist </button>
			<input type='hidden' name='pl_id' value=$PlaylistID>
		</form>";
		if($flag)
		{
			print '<h5>Currently empty, you can add tracks above</h5>';
		}
		else
		{	
		print "<table class='table table-bordered table-hover'>
		<th class='info'>Song title</th>
		<th class='info'>Play</th>
		<th class='info'>Rate</th>
		<th class='info'>Average Rating</th>
		<th class='info'>Delete Track</th>"
		;}



		if($_SERVER["REQUEST_METHOD"]=="POST")
		{	
			if($_POST['to_do'] == "$AddToPL")				
			{
				$Playlist_ID = $_POST['pl_id'];
				Print '<script>window.location.assign("search_for_playlist.php?PlaylistID='.$Playlist_ID.'");</script>';
			}
			
			if($_POST['to_do'] == "$DeletePL")				
			{

				$Playlist_ID = $_POST['pl_id'];
				
				$safeoff = "SET SQL_SAFE_UPDATES = 0";
				$deltracks = "delete from playlisttracks where plid = '$Playlist_ID'";
				$delPL = "delete from playlists where plid = '$Playlist_ID'";
				
				mysqli_query($con, $safeoff);
				mysqli_query($con, $deltracks);
				mysqli_query($con, $delPL);

				echo "<meta http-equiv='refresh' content='0'>";
				
			}
			
		}

		
		$query2 = "select tid from playlisttracks where plid = $PlaylistID";
		$result2=mysqli_query($con,$query2);

		while($row2 = mysqli_fetch_array($result2,MYSQLI_BOTH))
		{
			$trackid = $row2['tid'];
			
			$url = "https://open.spotify.com/embed?uri=spotify:track:";
			$url .= $trackid;
			
			echo '<tr>';
			
			echo '
			<td class = "iframe">
				<iframe src='.$url.' width="240" height="100" frameborder="0" allowtransparency="true">
				</iframe>
			</td>					
			';
			
			$PlayTrackID = "Play_";
			$PlayTrackID .= $trackid;
			
			$RateTrackID = "Rate_";
			$RateTrackID .= $trackid;
			
			echo' 
				<td class = "playbutton">
				<form action="" method="post">
					<button type="submit" class="btn btn-primary" name="to_do" value='.$PlayTrackID.'> Play </button>
					<input type="hidden" name="user_id" value='.$username.'>
					<input type="hidden" name="track_id" value='.$trackid.'>							
					<input type="hidden" name="source" value="playlist">
					<input type="hidden" name="source_id" value='.$PlaylistID.'>
				</form>
				</td>  
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
					mysqli_query($con, $sql1);
				}
			}
			
			echo '
				<td class = "ratingbutton">
				<form action="" method="post">
					<select name="score" style="width:120px">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<input type="hidden" name="user_id" value='.$username.'>
						<input type="hidden" name="track_id" value='.$trackid.'>						
					</select> <br>		
					<button type="submit" class="btn btn-primary" name="to_do" value='.$RateTrackID.' style="width:120px">Submit Rating</button>
				</form>
				</td>	
			';
			
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{
				if($_POST['to_do'] == "$RateTrackID")	
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
			
			echo '<td class = "rating">';
			$queryavgR= "select round(avg(cast(score as decimal)), 1) as avg_score from rates where tid='$trackid' group by tid";
			$resultavgR= mysqli_query($con,$queryavgR);
			if(mysqli_num_rows($resultavgR) == 0)
			{
				echo "0.0";
			}
			else
			{	
				while($rowavgR = mysqli_fetch_array($resultavgR,MYSQLI_ASSOC)) 
				{
					$avg_score =$rowavgR['avg_score'];
					echo "$avg_score";
				}
				
			}
			echo '</td>';	
			
			echo '<td class = "deletebutton">';
			
			$DelTrackID = "Del_";
			$DelTrackID .= $trackid;

			echo '
			<form action="" method="post" style="margin-up: -150px">
				<button type="submit" class="btn btn-primary" name="to_do" value='.$DelTrackID.'> - </button>
				<input type="hidden" name="pl_id" value='.$PlaylistID.'>
				<input type="hidden" name="track_id" value='.$trackid.'> 					
			</form>';
			
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{
				if($_POST['to_do'] == "$DelTrackID")	
				{
				$pl_id = $_POST['pl_id'];
				$track_id = $_POST['track_id'];
					
				$sqlR = "delete from playlisttracks where plid = $pl_id and tid = '$track_id'";
											
				mysqli_query($con, $sqlR);

				echo "<meta http-equiv='refresh' content='0'>";

				}
			}

			echo '</td>';
			echo '</tr>';
		}
	
	print '</li>';
	}
	}
	print '</ul>';
	print '</div>';
?>

<?php 
}	
else
{
 	Print '<script>alert("Please login first!");</script>'; 
  	Print '<script>window.location.assign("index.php");</script>'; 
}
 ?>