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
<!-- Pricing Section -->
<link rel="stylesheet" href="css/price.css">
<section class="pricing-section spad">
		<div class="container">
			<div class="section-title text-center">
				<img src="img/icons/logo-icon.png" alt="">
				<h2>Pricing plans</h2>
				<p>Practice Yoga to perfect physical beauty, take care of your soul and enjoy life more fully!</p>
			</div>
			<div class="row">
				<?php 
					$sql ="SELECT id, category, titlename, PackageType, PackageDuratiobn, Price, uploadphoto, Description, create_date from tbladdpackage";
					$query= $dbh -> prepare($sql);
					$query-> execute();
					$results = $query -> fetchAll(PDO::FETCH_OBJ);
					$cnt=1;
					if($query -> rowCount() > 0)
					{
						foreach($results as $result)
					{
				?>
				<div class="col-lg-3 col-sm-6">
					<div class="pricing-item begginer">
						<div class="pi-top">
							<h4><?php echo $result->titlename;?></h4>
						</div>
						<div class="pi-price">
							<h3><?php echo htmlentities($result->Price);?></h3>
							<p>	<?php echo $result->PackageDuratiobn;?></p>
						</div>
						<ul>
							<?php echo $result->Description;?>
						</ul>
						<?php if(strlen($_SESSION['uid'])==0): ?>
						<a href="login.php" class="site-btn sb-line-gradient">Booking Now</a>
						<?php else :?>
							<form method='post'>
								<input type='hidden' name='pid' value='<?php echo htmlentities($result->id);?>'>
								<input class='site-btn sb-line-gradient' type='submit' name='submit' value='Booking Now' onclick="return confirm('Do you really want to book this package.');">
							</form> 
						<?php endif;?>
					</div>
				</div>
				<?php  $cnt=$cnt+1; } } ?>
			</div>
		</div>
	</section>