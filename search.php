<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
		<div class="container">
				<div class="row">
						<div class="col-md-12"> 
						<div class="panel">
							<div class="panel-body">
							<!--/stories-->
							<div class="row">    
								<br>
						<?php
						include 'dbcon.php';
						include 'session.php';
						$search = $_POST['keyword'];
						
						$query = $conn->query("select * from users where firstname LIKE '%$search%' 
						and type = 0 and id != '$session_id' or lastname  LIKE '%$search%' and type = 0 and id != '$session_id'");
						$count = $query->rowcount();
						if ($count > 0){ 
						while($row = $query->fetch()){
						$posted_by = $row['firstname']." ".$row['lastname'];
						$posted_image = $row['photo'];
						$friend_id = $row['id'];
						?>
								<div class="col-md-2 col-sm-3 text-center">
								<img  src="images/<?php echo $posted_image; ?>" style="width:100px;height:100px" class="img-circle"></a>
								</div>
								<div class="col-md-10 col-sm-9">
									<div class="alert"><?php echo $posted_by; ?></div>
								<div class="row">
									<div class="col-sm-12">
									<form method="post" action="add_friend.php">
													<div class="col-sm-3">
													<input type="hidden" name="my_friend_id" value="<?php echo $friend_id; ?>">
													<input type="hidden" name="my_id" value="<?php echo $session_id; ?>">
													<?php $query1 = $conn->query("select * from friends where my_id = '$session_id' and friends_id = '$friend_id'  and friend_status = 'friends' or my_id = '$friend_id' and friends_id = '$session_id' and friend_status = 'friends'");
														$count1 = $query1->rowcount();
														if ($count1 > 0){ echo 'All Ready Friend'; }else{
													?>	
													<button class="btn btn-info"><i class="icon-plus-sign"></i> Add as Friend</button>
								<?php } ?>
													</div>
									</h4></div>
									</form>
								</div>
								<br><br>
								</div>
						<?php } }else{ ?> &nbsp;&nbsp;&nbsp;&nbsp; No Result Found.  <?php } ?>		
							</div>
							<hr>
							</div>
						</div>
						</div><!--/col-12-->
					</div>
				</div>
		</div>
	
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>