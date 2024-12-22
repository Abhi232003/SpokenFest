<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Spoken Videos Add-Edit</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Spoken Videos Add-Edit</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="<?=base_url();?>admin/spokenVideo"><button class="btn btn-primary-rgba"> <i class="feather icon-list mr-2"></i>Spoken Videos List</button></a>
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
                    <?php if ($this->router->fetch_method() == 'spokenVideo_view') {?>
                    Spoken Videos View <?php } else {?> Spoken Videos Add Edit <?php }?></h5>
                </div> 
                <div class="card-body">
                   <!-- For Messages -->
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                    <?php echo form_open_multipart(base_url('admin/spokenVideo/add_edit'), 'class="form-horizontal"');  ?> 
                        <div class="form-row">
                          <div class="form-group col-md-6">
                                <label for="spokenVideoLink"><span class="text-danger">*</span>Spoken Videos Link</label>                        
                                <input type="text" autocomplete="off"  name="spokenVideoLink" class="form-control" id="spokenVideoLink" value="<?php echo isset($Fetch_data['spokenVideoLink']) ? set_value("spokenVideoLink", $Fetch_data['spokenVideoLink']) : set_value("spokenVideoLink"); ?>" placeholder="">
                                <input type="hidden" name="spokenVideoID" id="spokenVideoID" value="<?php echo isset($Fetch_data['spokenVideoID']) ? set_value("spokenVideoID", $Fetch_data['spokenVideoID']) : set_value("spokenVideoID"); ?>"> 
                            </div>
                        </div>
                        <div class="form-row">
                             <div class="form-group col-md-6">
                                <label for="spokenVideoThumbImage"><span class="text-danger">*</span>Spoken Videos Thumb Image </label>
                                <input type="file" class="form-control" id="spokenVideoThumbImage" name="spokenVideoThumbImage" placeholder="Fetch_data Image" value="<?php echo !empty($Fetch_data['spokenVideoThumbImage']) ? $Fetch_data['spokenVideoThumbImage'] : ''; ?>" />
                                <input type="hidden" name="old_spokenVideoThumbImage" id="old_spokenVideoThumbImage" value="<?php echo isset($Fetch_data['spokenVideoThumbImage']) ? $Fetch_data['spokenVideoThumbImage'] : ''; ?>" />
                                <?php if (isset($Fetch_data['spokenVideoThumbImage'])) {?>
                                    <img src="<?php echo base_url('uploads/spokenVideo/' . $Fetch_data['spokenVideoThumbImage']); ?>" width="100" height="100" class="img-responsive"/>
                                <?php }?>
                                <span class="text-danger"><?php echo form_error('spokenVideoThumbImage'); ?></span>
                            </div>
                         </div>
                        <!--<div class="form-row">-->
                        <!--    <div class="form-group col-md-12">-->
                        <!--        <label for="spokenVideoDescription"><span class="text-danger">*</span> Spoken Videos Description </label>-->
                        <!--        <textarea name="spokenVideoDescription" id="spokenVideoDescription"><?php echo isset($Fetch_data['spokenVideoDescription']) ? set_value("spokenVideoDescription", $Fetch_data['spokenVideoDescription']) : set_value("spokenVideoDescription"); ?></textarea>-->
                        <!--    </div>-->
                        <!--</div>-->
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
CKEDITOR.replace('spokenVideoDescription',{
        allowedContent : true,
        filebrowserUploadUrl: "<?php echo base_url() ?>upload.php",
        filebrowserUploadMethod : "form"
    });
CKEDITOR.replace('spokenVideoShortDescription',{allowedContent:true,});
 </script>