<?php session_start();?>
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
            <h3>Most Trending Artists</h3></br>

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
						
            $con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error());   
          
            $query = "select count(t.tid) from tracks t natural join artists a where a.aid='4dpARuHxo51G3z768sgnrY'";
            $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $adele = $row['count(t.tid)']; 
                }
                $query = "select count(t.tid) from tracks t natural join artists a where a.aid='0f4LCYJ0RohOZ4mnVBX6gO'"; 
                $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $peer = $row['count(t.tid)']; 
                }
                $query = "select count(t.tid) from tracks t natural join artists a where a.aid='0nmQIMXWTXfhgOBdNzhGOs'"; 
            $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $avenge = $row['count(t.tid)']; 
                }
                $query = "select count(t.tid) from tracks t natural join artists a where a.aid='1uNFoZAHBGtllmzznpCI3s'";  
            $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $justin = $row['count(t.tid)']; 
                }
                $query = "select count(t.tid) from tracks t natural join artists a where a.aid='3TVXtAsR1Inumwj472S9r4'"; 
            $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $drake= $row['count(t.tid)']; 
                }
                $query = "select count(t.tid) from tracks t natural join artists a where a.aid='0L8ExT028jH3ddEcZwqJJ5'"; 
            $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $red = $row['count(t.tid)']; 
                }
                $query = "select count(t.tid) from tracks t natural join artists a where a.aid='36QJpDe2go2KgaRleHCDTp'";  
            $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $led = $row['count(t.tid)']; 
                }
                $query = "select count(t.tid) from tracks t natural join artists a where a.aid='4xFUf1FHVy696Q1JQZMTRj'"; 
            $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $carrie = $row['count(t.tid)']; 
                }

                 $query = "select count(t.tid) from tracks t natural join artists a where a.aid='2cnMpRsOVqtPMfq7YiFE6K'"; 
            $result=mysqli_query($con,$query); 
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                {
                  $van = $row['count(t.tid)']; 
                }

            ?>


            <ul class="list-group">
             <li class="list-group-item"><a href="search.php?tag=Adele"><b style="font-size: 25">Adele</b> <span class="badge"><?php echo $adele ?></span></a></li>
              <li class="list-group-item"><a href="search.php?tag=Peer Van Mladen"><b style="font-size: 25">Peer Van Mladen </b><span class="badge"><?php echo $peer ?></span></a></li>
              <li class="list-group-item"><a href="search.php?tag=Avenged Sevenfold"><b style="font-size: 25">Avenged Sevenfold</b><span class="badge"><?php echo $avenge ?></span></a></li>
              <li class="list-group-item"><a href="search.php?tag=Justin Bieber"><b style="font-size: 25">Justin Bieber </b><span class="badge"><?php echo $justin ?></span></a></li>
              <li class="list-group-item"><a href="search.php?tag=Drake"><b style="font-size: 25">Drake </b><span class="badge"><?php echo $drake?></span></a></li>
              <li class="list-group-item"><a href="search.php?tag=Red Hot Chili Peppers"><b style="font-size: 25">Red Hot Chili Peppers</b><span class="badge"><?php echo $red ?></span></a></li>
              <li class="list-group-item"><a href="search.php?tag=Led Zeppelin"><b style="font-size: 25">Led Zeppelin </b><span class="badge"><?php echo $led ?></span></a></li>
              <li class="list-group-item"><a href="search.php?tag=Carrie Underwood"><b style="font-size: 25">Carrie Underwood </b><span class="badge"><?php echo $carrie?></span></a></li>
                 <li class="list-group-item"><a href="search.php?tag=Van Halen"><b style="font-size: 25">Van Halen </b><span class="badge"><?php echo $van?></span></a></li>
              
            </ul>


           





     </body>
</html>