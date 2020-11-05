<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; 
?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  	<div class="content-wrapper">
			<div class="container">
                <section class="content">
                    <?php
                        if(isset($_SESSION['error'])){
                        echo "
                            <div class='alert alert-danger alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-warning'></i> Error!</h4>
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
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> New Message</a>
                        
                            </div>
                            <div class="box-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>Action</th>
                                <!-- <th>Action</th> -->
                                </thead>
                                <tbody>
                                
                                <?php 
                                include 'dbcon.php';
                                include 'session.php';
                                include 'message_count.php'; 
                                    $query = $conn->query("select * from message
                                    LEFT JOIN users on message.sender_id = users.id where reciever_id = '$session_id' order by date_sended DESC");
                        
                                    echo $row['mescount'];
                                    while($row = $query->fetch()){
                                    $id = $row['message_id'];
                                   
                                    ?>
                             
                                    <tr>
                                    <td class="col-sm-3">From: <?php echo $row['firstname']." ".$row['lastname']; ?></td>
                                    <td class="col-sm-4"><p><?php echo $row['content']; ?></p></td>
                                    <td class="col-sm-3"><p><?php echo $row['date_sended']; ?></p></td>
                                    <td class="col-sm-2">
                                    <!-- <button class='btn btn-success' data-id="$row['id']"><i class='fa fa-pencil'></i> Reply</button> -->
                                    <!-- <button class='btn btn-danger btn-sm delete btn-flat'data-id="$row['id']"><i class='fa fa-trash'></i> Delete</button> -->
                                    <a href="message_delete.php<?php echo '?id='.$id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                   
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <thead>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>Action</th>
                                <!-- <th>Action</th> -->
                                </thead>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
				
					
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

