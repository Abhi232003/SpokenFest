<div class="breadcrumbbar">

    <div class="row align-items-center">

        <div class="col-md-8 col-lg-8">

            <h4 class="page-title">Edit About </h4>

            <div class="breadcrumb-list">

                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>

                    <li class="breadcrumb-item"><a href="#">Edit About </a></li>

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
                    <h5 class="card-title mb-0">Edit About </h5>
                </div>
                <div class="card-body">
                   <!-- For Messages -->
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                    <?php echo form_open_multipart(base_url('admin/about/edit/'.$about['aboutID']), 'class="form-horizontal" autocomplete="off" ' )?>   
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="aboutDays"><span class="text-danger">*</span>About Day's</label>
                            <input type="text" name="aboutDays" class="form-control  textalpha" id="aboutDays" value="<?= $about['aboutDays']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="aboutArtists"><span class="text-danger">*</span>About Artists</label>
                            <input type="text" name="aboutArtists" class="form-control  textalpha" id="aboutArtists" value="<?= $about['aboutArtists']; ?>">
                          </div>
                        </div>
                        <div class="form-row">
                         <div class="form-group col-md-6">
                            <label for="aboutStages"><span class="text-danger">*</span>About Stages</label>
                            <input type="text" name="aboutStages" class="form-control  textalpha" id="aboutStages" value="<?= $about['aboutStages']; ?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="aboutHeartbeats"><span class="text-danger">*</span>About Heartbeats</label>
                            <input type="text" name="aboutHeartbeats" class="form-control  textalpha" id="aboutHeartbeats" value="<?= $about['aboutHeartbeats']; ?>">
                          </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="aboutDescription"><span class="text-danger">*</span>About Description</label>
                            <textarea type="text" class="form-control" name="aboutDescription" id="aboutDescription" value="" ><?= $about['aboutDescription']; ?></textarea>
                          </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metaTitle"> Meta Title</label>
                            <input type="text" name="metaTitle"  class="form-control" id="metaTitle" value="<?= $about['metaTitle']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metaKeyword"> Meta Keyword</label>
                            <input type="text" name="metaKeyword"  class="form-control" id="metaKeyword" value="<?= $about['metaKeyword']; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="metaContent"> Meta Content</label>
                            <textarea type="text" class="form-control" name="metaContent" id="metaContent" value=""><?= $about['metaContent']; ?></textarea>
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

CKEDITOR.replace('aboutDescription');
</script>