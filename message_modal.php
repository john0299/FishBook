<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:blueviolet;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"style="color:white;"><b>Message</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="send_message.php" enctype="multipart/form-data">
              <div class="form-group">
                    

                    <div class="col-sm-12">
                    <label for="contact" class="control-label">Contact Info</label>
                    <br>
                  
                    <select name="friend_id" class="combo" style="width:100%; height: 2em;" required>
											<option value =""></option>
                      
															<?php
                              include 'dbcon.php';
                              include 'session.php';
                             
	// 													$query = $conn->query("select users.id , users.firstname , users.lastname , users.image , friends.friends_id   from users  , friends
	// where friends.my_friend_id = '$session_id' and users.id = friends.my_id
	// OR friends.my_id = '$session_id' and users.id = friends.my_friend_id
  // ");                      	
                              // $query = $conn->query("select * from users where type = 0 and id != '$session_id'");
                              $query = $conn->query("select users.id , users.firstname , users.lastname 
                              ,users.photo from users  , friends
                              where users.type = 0 and friends.friends_id = '$session_id' and users.id = friends.my_id
                              OR friends.my_id = '$session_id' and users.id = friends.friends_id
                              ");
                              
															while($row = $query->fetch()){
															$friend_name = $row['firstname']." ".$row['lastname'];
															$friend_image = $row['image'];
															$id = $row['id'];
															?>
                              <option value="<?php echo $id; ?>"><?php echo $friend_name ; ?></option>
										          <?php } ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                  
                    <input type="hidden" name="my_id" value ="<?php echo $session_id; ?>">
                    <div class="col-sm-12">
                    <label for="my_message" class="control-label">Content</label>
                      <textarea class="form-control" id="my_message" name="my_message" style="height:200px; resize:none;"required></textarea>
                    </div>
                </div>
               
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="add"><i class="fa fa-paper-plane"></i> Send</button>
              <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
              
              </form>
            </div>
        </div>
    </div>
</div>



     