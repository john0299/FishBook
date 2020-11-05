<?php include 'includes/session.php'; ?>
<?php
	if(!isset($_SESSION['user'])){
		header('location: index.php');
	}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12 col-md-12 col-lg-12">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='callout callout-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}

	        			if(isset($_SESSION['success'])){
	        				echo "
							<div class='alert alert-success alert-dismissible'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Success!</h4>
							".$_SESSION['success']."
						  </div>
	        				";
	        				unset($_SESSION['success']);
	        			}
	        		?>
	        		<div class="box box-solid">
	        			<div class="box-body">
	        				<div class="col-sm-6 text-center">
	        					<img src="<?php echo (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>" width="100%" height="300px">
	        				</div>
	        				<div class="col-sm-6">
	        					<div class="row text-center">
								<h2 id="">My Profile</h2>
								<hr>
	        						<div class="col-sm-12">
	        							<h4>Name: <?php echo $user['firstname'].' '.$user['lastname']; ?></h4>
	        							<h4>Email: <?php echo $user['email']; ?></h4>
	        							<h4>Contact Info: <?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
	        							<h4>Address: <?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4>
	        							<h4>Account Created: <?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
										<a href="#edit" class="btn btn-success btn-flat" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
	        						</div>

	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        		
	        	</div>
	        	<!-- <div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div> -->
	        </div>
			<?php
	        			if(isset($_SESSION['perror'])){
	        				echo "
	        					<div class='callout callout-danger'>
	        						".$_SESSION['perror']."
	        					</div>
	        				";
	        				unset($_SESSION['perror']);
	        			}

	        			if(isset($_SESSION['psuccess'])){
	        				echo "
							<div class='alert alert-success alert-dismissible'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Success!</h4>
							".$_SESSION['psuccess']."
						  </div>
	        				";
	        				unset($_SESSION['psuccess']);
	        			}
	        		?>
			<div class="row">
				<div class="col-md-12">   
					<div class="panel">
					
						<div class="panel-body">
						<div class="col-sm-12 text-center"><h2>My Photos</h2>
							
								<form id="photos" method="POST" enctype="multipart/form-data">
									<input type="file" name="image" class="btn-success btn-md" required style="background-color:darkviolet; width:100%;"> <br>
									<p class="text-center"><button type="submit" name="upload" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>	</p>	
								</form>
								<hr></div>
									
										<?php 
										include 'dbcon.php';
										include 'session.php';
											if (isset($_POST['upload'])) {
			
											$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
											$image_name = addslashes($_FILES['image']['name']);
											$image_size = getimagesize($_FILES['image']['tmp_name']);
									
											move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
											$location = "upload/" . $_FILES["image"]["name"];
											$conn->query("insert into photos (location,member_id) values ('$location','$session_id')");
											$_SESSION['psuccess']='Photo Uploaded.';
										?>
										<script>
											window.location = 'profile.php';
										</script>
										<?php
										} 
										?>
							
						
					<div class="row text-center">  		  
					<p><a class="btn btn-default btn-sm" href="#delete" data-toggle="modal"> <i class="fa fa-eye"></i> View All Photos</a>
							<?php
							$query = $conn->query("select * from photos where member_id='$session_id'");
							while($row = $query->fetch()){
							$id = $row['photos_id'];	
								
							?>
							
								<div class="col-md-3 col-sm-4 col-xs-6 text-center">
									<img class="photo" src="<?php echo $row['location']; ?>" width="100%" height="150">
									<p><a class="btn btn-default btn-sm" href="<?php echo $row['location']; ?>"> <i class="fa fa-eye"></i> View</a>
									
									<a href="delete_photos.php<?php echo '?id='.$id; ?>" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i> Delete</a></p>
									<hr>
								</div>
							<?php } ?>
					</div>
					
							
				</div>
	  		</div>

			<div class="row">
				<div class="col-md-12">   
					<div class="panel">
					
						<div class="panel-body">
						<div class="col-sm-12 text-center"><h2>My Posts</h2>
						<hr>
							
						<?php
								include 'session.php';

								$query = $conn->query("select * from post, users where users.id = post.member_id and post.member_id ='$session_id' order by post_id DESC");
								while($row = $query->fetch()){
								$posted_by = $row['firstname']." ".$row['lastname'];
								$posted_image = $row['photo'];
								$id = $row['post_id'];
								?>
								<div class='box box-solid'>
									<div class='box-header with-border'>
										<div class="row">
											<div class="col-md-3"></div>
											<div class="col-md-1 text-center">
												<img src="images/<?php echo $posted_image; ?>" width="50px" height="50px" class="img-circle">
												<hr>
												</div>
												<div class="col-md-4">
													<textarea name="" id="" rows="5" style="width:100%; resize:none;" readonly><?php echo $row['content']; ?></textarea>
													<div class="row">
														<div class="col-sm-9">
															<h4><span class="label label-info"> <?php echo $row['date_posted']; ?></span></h4><h4>
															<small style="font-family:courier,'new courier';" class="text-muted">Posted By:<a href="#" class="text-muted"><?php echo $posted_by; ?></a></small>
															</h4>
														</div>
													
														<div class="col-sm-3"><a href="delete_post.php<?php echo '?id='.$id; ?>" class="btn btn-danger"><i class="fa fa-close"></i> </a></div>
																
													</div>
										
												</div>
												
										</div>
									</div>
								</div>			
									<?php } ?>	
					</div>		
				</div>

	  		</div><!--/End of My Posts-->
																					   
													
													  
	   </div><!--/col-12-->
  </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'profile_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
// $(function(){
// 	$(document).on('click', '.transact', function(e){
// 		e.preventDefault();
// 		$('#transaction').modal('show');
// 		var id = $(this).data('id');
// 		$.ajax({
// 			type: 'POST',
// 			url: 'transaction.php',
// 			data: {id:id},
// 			dataType: 'json',
// 			success:function(response){
// 				$('#date').html(response.date);
// 				$('#transid').html(response.transaction);
// 				$('#detail').prepend(response.list);
// 				$('#total').html(response.total);
// 			}
// 		});
// 	});

// 	$("#transaction").on("hidden.bs.modal", function () {
// 	    $('.prepend_items').remove();
// 	});
// });
</script>
</body>
</html>