<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; 
?>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  	<div class="content-wrapper">
			<div class="container">
			<div class="content text-center">
				<div class="col-md-12"> 
					<div class="panel text-center">
					<h2>My Friends</h2>
					<hr>
						<div class="panel-body">
						<!--/stories-->
						<div class="row">

									<?php
									include 'dbcon.php';
									include 'session.php';
									$query = $conn->query("select users.id , users.firstname , users.lastname 
									,users.photo from users  , friends
									where users.type = 0 and friends.friends_id = '$session_id' and users.id = friends.my_id
									OR friends.my_id = '$session_id' and users.id = friends.friends_id and friends.friend_status ='friends'
									");
									// $query = $conn->query("select * from users where type = 0 and id != '$session_id'");
									//  $query = $conn->query("select * from friends where my_id = 0");

									while($row = $query->fetch()){
									$friend_name = $row['firstname']." ".$row['lastname'];
									$friend_image = $row['photo'];
									$id = $row['id'];
									?>
									
									<div class="col-sm-3">
										<div class="row">    
												<div class="col-sm-4 text-center">
												<img src="images/<?php echo $friend_image; ?>" style="width:100px;height:100px" class="img-circle"></a>
												</div>

												<div class="col-sm-8">
												<div class="alert"><?php echo $friend_name; ?></div><h3>
												<div class=""><a href="delete_friend.php<?php echo '?id='.$id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Unfriend </a></div>
													
												</div>
											</div>
											<hr>
								</div>
								
							
								<?php } ?>		
				
				
						</div>
						
					
						</div>
					</div>
																						
														
														
				</div>

			</div>		
			</div>
		</div>
	     
	    </div>
	  </div>
  
      <?php include 'includes/footer.php'; 
      include 'message_modal.php';?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>

