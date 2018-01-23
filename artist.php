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
    $artistname = $_GET['artist'];
	$queryaid= "select aid from artists where aname = '$artistname' limit 1";
	$resultaid=mysqli_query($con,$queryaid);
	while($rowaid = mysqli_fetch_array($resultaid,MYSQLI_ASSOC))  
	{
		$artist = $rowaid['aid'];
	}
	$_SESSION['artist'] = $artist;
  }
  else
  {
    $artist=$_SESSION['artist'] ;
  }

  
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
        if($_POST['to_do']=='like')
        {
         $query1= "insert into likes values('$username', '$artist', sysdate())";
         mysqli_query($con,$query1); 
         $_SESSION['artist'] =$artist;    
        }
		
		if($_POST['to_do']=='unlike')
        {
         $query1= "delete from likes where userid ='$username' and aid = '$artist'";
         mysqli_query($con,$query1); 
         $_SESSION['artist'] =$artist;    
        }
  } 
  
  

  print "<div class='container'; style='position:absolute; left:10px'>";
  print "<h3><b>Artist Info:</b></h3>";

  $query= "select artists.aid, aname, adesc, count(userid) lcount from artists, likes where artists.aid = '$artist' and artists.aid = likes.aid group by artists.aid, aname, adesc";
  $result=mysqli_query($con,$query); 
  $liked=false; 
  if(mysqli_num_rows($result) != 0)
  {	  
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
  { 
//      $aid = $row['aid'];
      $aname = $row['aname']; 
      $adesc = $row['adesc'];
      $lcount = $row['lcount'];      
   }
  }
  else
  {
	$query1= "select aid, aname, adesc, '0' as lcount from artists where artists.aid = '$artist'";
	$result1=mysqli_query($con,$query1); 
	  if(mysqli_num_rows($result1) != 0)
		{	  
			while($row = mysqli_fetch_array($result1,MYSQLI_ASSOC))  
			{ 
			//  $aid = $row['aid'];
				$aname = $row['aname']; 
				$adesc = $row['adesc'];
				$lcount = $row['lcount']; 
			}
		}
	}
			//	echo "$aname";
	

 /* $query= "select artists.aid, aname, adesc, count(userid) lcount from artists, likes where artists.aid = '$artist' and artists.aid = likes.aid group by artists.aid, aname, adesc";
  $result=mysqli_query($con,$query); 
  $liked=false;
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
  { 
//      $aid = $row['aid'];
      $aname = $row['aname']; 
      $adesc = $row['adesc'];
      $lcount = $row['lcount'];*/
      
      print "<table class='table table-bordered table-hover' style='width:40%'>
        <col style='width:5%'>
        <col style='width:10%'>
        <thead>
      <tr>
      <th>Artist Name: </th>
      <td><a href='artist.php?artist=".$aname."' target='_top'>".$aname."</a></td>
      </tr>
      <tr>
      <th>Artist Description:</th>
      <td>".$adesc."</td>
      </tr>
      <tr>
      <th>Number of likes </th>
      <td>".$lcount."</td>
      </tr>";
	  
	
	  print "<tr>
		<th>Related Artists:</th>";
		$query1= "
		select a1.aname as aname1, a2.aname as aname2 from `artists` a1, `artists` a2 where (a1.aid, a2.aid) in ( 
		select table1_l1_aid, table1_l2_aid from 
		(select tab1.l1_aid as table1_l1_aid, tab2.l2_aid as table1_l2_aid, (total_cnt - int_cnt) as union_cnt  from 
		(select l1_aid, l2_aid, (l1_count + l2_count) as total_cnt from 
			(select aid as l1_aid, count(userid) as l1_count from `likes` group by aid) l1, 
			(select aid as l2_aid, count(userid) as l2_count from `likes` group by aid) l2
		where l1_aid <> l2_aid) tab1,
		(select l1.aid as l1_aid, l2.aid as l2_aid, count(l1.userid) int_cnt from `likes` l1, `likes` l2 
			where l1.aid <> l2.aid and l1.userid = l2.userid group by l1.aid, l2.aid) tab2
			where tab1.l1_aid = tab2.l1_aid and tab1.l2_aid = tab2.l2_aid) table1,
		(select l1.aid as table2_l1_aid, l2.aid as table2_l2_aid, count(l1.userid) intersect_cnt from `likes` l1, `likes` l2 
			where l1.aid <> l2.aid and l1.userid = l2.userid group by l1.aid, l2.aid) table2
			where table1_l1_aid = table2_l1_aid and table1_l2_aid = table2_l2_aid and (intersect_cnt/union_cnt) >= 0.5)
		and a1.aname = '$aname'		
		";
		
		$result1=mysqli_query($con,$query1); 
		$temp1=0;
		while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
		{
			$relaname=$row1['aname2'];
			if($temp1==0)
			{
				print "<td><a href='artist.php?artist=".$relaname."' target='_top'>".$relaname."</a></td></tr>";
				$temp1=$temp1+1;
			}
			else
			{
				print "<tr><td></td><td><a href='artist.php?artist=".$relaname."' target='_top'>".$relaname."</a></td></tr>";
			}
		}
		if($temp1==0)
		{
			print "<td>None</td></tr>";
		}	
	  
      print "</table>";
  
  

	$query1= "select count(*) as counter1 from likes where userid='$username' and aid='$artist'";
    $result1=mysqli_query($con,$query1); 
    while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
    {
	  $counter1=$row1['counter1'];
    }
	if($counter1!=0)
    {
      $liked=true;
    }
    if($liked==true)
    {
      print "<form class='form-horizontal' action='artist.php' method='POST'>
      <input type='hidden' name='to_do' value='unlike'>

      <button  type='submit' class='btn btn-info'>Unike!</button></form>";
    }
    else
    { 
      print "<form class='form-horizontal' action='artist.php' method='POST'>
      <input type='hidden' name='to_do' value='like'>

      <button  type='submit' class='btn btn-info'>Like!</button></form>";
    }
	
