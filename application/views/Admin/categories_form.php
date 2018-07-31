<div class="container-fluid">
    <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $action; ?>" method="post">
                                    <div class="form-body">
                                        
                                        

<h2 style="margin-top:0px">Categories <?php echo $button ?></h2><hr>

        <div class="form-group">
            <label for="varchar">Catlog <?php echo form_error('catlog') ?></label>
            <input type="text" class="form-control" name="catlog" id="catlog" placeholder="Catlog" value="<?php echo $catlog; ?>" />
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('Admin/Categories_list') ?>" class="btn btn-default">Cancel</a>
       </form>
       </div>
                        </div>
                    </div>
                </div>


</div>
                           

