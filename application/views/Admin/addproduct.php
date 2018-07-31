<div class="container-fluid">
	<div class="row">
                    <div class="col-lg-6">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Product form</h4>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo base_url(). 'Admin/create_action' ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15">Product Info</h3>
                                        <hr>
                                        
	    <div class="form-group">
            <label for = "bigint">Select Category <?php echo form_error('catid') ?></label>
                            <select name="catid" id="catid" class="form-control">
                               
                                <option value = ''>Select one</option>
                                <?php foreach($selectcatlog as $catlog): ?>
                                <option value = "<?php echo $catlog->id; ?>"><?php echo $catlog->catlog; ?></option>
                               
                                <?php endforeach; ?>
                               
                            </select>
            
        </div>
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" />
        </div>
	    <div class="form-group">
            <label for="int">Product Image <?php echo form_error('image') ?></label>
            <input type="file" class="form-control" id="userfile" name="userfile" />
            <!-- <input type="text" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" /> -->
            <!-- <input type="file" id = "profile_pic" onchange="theForm.submit()" class="form-control"> -->
        </div>
	    <div class="form-group">
            <label for="varchar">Details <?php echo form_error('details') ?></label>
            <input type="text" class="form-control" name="details" id="details" placeholder="Details"  />
        </div>
	    <div class="form-group">
            <label for="varchar">Price <?php echo form_error('price') ?></label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" />
        </div>
	    
	    <button type="submit" class="btn btn-primary">Submit</button> 
	    <a href="<?php echo site_url('Admin/productlist') ?>" class="btn btn-default">Cancel</a>
	
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

</div>