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
    $user = $_GET['user'];
    $_SESSION['user'] = $user;
  }
  else
  {
    $user=$_SESSION['user'] ;
  }


//$user = 'RBell';
  
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
        if($_POST['to_do']=='follow')
        {
         $query1= "insert into follows values('$username', '$user', sysdate())";
         mysqli_query($con,$query1); 
         $_SESSION['user'] =$user;    
        }
		
		if($_POST['to_do']=='unfollow')
        {
         $query1= "delete from follows where userid ='$username' and flid = '$user'";
         mysqli_query($con,$query1); 
         $_SESSION['user'] =$user;    
        }
  } 

  print "<div class='container'; style='position:absolute; left:10px'>";
  print "<h3><b>User Info:</b></h3>";
  $query= "select * from users where userid ='$user'";
  $result=mysqli_query($con,$query); 
  $followed=false;
  while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))  
  { 
      $userid = $row['userid'];
      $uname = $row['uname']; 
      $uemail = $row['uemail'];
      $ucity = $row['ucity'];
      
      print "<table class='table table-bordered table-hover' style='width:40%'>
        <col style='width:5%'>
        <col style='width:10%'>
        <thead>
      <tr>
        <th>Username:</th>
      <td><a href='Users.php?user=".$userid."' target='_top'>".$userid."</a></td>
      </tr>
      <tr>
      <th>User Name:</th>
      <td>".$uname."</td>
      </tr>
      <tr>
      <th>Email:</th>
      <td>".$uemail."</td>
      </tr>
      <tr>
      <th>City:</th>
      <td>".$ucity."</td>
      </tr>";

    print "<tr>
      <th>Followers:</th>";
    $query1= "select * from follows where flid='$user'";
      $result1=mysqli_query($con,$query1); 
      $temp=0;
      while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
      {
          $follows=$row1['userid'];

          if($temp==0)
          {
               print "<td><a href='Users.php?user=".$follows."' target='_top'>".$follows."</a></td></tr>";
               $temp=$temp+1;
          }
          else
          {
              print "<tr><td></td><td><a href='Users.php?user=".$follows."' target='_top'>".$follows."</a></td></tr>";
          }
        
         
    }
    if($temp==0)
    {
      print "<td>None</td></tr>";
    }

    print "<tr>
    <th>Following:</th>";
    $query1= "select * from follows where userid='$user'";
    $result1=mysqli_query($con,$query1); 
    $temp1=0;
    while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
      {
          $following=$row1['flid'];
          if($temp1==0)
          {
            print "<td><a href='Users.php?user=".$following."' target='_top'>".$following."</a></td></tr>";
            $temp1=$temp1+1;
          }
          else
          {
            print "<tr><td></td><td><a href='Users.php?user=".$following."' target='_top'>".$following."</a></td></tr>";
          }
      }
      if($temp1==0)
      {
        print "<td>None</td></tr>";
      }
	  
	print "<tr>
    <th>Likes:</th>";
    $query1= "select aname from artists, likes where likes.userid='$user' and artists.aid = likes.aid";
    $result1=mysqli_query($con,$query1); 
    $temp1=0;
    while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
      {
          $likes=$row1['aname'];
          if($temp1==0)
          {
            print "<td><a href='artist.php?artist=".$likes."' target='_top'>".$likes."</a></td></tr>";
            $temp1=$temp1+1;
          }
          else
          {
            print "<tr><td></td><td><a href='artist.php?artist=".$likes."' target='_top'>".$likes."</a></td></tr>";
          }
      }
      if($temp1==0)
      {
        print "<td>None</td></tr>";
      }  
      print "</table>";
  }
  

   $query1= "select count(*) as counter1 from follows  where flid='$user' and userid='$username'";
    $result1=mysqli_query($con,$query1); 
    while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
    {
      $counter1=$row1['counter1'];
    }
    if($counter1!=0)
    {
      $followed=true;
    }
    if ($followed==true || $user==$username)
    { 
      if (($followed==true))
	  {
		print "<form class='form-horizontal' action='Users.php' method='POST'>
		<input type='hidden' name='to_do' value='unfollow'>
		<button  type='submit' class='btn btn-info'>Unfollow User!</button></form>";
	  }
	  else
	  {
		print "<button class='btn btn-info disabled' title='Cannot Follow Yourself' class='btn btn-primary'>Follow User!</button></br></br>";
	  }	
	}  
    else
    { 
      print "<form class='form-horizontal' action='Users.php' method='POST'>
      <input type='hidden' name='to_do' value='follow'>

      <button  type='submit' class='btn btn-info'>Follow User!</button></form>";
    }
	
	
	echo '
    <div class="container" align="center" style="width:100%">
	<div class="RecentPlaylists" style="max-width="200px">
	';

			
			echo '
			<h3> Recent playlists created by this user </h3>
			';
      if ($user==$username){
          $querypl = "select distinct plid, pltitle from playlists pl where userid='$user' order by pldate desc limit 3";
      }
      else
      {
        $querypl = "select distinct plid, pltitle from playlists pl where userid='$user' and pltype = 'public' order by pldate desc limit 3";
      }
			//$querypl = "select distinct plid, pltitle from playlists pl where userid='$user' and pltype = 'public' order by pldate limit 3";
			$resultpl=mysqli_query($con,$querypl);
			echo '<div style="width: 100%; ">';
			if(mysqli_num_rows($resultpl) == 0 )
			{
				echo '<h5> This user has not created any playlists </h5>';
			}
			else
			{	
			while($rowpl = mysqli_fetch_array($resultpl,MYSQLI_ASSOC)) 
			{
				echo '<div style="float:left; width:33.33%; height:300px; overflow-y: auto">';
				$playlistid = $rowpl['plid'];
				$playlisttitle = $rowpl['pltitle'];
				
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
					
					$PlayTrackID = "Play_";
					$PlayTrackID .= $trackid;
				
					$RateTrackID = "Rate_";
					$RateTrackID .= $trackid;					
					
					echo' <form action="" method="post" style="margin-up: -150px">
							<button type="submit" class="btn btn-primary" name="to_do" value='.$PlayTrackID.'> Play </button>
							<input type="hidden" name="user_id" value='.$user.'>
							<input type="hidden" name="track_id" value='.$trackid.'>							
							<input type="hidden" name="source" value="playlist">
							<input type="hidden" name="source_id" value='.$playlistid.'>
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
					<button type="submit" class="btn btn-primary" name="to_do" value='.$RateTrackID.'>Submit Rating</button>
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
					
				}
				
				echo '
				</td>
				</tr>
				</table>
				';
				
				echo '</div>';
			}
			echo '</div>';
			}
	echo '
	</div></div> ';   
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
    