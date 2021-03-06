<div class="container-fluid">
	<div class="card card-outline-primary">
                            
                            <div class="card-body">
	 <h2 style="margin-top:0px">Categories List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('Admin/catlog_create'),'Add', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('Admin/Categories_list'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('Admin/Categories_list'); ?>" class="btn btn-default">Reset</a>
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
                                <h4 class="card-title">Categories table</h4>
                                
                                <div class="table-responsive m-t-40">
                               <table class="table display table-bordered table-striped" >
            <tr>
                <th>No</th>
        <th>Catlog</th>
        <th>Action</th>
            </tr><?php
            foreach ($categories_data as $categories)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $categories->catlog ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('Admin/catlog_read/'.$categories->id),'Read'); 
                echo ' | '; 
                echo anchor(site_url('Admin/catlogupdate/'.$categories->id),'Update'); 
                echo ' | '; 
                echo anchor(site_url('Admin/delete_catlog/'.$categories->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
        <?php echo anchor(site_url('categories/excel'), 'Excel', 'class="btn btn-primary"'); ?>
        <?php echo anchor(site_url('categories/word'), 'Word', 'class="btn btn-primary"'); ?>
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