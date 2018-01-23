<?php session_start();
if (!empty($_SESSION['logged_in']))
{
  $_SESSION['logged_in'] = true;
  $con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error()); 
    $username=$_SESSION['username'] ;



if($_SERVER["REQUEST_METHOD"]=="POST")
{

	$aid=mysqli_real_escape_string($con,$_POST['artist_parameter']);

	if($_POST['to_do']=='like')
	{
		$query = "insert into likes values ('$username','$aid',sysdate())";
		mysqli_query($con,$query); 
		Print '<script>window.location.assign("allartists.php");</script>'; 
	}
	
	if($_POST['to_do']=='unlike')
    {
		$query1= "delete from likes where userid ='$username' and aid = '$aid'";
		mysqli_query($con,$query1); 
		Print '<script>window.location.assign("allartists.php");</script>';  
    }

}

}
else
 {
  Print '<script>alert("Please login first!");</script>'; 
  Print '<script>window.location.assign("index.php");</script>'; 
 }

?>