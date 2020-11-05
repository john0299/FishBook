<!-- Add -->
<div class="modal fade" id="addreply">
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
											<option></option>
															<?php
                              include 'dbcon.php';
                              include 'session.php';
														$query = $conn->query("select members.member_id , members.firstname , members.lastname , members.image , friends.friends_id   from members  , friends
	where friends.my_friend_id = '$session_id' and members.member_id = friends.my_id
	OR friends.my_id = '$session_id' and members.member_id = friends.my_friend_id
	");
															while($row = $query->fetch()){
															$friend_name = $row['firstname']." ".$row['lastname'];
															$friend_image = $row['image'];
															$id = $row['member_id'];
															?>
                                              	<option value="<?php echo $id; ?>"><?php echo $friend_name; ?></option>
											<?php } ?>
                                            </select>   
                    </div>
                </div>
                <div class="form-group">
                  

                    <div class="col-sm-12">
                    <label for="address" class="control-label">Content</label>
                      <textarea class="form-control" id="my_message" name="my_message" style="height:100px;"required></textarea>
                    </div>
                </div>
               
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="add"><i class="fa fa-paper-plane"></i> Send</button>
              <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
              
              </form>
            </div>
        </div>
    </div>
</div>



     