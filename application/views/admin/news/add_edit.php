<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">News Add-Edit</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">News Add-Edit</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="<?=base_url();?>admin/news"><button class="btn btn-primary-rgba"> <i class="feather icon-list mr-2"></i>News List</button></a>
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
                    <?php if ($this->router->fetch_method() == 'news_view') {?>
                    News View <?php } else {?> News Add Edit <?php }?></h5>
                </div> 
                <div class="card-body">
                   <!-- For Messages -->
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                    <?php echo form_open_multipart(base_url('admin/news/add_edit'), 'class="form-horizontal"');  ?> 
                        <div class="form-row">
                          <div class="form-group col-md-6">
                                <label for="newsLink"><span class="text-danger">*</span> News Link</label>                        
                                <input type="text" autocomplete="off"  name="newsLink" class="form-control" id="newsLink" value="<?php echo isset($Fetch_data['newsLink']) ? set_value("newsLink", $Fetch_data['newsLink']) : set_value("newsLink"); ?>" placeholder="">
                                <input type="hidden" name="newsID" id="newsID" value="<?php echo isset($Fetch_data['newsID']) ? set_value("newsID", $Fetch_data['newsID']) : set_value("newsID"); ?>"> 
                            </div>
                        </div>
                        <div class="form-row">
                             <div class="form-group col-md-6">
                                <label for="newsThumbImage"><span class="text-danger">*</span> news Thumb Image </label>
                                <input type="file" class="form-control" id="newsThumbImage" name="newsThumbImage" placeholder="Fetch_data Image" value="<?php echo !empty($Fetch_data['newsThumbImage']) ? $Fetch_data['newsThumbImage'] : ''; ?>" />
                                <input type="hidden" name="old_newsThumbImage" id="old_newsThumbImage" value="<?php echo isset($Fetch_data['newsThumbImage']) ? $Fetch_data['newsThumbImage'] : ''; ?>" />
                                <?php if (isset($Fetch_data['newsThumbImage'])) {?>
                                    <img src="<?php echo base_url('uploads/news/' . $Fetch_data['newsThumbImage']); ?>" width="100" height="100" class="img-responsive"/>
                                <?php }?>
                                <span class="text-danger"><?php echo form_error('newsThumbImage'); ?></span>
                            </div>
                         </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="newsDescription"><span class="text-danger">*</span> news Description </label>
                                <textarea name="newsDescription" id="newsDescription"><?php echo isset($Fetch_data['newsDescription']) ? set_value("newsDescription", $Fetch_data['newsDescription']) : set_value("newsDescription"); ?></textarea>
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
CKEDITOR.replace('newsDescription',{
        allowedContent : true,
        filebrowserUploadUrl: "<?php echo base_url() ?>upload.php",
        filebrowserUploadMethod : "form"
    });
CKEDITOR.replace('newsShortDescription',{allowedContent:true,});
 </script>