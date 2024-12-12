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
    <title>Fitness Hub</title>
</head>
<body>
    
    <header>
        <a href="#home" class="logo">GYM <span> MATE</span></a>

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

            <a href="#" class="btn">Join Us</a>

 
        </div>
        
        <div class="home-img">
            <img src="img/home.jpg" alt="Home Image">
         </div>
    </section>

    <!--Services section code-->

    <section class="services" id="services">
        <h2 class="heading">Our <span>Services</span></h2>

        <div class="services-content">
            <div class="row">
                <img src="img/image1.jpg" alt="">

                <h4>Physial Fitness</h4>
            </div>
            <div class="row">
                <img src="img/image2.jpg" alt="">

                <h4>Weight Gain</h4>
            </div>
            <div class="row">
                <img src="img/image3.jpg" alt="">

                <h4>Strength Tranning</h4>
            </div>
            <div class="row">
                <img src="img/image4.jpg" alt="">

                <h4>Fat loss</h4>
            </div>
            <div class="row">
                <img src="img/image5.jpg" alt="">

                <h4>Weightlifting</h4>
            </div>
            <div class="row">
                <img src="img/image6.jpg" alt="">

                <h4>Cardio</h4>
            
        </div>
    </section>

<!--About setion code-->
    <section class="about" id="about">
        <div class="about-img">
            <img src="img/about.jpg" alt="">
        </div>

        <div class="about-content">
            <h2 class="heading">Why Choose Us?</h2>

            <p>our Diverse membership base creates a friendly and supportive atmosphere, where you can make friends and stay motivated</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit itaque sed ip</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, labore  aut.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore provident beatae</p>
            
            <a href="#" class="btn">Book a free class</a>
        
        </div>
    </section>

    <!--Pricing section-->
    
    <section class="plans" id="plans">
        <h2 class="heading">Our<span> Plans</span></h2> 

        <div class="plans-content">

            <div class="box">
                <h3>BASIC</h3>
                <h2><span>Rs.100/Month</span></h2>
                <ul>
                    <li>Smart Workout Plan</li>
                    <li>At Home Workout</li>
                </ul>
                <a href="#">
                    Join Now
                    <i class='bx bx-right-arrow-alt'></i>
                </a>
            
            </div>

            <div class="box">
                <h3>PRO</h3>
                <h2><span>Rs.150/Month</span></h2>
                <ul>
                    <li>PRO GYM</li>
                    <li>Smart Workout Plan</li>
                    <li>At Home Workout</li>
                </ul>
                <a href="#">
                    Join Now
                    <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>

            <div class="box">
                <h3>PREMIUM</h3>
                <h2><span>Rs.300/Month</span></h2>
                <ul>
                    <li>ELITE GYms and Classes</li>
                    <li>Pro GYMs</li>
                    <li>Smart Workout Plan</li>
                    <li>At Home Workout</li>
                    <li> Personal Tranning</li>
                </ul>
                <a href="#">
                    Join Now
                    <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>
        </div>
    
    
    </section>

    <!-- Reviw section code-->

    <section class="review" id="review" >
        <div class="review-box">
            <h2 class="heading"> Client <span> Reviews</span></h2>
            <div class="wrapper">
                <div class="review-item">
                    <img src="img/1.jpg" alt="">
                    <h2>Beckam</h2>
                    <div class="rating">
                        <i class='bx bxs-star' id="star" ></i>
                        <i class='bx bxs-star' id="star" ></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star"></i>
                        <i class='bx bxs-star' id="star" ></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus in necessitatibus, nisi id atque beatae!</p>
                </div>

                
                    
                        <div class="review-item">
                            <img src="img/2.jpg" alt="">
                            <h2>David</h2>
                            <div class="rating">
                                <i class='bx bxs-star' id="star" ></i>
                                <i class='bx bxs-star' id="star"></i>
                                <i class='bx bxs-star' id="star"></i>
                                <i class='bx bxs-star' id="star" ></i>
                                <i class='bx bxs-star' id="star"></i>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus in necessitatibus, nisi id atque beatae!</p>
                            </div>

                  
                         <div class="review-item">
                            <img src="img/3.jpg" alt="">
                            <h2>Sarah</h2>
                            <div class="rating">
                                <i class='bx bxs-star' id="star"></i>
                                <i class='bx bxs-star' id="star"></i>
                                <i class='bx bxs-star' id="star"></i>
                                <i class='bx bxs-star' id="star"></i>
                                <i class='bx bxs-star' id="star"></i>
                                </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus in necessitatibus, nisi id atque beatae!</p>
                    
            </div>
        </div>
    </section>

    <!--Footer Section Code-->

    <footer class="Footer">
        <div class="social">
            <a href="#"><i class='bx bxl-facebook-circle' ></i></a>
            <a href="#"><i class='bx bxl-instagram' ></i></a>
            <a href="#"><i class='bx bxl-linkedin' ></i></a>
        </div>

        <p class="copyright">
            &copy; Fitness Hub 2024 - All Rights Reserved
        </p>
    </footer>


</body>
</html>