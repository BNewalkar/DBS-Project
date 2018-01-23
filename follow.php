<?php session_start();
if (!empty($_SESSION['logged_in']))
{
  $_SESSION['logged_in'] = true;
  $con=mysqli_connect("localhost", "root","","music") or die(mysqli_connect_error()); 
    $username=$_SESSION['username'] ;



if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $uid=mysqli_real_escape_string($con,$_POST['follow_parameter']);

    if($_POST['to_do']=='follow')
    {
		$query = "insert into follows values ('$username','$uid',sysdate())";
		mysqli_query($con,$query); 
		Print '<script>window.location.assign("allusers.php");</script>'; 
	}
	if($_POST['to_do']=='unfollow')
    {
        $query1= "delete from follows where userid ='$username' and flid = '$uid'";
        mysqli_query($con,$query1); 
        Print '<script>window.location.assign("allusers.php");</script>';   
    }
}

}
else
 {
  Print '<script>alert("Please login first!");</script>'; 
  Print '<script>window.location.assign("index.php");</script>'; 
 }

?>