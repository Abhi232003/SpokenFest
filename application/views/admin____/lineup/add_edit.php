<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">lineup Add-Edit</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">lineup Add-Edit</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="<?=base_url();?>admin/lineup"><button class="btn btn-primary-rgba"> <i class="feather icon-list mr-2"></i>lineup List</button></a>
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
                    <?php if ($this->router->fetch_method() == 'lineup_view') {?>
                    lineup View <?php } else {?> lineup Add Edit <?php }?></h5>
                </div> 
                <div class="card-body">
                   <!-- For Messages -->
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                    <?php echo form_open_multipart(base_url('admin/lineup/add_edit'), 'class="form-horizontal"');  ?> 
                        <div class="form-row">
                          <div class="form-group col-md-6">
                                <label for="lineupYear"><span class="text-danger">*</span>lineup Category</label>
                                <select name="lineupYear" class="form-control" id="lineupYear" placeholder="">
                                <option value ="">Select lineup Category</option>
                                <?php
                                   //echo'<pre>';print_r($datas);print_r($Fetch_data);die('sdf');
                                   foreach ($datas as $value => $display_text) {
                                       ?>
                                <option value="<?php echo $display_text['yearID']; ?>" <?php echo (isset($Fetch_data['lineupYear']) && $Fetch_data['lineupYear']!='' && ($display_text['yearID'] == $Fetch_data['lineupYear']))?"selected" : ''; ?>><?php echo $display_text['year']; ?></option>
                                    <?php }
                                   ?>     
                             </select>
                          </div>
                          <div class="form-group col-md-6">
                                <label for="lineupHeading"><span class="text-danger">*</span> lineup Heading</label>                        
                                <input type="text" autocomplete="off"  name="lineupHeading" class="form-control" id="lineupHeading" value="<?php echo isset($Fetch_data['lineupHeading']) ? set_value("lineupHeading", $Fetch_data['lineupHeading']) : set_value("lineupHeading"); ?>" placeholder="">
                                <input type="hidden" name="lineupID" id="lineupID" value="<?php echo isset($Fetch_data['lineupID']) ? set_value("lineupID", $Fetch_data['lineupID']) : set_value("lineupID"); ?>"> 
                            </div>
                         </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="lineupThumbImage"><span class="text-danger">*</span> lineup Thumb Image </label>
                                <input type="file" class="form-control" id="lineupThumbImage" name="lineupThumbImage" placeholder="Fetch_data Image" value="<?php echo !empty($Fetch_data['lineupThumbImage']) ? $Fetch_data['lineupThumbImage'] : ''; ?>" />
                                <input type="hidden" name="old_lineupThumbImage" id="old_lineupThumbImage" value="<?php echo isset($Fetch_data['lineupThumbImage']) ? $Fetch_data['lineupThumbImage'] : ''; ?>" />
                                <?php if (isset($Fetch_data['lineupThumbImage'])) {?>
                                    <img src="<?php echo base_url('uploads/lineup/' . $Fetch_data['lineupThumbImage']); ?>" width="100" height="100" class="img-responsive"/>
                                <?php }?>
                                <span class="text-danger"><?php echo form_error('lineupThumbImage'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lineupDetailImage"><span class="text-danger">*</span> lineup Detail Image </label>
                                <input type="file" class="form-control" id="lineupDetailImage" name="lineupDetailImage" placeholder="Fetch_data Image" value="<?php echo !empty($Fetch_data['lineupDetailImage']) ? $Fetch_data['lineupDetailImage'] : ''; ?>" />
                                <input type="hidden" name="old_lineupDetailImage" id="old_lineupDetailImage" value="<?php echo isset($Fetch_data['lineupDetailImage']) ? $Fetch_data['lineupDetailImage'] : ''; ?>" />
                                <?php if (isset($Fetch_data['lineupDetailImage'])) {?>
                                    <img src="<?php echo base_url('uploads/lineup/' . $Fetch_data['lineupDetailImage']); ?>" width="100" height="100" class="img-responsive"/>
                                <?php }?>
                                <span class="text-danger"><?php echo form_error('lineupDetailImage'); ?></span>
                            </div>
                        </div>
                    <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="lineupDescription"><span class="text-danger">*</span> lineup Long Description </label>
                                <textarea name="lineupDescription" id="lineupDescription"><?php echo isset($Fetch_data['lineupDescription']) ? set_value("lineupDescription", $Fetch_data['lineupDescription']) : set_value("lineupDescription"); ?></textarea>
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
CKEDITOR.replace('lineupDescription',{
        allowedContent : true,
        filebrowserUploadUrl: "<?php echo base_url() ?>upload.php",
        filebrowserUploadMethod : "form"
    });
CKEDITOR.replace('lineupShortDescription',{allowedContent:true,});
 </script>