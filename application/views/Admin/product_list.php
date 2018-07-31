<div class="container-fluid">
	<div class="card card-outline-primary">
                            
                            <div class="card-body">
	 <h2 style="margin-top:0px">Product List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('Admin/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('Admin/productlist'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('Admin/productlist'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product table</h4>
                               
                                <div class="table-responsive m-t-40">
                                    <table class="table display table-bordered table-striped" >
            <tr>
                <th>No</th>
		<th>Category id</th>
		<th>ProductName</th>
		<th>Product Image</th>
		<th>Product Details</th>
		<th>Product Price</th>
		<th>Action</th>
            </tr><?php
            foreach ($product_data as $product)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $product->catid ?></td>
			<td><?php echo $product->name ?></td>
			<td><img src="<?php echo base_url() . 'uploads/' . $product->image ?>" alt="" border=3 height=100px width=100px></img></td>
			<td><?php echo $product->details ?></td>
			<td><?php echo $product->price ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('Admin/read/'.$product->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('Admin/update/'.$product->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('Admin/delete/'.$product->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                


































































</div>