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
            </nav> </br>
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
		
		?>	
			
      <div class="container" style="width:100%;">
          <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="1500">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
              <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

              <div class="item active" style="height:85%;">
                <img src="music4.jpg" alt="Music is Life" style="width:100%;">
                <div class="carousel-caption">
                  <h2 style="color: snow">Music is Life!</h2>
                </div>
              </div>

             <div class="item" style="height:85%;">
                <img src="music3.jpg" alt="Dance" style="width:100%;">
                <div class="carousel-caption">
                  <h2 style="color: snow">Rock the Floor!</h2>
                </div>
              </div>

              <div class="item" style="height:85%">
                <img src="music1.jpg" alt="Arts" style="width:100%">
                <div class="carousel-caption">
                  <h2 style="color: snow">Let's Party!</h2>
                </div>
              </div>

              <div class="item" style="height:85%;">
                <img src="music2.jpg" alt="Music" style="width:100%">
                <div class="carousel-caption">
                  <h2 style="color: snow">Lighten Up Life!</h2>
                </div>
              </div>

              <div class="item" style="height:85%;">
                <img src="music5.jpg" alt="Music" style="width:100%">
                <div class="carousel-caption">
                  <h2 style="color: snow">Music is Colorful!</h2>
                </div>
              </div>
          
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>

</body>
</html>

