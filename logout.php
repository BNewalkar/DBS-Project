<?php
session_start();
session_destroy();
Print '<script>alert("Succesfully Logged Out!");</script>'; 
Print '<script>window.location.assign("index.php");</script>';
?>