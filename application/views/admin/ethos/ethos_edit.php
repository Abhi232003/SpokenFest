<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Edit Ethos </h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Edit Ethos </a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
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
                    <h5 class="card-title mb-0">Edit Ethos </h5>
                </div>
                <div class="card-body">
                   <!-- For Messages -->
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                    <?php echo form_open_multipart(base_url('admin/ethos/edit/'.$ethos['ethosID']), 'class="form-horizontal" autocomplete="off" ' )?>   
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ethosHeading"><span class="text-danger">*</span>Ethos Heading</label>
                            <input type="text" name="ethosHeading" class="form-control  textalpha" id="ethosHeading" value="<?= $ethos['ethosHeading']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ethosImageOne"><span class="text-danger">*</span>Ethos Image One<span class="text-danger"></span></label>
                            <input type="file" name="ethosImageOne" class="form-control" id="ethosImageOne" value="<?= $ethos['ethosImageOne']; ?>">
                            <input type="hidden" name="old_image" id="old_image" value="<?php echo (count($ethos)>0)? $ethos['ethosImageOne']: '';?>">
                            <img src="<?php echo base_url();?>uploads/ethos/<?php echo $ethos['ethosImageOne']; ?>" style="width: 170px; height: 115px;">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ethosImageTwo"><span class="text-danger">*</span>Ethos Image Two <span class="text-danger"></span></label>
                            <input type="file" name="ethosImageTwo" class="form-control" id="ethosImageTwo" value="<?= $ethos['ethosImageTwo']; ?>">
                            <input type="hidden" name="old_image" id="old_image" value="<?php echo (count($ethos)>0)? $ethos['ethosImageTwo']: '';?>">
                            <img src="<?php echo base_url();?>uploads/ethos/<?php echo $ethos['ethosImageTwo']; ?>" style="width: 170px; height: 115px;">
                        </div>
                    </div>
                        <div class="form-row">
                         <div class="form-group col-md-6">
                            <label for="ethosCreativityDescription"><span class="text-danger">*</span>Ethos Creativity</label>
                            <textarea type="text" class="form-control" name="ethosCreativityDescription" id="ethosCreativityDescription" value="" ><?= $ethos['ethosCreativityDescription']; ?></textarea>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="ethosSustainabilityDescription"><span class="text-danger">*</span>Ethos Sustainability</label>
                            <textarea type="text" class="form-control" name="ethosSustainabilityDescription" id="ethosSustainabilityDescription" value="" ><?= $ethos['ethosSustainabilityDescription']; ?></textarea>
                          </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="ethosSafetyDescription"><span class="text-danger">*</span>Ethos Safety</label>
                            <textarea type="text" class="form-control" name="ethosSafetyDescription" id="ethosSafetyDescription" value="" ><?= $ethos['ethosSafetyDescription']; ?></textarea>
                          </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metaTitle"> Meta Title</label>
                            <input type="text" name="metaTitle"  class="form-control" id="metaTitle" value="<?= $ethos['metaTitle']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metaKeyword"> Meta Keyword</label>
                            <input type="text" name="metaKeyword"  class="form-control" id="metaKeyword" value="<?= $ethos['metaKeyword']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metaContent"> Meta Content</label>
                            <textarea type="text" class="form-control" name="metaContent" id="metaContent" value=""><?= $ethos['metaContent']; ?></textarea>
                          </div>
                    </div>
                      <input type="submit" name="submit" value="Update " class="btn btn-primary-rgba font-16">
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div> <!-- End row -->
</div>
 <script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>
<script> 
CKEDITOR.replace('ethosCreativityDescription');
CKEDITOR.replace('ethosSustainabilityDescription');
CKEDITOR.replace('ethosSafetyDescription');
</script>