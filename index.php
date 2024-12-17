<?php 
	session_start();
	error_reporting(0);
	include 'include/config.php';
	$uid=$_SESSION['uid'];

	if(isset($_POST['submit']))
	{ 
		$pid=$_POST['pid'];

		$sql="INSERT INTO tblbooking (package_id,userid) Values(:pid,:uid)";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':pid',$pid,PDO::PARAM_STR);
		$query->bindParam(':uid',$uid,PDO::PARAM_STR);
		$query -> execute();
		echo "<script>alert('Package has been booked.');</script>";
		echo "<script>window.location.href='booking-history.php'</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>GYM SATHI</title>
</head>
<body>
    
    <header>
        <a href="#home" class="logo">GYM <span> SATHI</span></a>

        <div class='bx bx-menu' id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#service">Service</a></li>
            <li><a href="#about">About us</a></li>
            <li><a href="price.php">Pricing</a></li>
            <li><a href="#review">Review</a></li>
        </ul>

      
        <div class="top-btn"></div>
        <a href="login.php" class="nav-btn">Join Us</a>
    </header>

    <!-- home section-->


     <section class="home" id="home">
        <div class="home-content">

            <h3>Build Your</h3>
            <h1> Dream Physique</h1>
            <h3><span class="multiple-text">Bodybulding</span></h3>

            <p>Welcome to Fitness Hub — Where Fitness Meets Lifestyle
                At Fitness Hub
                , we believe that fitness is more than just a workout; it's a way of life. Whether you're a beginner or a seasoned athlete, we provide a welcoming and motivating environment where everyone can thrive.</p>

                <a href="login.php" class="join-us-button">Join Us</a>


 
        </div>
        
        <div class="home-img">
            <img src="img/home.jpg" alt="Home Image">
         </div>
    </section>