echo '	
       <div class="container" style="width:100%">
		<div class="MostPlayedSongs" style="max-width=200px">
	';		
			
			echo '
			<h3> Most played songs </h3>
			';
			$query1 = "select tracks.tid, count(ptime) from tracks, plays where tracks.aid = '$artist' and tracks.tid = plays.tid group by tracks.tid order by count(ptime) desc limit 10";
			
			$result1=mysqli_query($con,$query1);
			if(mysqli_num_rows($result1) != 0 )
			{
			echo '<div style="overflow-x: auto; height: 300px">';	
			
			echo '
				<table align="center">
				<tr style="padding:20px">
				<td style="padding:10px">
			';
				
			while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
			{
				echo '<div style=" display: inline; float:left; height:150px">';
				$trackid = $row1['tid'];
					$url = "https://open.spotify.com/embed?uri=spotify:track:";
					$url .= $trackid;
					
					echo '
					<div>
						<iframe src='.$url.' width="240" height="100" frameborder="0" allowtransparency="true">
						</iframe>
					</div>
					';
					
					$PlayTrackID = "Play_";
					$PlayTrackID .= $trackid;
				
					$RateTrackID = "Rate_";
					$RateTrackID .= $trackid;
					
					echo' <form action="" method="post" style="margin-up: -150px">
							<button type="submit" class="btn btn-default" name="to_do" value='.$PlayTrackID.'> Play </button>
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
						mysqli_query($con, $sql1);
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
					<button type="submit" class="btn btn-default" name="to_do" value='.$RateTrackID.'>Submit Rating</button>
					</form>';
					
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
					
				echo '</div>';
			}
			
			echo '
				</td>
				</tr>
				</table>
			';
			
			echo '</div>';
			}
			else
			{
				echo 'None of this artist\'s songs are played';
			}	
	echo '</div></div>';  
    print"</div>";

}

else
{
   Print '<script>alert("Please login first!");</script>'; 
   Print '<script>window.location.assign("index.php");</script>'; 
}

 ?>

 </div>
    </body>
</html>
    