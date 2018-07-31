<div class="container-fluid">
	<div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="text-center">

                <?php if($user->image == ''): ?> 
                <img src="http://placehold.it/100" width = "200px" height = "200px"  class="avatar img-circle" alt="avatar"><br>
                 <label for = "bigint"><?php echo $user->username ?></label>
                <?php else: ?>
                    <img src="<?php echo base_url() . 'uploads/' . $user->image ?>" width = "200px" height = "200px" id = "avatar" class="avatar img-circle" alt="avatar"><br>
                 <label for = "bigint"><?php echo $user->username ?></label>
                <?php endif; ?>
                <h6>Upload a different photo...</h6>

                <input type="file" name="image" id="image"  form="myform" class="form-group">
            </div>
            </div>
        </div>
                    <div class="col-lg-6">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Admin form</h4>
                            </div>
                            <div class="card-body">
                                <form  id="myform" action="<?php echo base_url() . 'Admin/editprofile' ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15">Personal Info</h3> 
                                        <hr>
                                        
	    <div class="form-group">
            <label for="bigint">Username <?php echo form_error('catid') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Catid" value="<?php echo $user->username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">First Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="<?php echo $user->first_name; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo $user->last_name; ?>" />
        </div>
         <div class="form-group">
            <label for="varchar">Email <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $user->email; ?>" />
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"> New Password</label>
            <input type="password" class="form-control" name="newpass" id="newpass" placeholder="New Password">
        </div>
        
  




            
        
        
        

	    <!-- <div class="form-group"> -->
           <!--  <label for="int">Product Image <?php echo form_error('image') ?></label>
            <input type="file" class="form-control" id="image" name="image" /> -->
            <!-- <input type="text" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" /> -->
            <!-- <input type="file" id = "profile_pic" onchange="theForm.submit()" class="form-control"> -->
        <!-- </div> -->
	    
	    <!-- <input type="hidden" name="id" value="<?php echo $id; ?>" />  -->
	    <button type="submit" class="btn btn-primary">Save Changes</button> 
	    <a href="<?php echo site_url('Admin') ?>" class="btn btn-default">Cancel</a>
	
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

</div>