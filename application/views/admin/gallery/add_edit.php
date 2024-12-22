<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">gallery Add-Edit </h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">gallery Add-Edit</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="<?=base_url();?>admin/gallery"><button class="btn btn-primary-rgba"> <i class="feather icon-list mr-2"></i>gallery List</button></a>
            </div>                        
        </div>
    </div>          
</div>
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">                                
                    <h5 class="card-title mb-0">
                    <?php if ($this->router->fetch_method() == 'gallery_view') {?>
                    gallery View <?php } else {?> gallery Add Edit <?php }?></h5>
                </div> 
                <div class="card-body">
                   <!-- For Messages -->
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                    <?php echo form_open_multipart(base_url('admin/gallery/add_edit'), 'class="form-horizontal"');  ?> 
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="galleryImage"><span class="text-danger">*</span> gallery Thumb Image </label>
                                <input type="file" class="form-control" id="galleryImage" name="galleryImage" placeholder="Fetch_data Image" value="<?php echo !empty($Fetch_data['galleryImage']) ? $Fetch_data['galleryImage'] : ''; ?>" />
                                <input type="hidden" name="old_galleryImage" id="old_galleryImage" value="<?php echo isset($Fetch_data['galleryImage']) ? $Fetch_data['galleryImage'] : ''; ?>" />
                                <?php if (isset($Fetch_data['galleryImage'])) {?>
                                    <img src="<?php echo base_url('uploads/gallery/' . $Fetch_data['galleryImage']); ?>" width="100" height="100" class="img-responsive"/>
                                <?php }?>
                                <br>
                                  <span id="galleryImage_validate" class="text-danger"><?php echo form_error('galleryImage'); ?></span>
                                  <input type="hidden" name="galleryID" id="galleryID" value="<?php echo isset($Fetch_data['galleryID']) ? set_value("galleryID", $Fetch_data['galleryID']) : set_value("galleryID"); ?>">
                            </div>
                        </div>  
                        <div class="form-row">
                        <div class="form-group col-md-6">
                               <label for="sort_order"><span class="text-danger">*</span> gallery Sort Order</label>                        
                                <input type="text" autocomplete="off"  name="sort_order" class="form-control" id="sort_order" value="<?php echo isset($Fetch_data['sort_order']) ? set_value("sort_order", $Fetch_data['sort_order']) : set_value("sort_order"); ?>" placeholder="">
                              </div>
                          </div>                       
                        <div class="form-group col-md-6">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary-rgba font-16">
                        </div>
                     <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div> <!-- End row -->
</div>