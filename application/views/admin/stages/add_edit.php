<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Stages Add-Edit</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Stages Add-Edit</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="<?=base_url();?>admin/stages"><button class="btn btn-primary-rgba"> <i class="feather icon-list mr-2"></i>Stages List</button></a>
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
                    <?php if ($this->router->fetch_method() == 'stages_view') {?>
                    Stages View <?php } else {?> Stages Add Edit <?php }?></h5>
                </div> 
                <div class="card-body">
                   <!-- For Messages -->
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                    <?php echo form_open_multipart(base_url('admin/stages/add_edit'), 'class="form-horizontal"');  ?> 
                        <div class="form-row">
                          <div class="form-group col-md-6">
                                <label for="stagesHeading"><span class="text-danger">*</span> Stages Heading</label>                        
                                <input type="text" autocomplete="off"  name="stagesHeading" class="form-control" id="stagesHeading" value="<?php echo isset($Fetch_data['stagesHeading']) ? set_value("stagesHeading", $Fetch_data['stagesHeading']) : set_value("stagesHeading"); ?>" placeholder="">
                                <input type="hidden" name="stagesID" id="stagesID" value="<?php echo isset($Fetch_data['stagesID']) ? set_value("stagesID", $Fetch_data['stagesID']) : set_value("stagesID"); ?>"> 
                            </div>
                         </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="stagesThumbImage"><span class="text-danger">*</span> Stages Thumb Image </label>
                                <input type="file" class="form-control" id="stagesThumbImage" name="stagesThumbImage" placeholder="Fetch_data Image" value="<?php echo !empty($Fetch_data['stagesThumbImage']) ? $Fetch_data['stagesThumbImage'] : ''; ?>" />
                                <input type="hidden" name="old_stagesThumbImage" id="old_stagesThumbImage" value="<?php echo isset($Fetch_data['stagesThumbImage']) ? $Fetch_data['stagesThumbImage'] : ''; ?>" />
                                <?php if (isset($Fetch_data['stagesThumbImage'])) {?>
                                    <img src="<?php echo base_url('uploads/stages/' . $Fetch_data['stagesThumbImage']); ?>" width="100" height="100" class="img-responsive"/>
                                <?php }?>
                                <span class="text-danger"><?php echo form_error('stagesThumbImage'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stagesDetailImage"><span class="text-danger">*</span> Stages Detail Image </label>
                                <input type="file" class="form-control" id="stagesDetailImage" name="stagesDetailImage" placeholder="Fetch_data Image" value="<?php echo !empty($Fetch_data['stagesDetailImage']) ? $Fetch_data['stagesDetailImage'] : ''; ?>" />
                                <input type="hidden" name="old_stagesDetailImage" id="old_stagesDetailImage" value="<?php echo isset($Fetch_data['stagesDetailImage']) ? $Fetch_data['stagesDetailImage'] : ''; ?>" />
                                <?php if (isset($Fetch_data['stagesDetailImage'])) {?>
                                    <img src="<?php echo base_url('uploads/stages/' . $Fetch_data['stagesDetailImage']); ?>" width="100" height="100" class="img-responsive"/>
                                <?php }?>
                                <span class="text-danger"><?php echo form_error('stagesDetailImage'); ?></span>
                            </div>
                        </div>
                    <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="stagesDescription"><span class="text-danger">*</span> Stages Description </label>
                                <textarea name="stagesDescription" id="stagesDescription"><?php echo isset($Fetch_data['stagesDescription']) ? set_value("stagesDescription", $Fetch_data['stagesDescription']) : set_value("stagesDescription"); ?></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="metaTitle">Meta Title</label>
                              <input type="text" autocomplete="off"  name="metaTitle" class="form-control" id="metaTitle" value="<?php echo isset($Fetch_data['metaTitle']) ? set_value("metaTitle", $Fetch_data['metaTitle']) : set_value("metaTitle"); ?>" placeholder="">

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="metaKeyword">Meta Keyword</label>
                              <input type="text" autocomplete="off"  name="metaKeyword" class="form-control" id="metaKeyword" value="<?php echo isset($Fetch_data['metaKeyword']) ? set_value("metaKeyword", $Fetch_data['metaKeyword']) : set_value("metaKeyword"); ?>" placeholder="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="metaDescription">Meta Description </label>
                                <textarea name="metaDescription"class="form-control" rows ="6" id="metaDescription"><?php echo isset($Fetch_data['metaDescription']) ? set_value("metaDescription", $Fetch_data['metaDescription']) : set_value("metaDescription"); ?></textarea>
                            </div>
                        </div>

                        <!-- </div> -->
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

<script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>
<script> 
CKEDITOR.replace('stagesDescription',{
        allowedContent : true,
        filebrowserUploadUrl: "<?php echo base_url() ?>upload.php",
        filebrowserUploadMethod : "form"
    });
CKEDITOR.replace('stagesShortDescription',{allowedContent:true,});
 </script>