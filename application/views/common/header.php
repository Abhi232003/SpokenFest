<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T37FC8NT');</script>
    <!-- End Google Tag Manager -->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>front/images/favicon.png" sizes="16x16">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lightgallery-bundle.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css" integrity="sha512-GRxDpj/bx6/I4y6h2LE5rbGaqRcbTu4dYhaTewlS8Nh9hm/akYprvOTZD7GR+FRCALiKfe8u1gjvWEEGEtoR6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>front/js/magnific/magnific-popup.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>front/js/slick-slider/slick.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/init.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/style.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>front/css/device.css">

    <title>Spoken Fest</title>

    <script>

      var base_url = "<?php echo base_url();?>";

     </script>   

</head>
<?php 
if(isset($_GET['utm_source'])){
    $utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : '';
    $utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : '';
    $utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : '';
    $utm_term = isset($_GET['utm_term']) ? $_GET['utm_term'] : '';
    $this->load->library('session');
    $session_id = $this->session->session_id;
    $sessionMatch = $this->Common_model->getRow('fx_utm_source', array('session_id'=>$session_id));

    $utmsourceMatch = $this->Common_model->getRow('fx_utm_source', array('utm_source' => $utm_source));
    if(empty($sessionMatch && $utmsourceMatch)){
        $data = array(
            'utm_source' => $utm_source,
            'utm_medium' => $utm_medium,
            'utm_campaign' => $utm_campaign,
            'utm_term' => $utm_term,
            'session_id'=>$session_id,
            'date_added'=>date('Y-m-d h:i:s'),
        );
        $this->db->insert('fx_utm_source', $data);
    }

}
$bodyClass = '';
$tikitDetail = $this->uri->segment(1);
$thankyou = $this->uri->segment(1);
if($tikitDetail == 'booktickets' || $thankyou == 'thankyou'){$bodyClass = 'ap-tikitDetail';}
?>
    <body class="<?php echo $bodyClass; ?>" >
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T37FC8NT"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div id="load"></div>
        <header class="col-100 floatLft">

            <div class="headerWrap">

                <div class="headerInner col-100 floatLft">

                    <div class="logo-header floatLft"><a href="javascript:void(0);" class="scrollDwn" rel="banner"><img src="<?php echo base_url(); ?>front/images/spoken-New-head.png" alt="Spoken Mic Logo"></a></div>

                    <nav class="floatRgt">

                        <a href="javascript:;" class="mob-menuClose floatRgt"><img src="<?php echo base_url(); ?>front/images/close-menu.png" alt=""></a>

                        <ul class="navigation col-100 floatLft">

                            <!-- <li><a href="javascript:void(0);" class="scrollDwn" rel="lineup">lineup</a></li> -->

                            <li><a href="javascript:void(0);" class="scrollDwn" rel="experience">Experience</a></li>

                            <li><a href="javascript:void(0);" class="scrollDwn" rel="about">about us</a></li>

                            <li><a href="javascript:void(0);" class="scrollDwn" rel="ethos">Ethos</a></li>

                            <li><a href="javascript:void(0);" class="scrollDwn" rel="stages">stages</a></li>

                            <li><a href="javascript:void(0);" class="scrollDwn" rel="partner">Partner</a></li>

                            <li><a href="javascript:void(0);" class="scrollDwn" rel="gallery">Gallery</a></li>

                            <li><a href="javascript:void(0);" class="scrollDwn" rel="vault">Spoken Videos</a></li>

                            <li><a href="javascript:void(0);" class="scrollDwn" rel="media">Media</a></li>

                            <li><a href="#partner-pop" class="partnerBtn"><img src="<?php echo base_url(); ?>front/images/partner-btn.png" alt=""></a></li>

                        </ul>

                    </nav>

                    <a href="javascript:;" class="mobile-ham"><img src="<?php echo base_url(); ?>front/images/menu-bar.png" alt=""></a>

                </div>

            </div>



        </header>



