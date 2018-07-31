<div class="container-fluid">
	<div class="row">
                    <div class="col-lg-6">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Product form</h4>
                            </div>
                            <div class="card-body">
                            	<h2 style="margin-top:0px">Product Read</h2>
						        <table class="table">
							    <tr><td>Catid</td><td><?php echo $catid; ?></td></tr>
							    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
							    <tr><td>Image</td><td><img src="<?php echo base_url() . 'uploads/' . $image ?>" alt="" border=3 height=100px width=100px></img></td></tr>
							    <tr><td>Details</td><td><?php echo $details; ?></td></tr>
							    <tr><td>Price</td><td><?php echo $price; ?></td></tr>
							    <tr><td></td><td><a href="<?php echo site_url('Admin/productlist') ?>" class="btn btn-default">Cancel</a></td></tr>
								</table>
                            </div>
                        </div>
                    </div>
    </div>
</div>