<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	<?php include 'session.php'; ?>
	  	<div class="content-wrapper">
			<div class="container">
				<div class="content text-center">
					<div class="col-sm-12">
						<div class="row">
						<div class="col-sm-3">
							<div class='box box-solid'>
								<div class='box-header with-border'>
									<h3 class='box-title'><b>Profile</b></h3>
								</div>
								<div class='box-body'>
								<img href="profile.php" src="<?php echo $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>" class="image-circle" alt="User Image" style="width:100px; height:100px;">
								<br>
								<span><h4><?php echo $username ?></h4></a></span>
							<hr>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class='box box-solid'>
									<div class='box-header with-border'>
								
										<h3 class='box-title'><b>Share your story here</b></h3>
									</div>
									<div class='box-body'>
									<div class="col-sm-12">
									<form method="post" action="add_post.php">
											<input type="hidden" name="my_id" value="<?php echo $session_id; ?>">
											<textarea name="content" placeholder="Share your Story Here" rows="5" style="width:100%; resize:none;" required></textarea>
						
											<button class="btn btn-primary" style="float:left;"><i class="fa fa-share"></i> Post </button>
									</form>
									</div>
									
								
									</div>
							</div>
							
						</div>
						
						<div class="col-sm-3">
							<div class='box box-solid'>
								<div class='box-header with-border'>
									<h3 class='box-title'><b>Friend Request</b></h3>
								</div>
								<div class='box-body'>
								<img src="images/banner1.png" class="user-image" alt="User Image" style="width:100px; height:100px;">
								<br>
								<span>name namne</span>
								<br>
								<button class="btn btn-success"><i class="fa fa-check"> Accept</i></button>
								<button class="btn btn-danger"><i class="fa fa-times"></i> Refuse</button>
							
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							
								<?php
								include 'session.php';

								$query = $conn->query("select * from post LEFT JOIN users on users.id = post.member_id order by post_id DESC");
								while($row = $query->fetch()){
								$posted_by = $row['firstname']." ".$row['lastname'];
								$posted_image = $row['photo'];
								$id = $row['post_id'];
								?>
								<div class='box box-solid'>
									<div class='box-header with-border'>
										<div class="row">  
											<div class="col-md-2 col-sm-3">
											<img src="images/<?php echo $posted_image; ?>" width="50px" height="50px" class="img-circle">
											<hr>
											</div>
											<div class="col-md-10 col-sm-6">
												<textarea name="" id="" rows="4" style="width:100%; resize:none;"><?php echo $row['content']; ?></textarea>
											<div class="row">
												<div class="col-xs-9 ">
												<h4><span class="label label-info"> <?php echo $row['date_posted']; ?></span></h4><h4>
												<small style="font-family:courier,'new courier';" class="text-muted">Posted By:<a href="#" class="text-muted"><?php echo $posted_by; ?></a></small>
												</h4>
												</div>		
											</div>
							
										</div>
									
									</div>
								</div>
							</div>			
								<?php } ?>	
						</div>

						
					</div>
					
			</div>
		</div>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>