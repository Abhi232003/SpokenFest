    <section class="banner-main col-100 flexCenter" id="banner">
        <video src="<?php echo base_url();?>front/images/banner-video.mp4" type='video/mp4' loop muted autoplay playsinline>
        </video>
        <div class="ap-bannerWrp textCenter">
            <div class="banner-logo textCenter">
                <img src="<?php echo base_url();?>front/images/spoken-New-Bann.png" alt="">
            </div>
            <div class="ap-btnWrps textCenter">
                <a href="<?php echo base_url('booktickets/'); ?>" class="banner-btns"><img src="<?php echo base_url();?>front/images/book-nowImg.png" alt=""></a>
                <!-- <a href="javascript:;" class="banner-btns scrollDwn" rel="lineup"><img src="<?php echo base_url();?>front/images/lineupbtn.png" alt=""></a> -->
                <a href="https://www.instagram.com/spokenfest/" class="banner-btns" target="_blank"><img src="<?php echo base_url();?>front/images/insta-btn.png" alt=""></a>

                 <!-- <a href="javascript:;" class="banner-btns" target="_blank"><img src="<?php echo base_url();?>front/images/spokenontheard.png" alt=""></a> -->

            </div>
            <div class=" banner-btns textCenter">
                <img src="<?php echo base_url();?>front/images/spokenontheard.png" alt="">
            </div>
        </div>
    </section>
     <section class="lineup-sec col-100 floatLft relative" id="lineup">
        <div class="lineupInner col-100 floatLft">
            <div class="lineup-head col-100 floatLft">
                <h2 class="lineHead">lineup</h2>
            </div>
            <div class="ap-greenBorder col-100 floatLft"></div>
            <div class="timeTabsWrp col-100 floatLft textCenter">
                <div class="ap-tabsMain col-100 floatLft relative">
                    <p class="col-100 floatLft textCenter body-font">Good things take time, and this year we’re going for the best. Stay tuned for an amazing lineup.</p>
                    <div class="st-dayWise col-100 floatLft">
                        <h3>For a day-wise lineup</h3>
                        <a href="https://www.instagram.com/spokenfest/?hl=en" class="Line-upBut"><span>Click here</span></a>
                    </div>
                    <div class="lineThrough col-100 floatLft absolute"><span class="col-100 floatLft"></span></div>
                    <ul class="tabsListing textCenter">
                        <?php 
                            $cnt = 1;
                            $current = 'current';
                            if(!empty($year)){
                            foreach ($year as $key => $val) {
                                if($cnt == 1){
                                    $current = 'current';
                                }
                        ?>
                        <li class="tabItem  <?php echo $current; ?>"><a href="javascript:void(0);" class="tabClick" data-tab="year-<?php echo $cnt; ?>"><?php echo $val['year']; ?></a></li>
                        
                    <?php $cnt++; $current = '';}} ?>
                    </ul>
                </div>
                <div class="ap-greenBorder col-100 floatLft"></div>
                <?php
                            $count = 1;
                            if(!empty($year)){
                            foreach ($year as $key => $value) {
                                if($count ==1){
                                    $current = 'current';
                                }
                        ?>
                <div class="tab-content tabWrpCommon col-100 floatLft <?php echo $current; ?>" id="year-<?php echo $count; ?>">
                    <div class="tab-inner col-100 floatLft">
                       <div class="lineup-slider col-100 floatLft">
                         <?php 
                            $yearId = $value['yearID'];
                            $yearLineup = $this->Common_model->getyearLineup($yearId);
                            // echo "<pre>";print_r($year);die();
                            $pattern = 1;
                            if(!empty($yearLineup)){
                            foreach ($yearLineup as $key => $year_Lineup) {
                                if($pattern==3){
                                    $pattern=1;
                                }
                        ?>
                        <div class="lineupCard pattern-<?php echo $pattern; ?>">
                            <span class="absolute inlineBlk dot-1"></span>
                            <span class="absolute inlineBlk dot-2"></span>
                            <span class="absolute inlineBlk dot-3"></span>
                            <span class="absolute inlineBlk dot-4"></span>
                            <div class="lineup-image col-100 floatLft">
                                <img src="<?php echo base_url(); ?>uploads/lineup/<?php echo $year_Lineup['lineupThumbImage']; ?>" alt="<?php echo $year_Lineup['lineupHeading']; ?>">
                            </div>
                            <div class="line-sep-op col-100 floatLft"></div>
                            <div class="lineup-name col-100 floatLft">
                                <h2><?php echo $year_Lineup['lineupHeading']; ?></h2>
                            </div>
                        </div>
                        <?php $pattern++;}} ?>
                        
                       </div>
                    </div>
                </div>
                <?php $count++;$current = '';}} ?>
            </div>
        </div>
    </section>
    <section class="st-experience col-100 floatLft relative black-bg" id="experience">
        <div class="st-lineDiv absolute desk">
            <span></span>
        </div>
        <div class="st-lineDivRgt absolute desk">
            <span></span>
        </div>
        <div class="experienceTxt col-100 floatLft">            
            <div class="lineup-head col-100 floatLft">
                <h2 class="abouthead experi">Experience</h2>
            </div>
            <div class="ap-greenBorder col-100 floatLft"></div>
        </div>
        <div class="experience-ListOut col-100 floatLft">
            <ul class="st-experience-List col-100 floatLft">
                <li>
                    <div class="experience-Card col-100 floatLft relative">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/KahaniKiDukaan.jpg">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Kahani Ki Dukaan
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Kahani Ki Dukaan</span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            This foundation from Guneher, Himachal Pradesh, a beautiful village nestled in mountains, comes down to SpokenFest every year to share their hearts full of stories, poems and songs!
                        </div>
                    </div>
                    
                </li>
                <li>
                    <div class="experience-Card even col-100 floatLft">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/BlindBookDate.jpg">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>The Blind Book Date
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show even">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>The Blind Book Date
                                </span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            <span class="italicFont">"Thou shalt not judge a book by its cover"</span><br>
                            At Spoken get a book just by trusting a stranger's (actually a friend's) recommendation, with Blind Book Date                            
                        </div>
                    </div>
                </li>
                <li>
                    <div class="experience-Card col-100 floatLft relative">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/ConvWithUniverse.jpg">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Conversations with the Universe
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Conversations with the Universe</span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            This year at Spoken, find yourself on an art date with the universe, equipped with colors, paints and feelings. Go solo or with the other wandering souls around you.
Let the Conversation find you with Molabocha
                        </div>
                    </div>
                    
                </li>
                <li>
                    <div class="experience-Card even col-100 floatLft">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/Poetry-Busker.jpg">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Poetry Buskers
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show even">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Poetry Buskers
                                </span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            How cute is it to tell a poet a topic, and then they instantly type out a poem on typewriter for you? Experience exactly that! At poetry buskers at Spoken '24
                        </div>
                    </div>
                </li>
                <li>
                    <div class="experience-Card col-100 floatLft relative">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/experience-Card1.png">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Vinyl Listening Station
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Vinyl Listening Station</span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            A special space made for all the audiophiles and collectors. With The Revolver Club, get to browse, listen to and buy vinyl records of your favorite music icons!

                        </div>
                    </div>
                    
                </li>
                <li>
                    <div class="experience-Card even col-100 floatLft">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/Book-Swap.jpg">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Book Swap Library</span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show even">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Book Swap Library</span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            A corner of Spoken, full with books, bought in by Spoken's audience! Bring a book, leave it, and take another book left by a stranger.
                        </div>
                    </div>
                </li>
                <li>
                    <div class="experience-Card col-100 floatLft relative">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/experience-Card2.png">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>I am Art - Block Printing
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>I am Art - Block Printing
                                </span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            Wondered how block printing really works? Do it yourself, as you get to make your own Spoken Tote bags
                        </div>
                    </div>
                    
                </li>
                <li>
                    <div class="experience-Card even col-100 floatLft">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/experience-Card4.png">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Junior Junction</span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show even">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Junior Junction</span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            A zone made for our youngest stars, junior junction has stories, activities, games by and for kids! Get your youngling along and introduce them to a world of stories
                        </div>
                    </div>
                </li>
                <li>
                    <div class="experience-Card col-100 floatLft relative">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/experience-Card5.png">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Enter the Epic
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Enter the Epic
                                </span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            A groundwide story treasure hunt, hop in for an adventure and win great deals, deeds and goodies
                        </div>
                    </div>
                    
                </li>
                <li>
                    <div class="experience-Card even col-100 floatLft">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/experience-Card6.png">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Unwind Zone/span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show even">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Unwind Zone</span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            A space to sit with yourself, read a book, listen to some music, and just breathe...
Unwind with
Soothing Listening Booths | Art Activities | De-stress games (Think pop its and slime!) and more...

                        </div>
                    </div>
                </li>
                <li>
                    <div class="experience-Card col-100 floatLft relative">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/experience-Card7.png">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>Me, You, Us
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>Me, You, Us</span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            A live art experience where artists doodle a portrait of the Spoken community, done in collaboration with Gaysi
                        </div>
                    </div>
                    
                </li>
                <li>
                    <div class="experience-Card even col-100 floatLft">
                        <div class="experience-CardImg col-100 floatLft">
                            <img src="<?php echo base_url(); ?>front/images/experience-Card8.png">
                        </div>
                        <div class="st-outerBoxExtra">
                            <span class="st-outerBox">
                                <span class="st-innerBox"><span>F&B Experiences
                                </span></span>
                            </span>
                        </div>
                        <div class="st-outerBoxExtra show even">
                            <span class="st-outerBox show1">
                                <span class="st-innerBox show2"><span>F&B Experiences
                                </span></span>
                            </span>
                        </div>
                        <div class="st-work-desc floatLft absolute">
                            At Spoken, everything is experiential! Even at the food court, and your favorite bars find great recommendations and conversations
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="aboutNew-sec col-100 floatLft relative black-bg" id="about">
        <div class="lineupInner col-100 floatLft">
            <div class="lineup-head col-100 floatLft">
                <h2 class="abouthead">ABout us</h2>
            </div>
            <div class="ap-greenBorder col-100 floatLft"></div>
            <div class="abt-contentWrp col-100 floatLft relative flexCenter">
                <span class="absolute inlineBlk abtMan-left"><img src="<?php echo base_url();?>front/images/sunflower-man-1.png" alt=""></span>
                <span class="absolute inlineBlk abtMan-right"><img src="<?php echo base_url();?>front/images/sunflower-man-2.png" alt=""></span>
                <div class="abtWrapper textCenter">
                    <p class="col-100 floatLft textCenter body-font"><?php echo $aboutData['aboutDescription']; ?></p>
                    <ul class="abtBtnsWrp col-100 floatLft">
                        <li class="inlineBlk"><span><?php echo $aboutData['aboutDays']; ?></span></li>
                        <li class="inlineBlk"><span><?php echo $aboutData['aboutStages']; ?></span></li>
                    </ul>
                    <ul class="abtBtnsWrp next col-100 floatLft">
                        <li class="inlineBlk"><span><?php echo $aboutData['aboutArtists']; ?></span></li>
                        <li class="inlineBlk"><span><?php echo $aboutData['aboutHeartbeats']; ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="ethos-sec col-100 floatLft relative" id="ethos">
        <div class="lineDiv absolute desk">
            <span></span>
        </div>
        <div class="ethios-cntWrp floatLft relative">
            <div class="lineDiv absolute mob">
                <span></span>
            </div>
            <div class="ethios-inner col-100 floatLft">
                <h2><img src="<?php echo base_url();?>front/images/ethios-title.png" alt=""></h2>
                <p class="col-100 floatLft body-font"><?php echo $ethosData['ethosHeading']; ?></p>
                <h3 class="col-100 floatLft">our key tenets are:</h3>
                <ul class="tenetList col-100 floatLft">
                    <li>
                        <span class="outer">
                            <span class="inner"><span>Inclusivity</span></span>
                        </span>
                        <p class="body-font">Spokenfest is a safe space for everyone to share their stories and joy. We embrace diversity and encourage artists from all different kinds of linguistic groups, ethnicities, and cultures. It doesn’t matter who you are as long as you are a hundred percent yourself!
                        </p>
                    </li>
                    <li>
                        <span class="outer">
                            <span class="inner"><span>ACCESSIBILITY </span></span>
                        </span>
                        <p class="body-font">Spokenfest is dedicated to ensuring that our storytelling and performing arts spaces are accessible and welcoming to all individuals regardless of their physical abilities. </p>
                    </li>
                    <li>
                        <span class="outer">
                            <span class="inner"><span>SUSTAINABILITY</span></span>
                        </span>
                        <p class="body-font">Spokenfest is all green flags. We are about leaving a net positive impact, in minds and the environment. We work with Skrap to ensure we are a zero waste festival and carbon positive festival.
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ethios-imgWrp floatRgt relative">
            <div class="ethios-imgBx col-100 floatLft">
                <div class="ethios-imgBx-inner col-100 floatLft">
                    <img src="<?php echo base_url();?>uploads/ethos/<?php echo $ethosData['ethosImageOne']; ?>" alt="<?php echo $ethosData['ethosImageOne']; ?>">
                </div>
            </div>
            <div class="ethios-imgBx col-100 floatLft">
                <div class="ethios-imgBx-inner col-100 floatLft">
                    <img src="<?php echo base_url();?>uploads/ethos/<?php echo $ethosData['ethosImageTwo']; ?>" alt="<?php echo $ethosData['ethosImageTwo']; ?>">
                </div>
            </div>
        </div>
    </section>
    <section class="stages-sec col-100 floatLft relative black-bg" id="stages">
        <div class="lineupInner col-100 floatLft">
            <div class="lineup-head col-100 floatLft">
                <h2 class="stageshead">Stages</h2>
            </div>
            <div class="ap-greenBorder col-100 floatLft"></div>
            <div class="stages-contentWrp col-100 floatLft relative flexCenter">
                <div class="stagesWrapper">
                   <div class="stages-slider col-100 floatLft">
                        <?php if(!empty($stages)){
                            foreach ($stages as $key => $value) {
                        ?>
                            <div class="stages-card col-100 floatLft relative">
                                <span class="absolute pin-img"><img src="<?php echo base_url();?>front/images/pin-img.png" alt=""></span>
                                <h2 class="floatLft col-100 textCenter"><?php echo $value['stagesHeading']; ?></h2>
                                <p class="floatLft textCenter col-100 body-font"><?php echo $value['stagesDescription']; ?></p>
                                <div class="sep-line col-100 floatLft relative"></div>
                                <div class="stages-img col-100 floatLft">
                                     <img src="<?php echo base_url();?>uploads/stages/<?php echo $value['stagesThumbImage']; ?>" alt="<?php echo $value['stagesHeading']; ?>">
                                </div>
                            </div>
                    <?php }}else{ ?>
                        <h2 class="floatLft col-100 textCenter">No Records</h2>
                    <?php } ?>
                   </div>
                </div>
            </div>
        </div>
    </section>
    <section class="St-partner col-100 floatLft black-bg" id="partner"> 
        <div class="lineupInner col-100 floatLft">
            <div class="lineup-head col-100 floatLft">
                <h2 class="partner">partner</h2>
            </div>
            <div class="ap-greenBorder col-100 floatLft"></div>
            <div class="st-PartnerStruct col-100 floatLft">
                <div class="st-partnerSponser col-100 floatLft">
                    <h2>Title Sponsor</h2>
                    <div class="st-partnerSponImg col-100 floatLft">
                        <img src="<?php echo base_url(); ?>front/images/st-sponser.png">
                    </div>
                </div>
                <div class="st-partnerpower col-100 floatLft">
                    <h2>Powered by</h2>
                    <div class="st-partnerPowImg col-100 floatLft">
                        <img src="<?php echo base_url(); ?>front/images/st-power.png">
                    </div>
                </div>
                <div class="st-partnerListOut col-100 floatLft">
                    <ul class="st-partnerList floatLft">
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>Sustainability partner</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/partner-list1.png">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>Celebration Partner</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/partner-list2.png">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>Radio Partner</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/partner-list3.png">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>Ticketing Partner</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/partner-list4.png">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>Coffee</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/nandan logo.png">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>MIRCHI</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/mirchi logo.png">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>MAX</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/max logo.png">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>BLACK & WHITE</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/Black & white logo-2.png">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="st-partnerListTxt col-100 floatLft">
                                <h2>BIRA</h2>
                                <div class="st-partnerListImg col-100 floatLft">
                                    <img src="<?php echo base_url(); ?>front/images/bira logo.png">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
    </section>
    <section class="gallery-sec col-100 floatLft black-bg" id="gallery">
        <div class="lineupInner col-100 floatLft">
            <div class="lineup-head col-100 floatLft">
                <h2 class="galleryhead">Gallery</h2>
            </div>
            <div class="ap-greenBorder col-100 floatLft"></div>
            <div class="col-100 floatLft gallery-wrp" id="animated-thumbnails-gallery">
                <?php if(!empty($galleryImage)){
                    foreach ($galleryImage as $key => $Image) {
                ?>
                <a href="<?php echo base_url();?>uploads/gallery/<?php echo $Image['galleryImage']; ?>">
                    <img src="<?php echo base_url();?>uploads/gallery/<?php echo $Image['galleryImage']; ?>" alt="">
                </a>
                <?php }}else{ ?>
                <h2 class="floatLft col-100 textCenter">No Records</h2>
            <?php } ?>
            </div>
            <div class="seeMoreWrp col-100 floatLft textCenter">
                <a href="javascript:;"><img src="<?php echo base_url();?>front/images/gallery-cta.png" alt="gallery-cta"></a>
            </div>
        </div>
    </section>
    <section class="vault-sec col-100 floatLft" id="vault">
        <div class="lineupInner col-100 floatLft">
            <div class="lineup-head col-100 floatLft">
                <h2 class="videoshead">Spoken videos</h2>
            </div>
            <div class="ap-greenBorder col-100 floatLft"></div>
            <div class="vaultOuter col-100 floatLft flexCenter">
                <div class="vaultWrp">
                    <div class="vault-slider col-100 floatLft">
                        <?php if(!empty($spokenVideos)){
                            foreach ($spokenVideos as $key => $Videos) {
                        ?>
                        <div class="vault-card">
                           <div class="vault-card-inner relative">
                                <img  src="<?php echo base_url();?>uploads/spokenVideo/<?php echo $Videos['spokenVideoThumbImage']; ?>" alt="<?php echo $Videos['spokenVideoThumbImage']; ?>">
                                <a href="<?php echo $Videos['spokenVideoLink']; ?>" class="absolute playClick popup-youtube">
                                    <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M34.9125 64.1668C51.0208 64.1668 64.0792 51.1085 64.0792 35.0002C64.0792 18.8919 51.0208 5.8335 34.9125 5.8335C18.8042 5.8335 5.74585 18.8919 5.74585 35.0002C5.74585 51.1085 18.8042 64.1668 34.9125 64.1668Z" stroke="#FBF6D8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M25.4917 35.6707V30.7998C25.4917 24.7332 29.7792 22.254 35.0292 25.2873L39.2584 27.7373L43.4875 30.1873C48.7375 33.2207 48.7375 38.179 43.4875 41.2123L39.2584 43.6623L35.0292 46.1123C29.7792 49.1457 25.4917 46.6665 25.4917 40.5998V35.6707Z" fill="#FBF6D8"/>
                                    </svg>
                                </a>
                           </div>
                        </div>
                        <?php }}else{ ?>
                            <h2 class="floatLft col-100 textCenter">No Records</h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="news-sec col-100 floatLft black-bg" id="media">

        <div class="lineupInner col-100 floatLft">

            <div class="lineup-head col-100 floatLft">

                <h2 class="newshead">Spoken news</h2>

            </div>

            <div class="ap-greenBorder col-100 floatLft"></div>

            <div class="newsOuter col-100 floatLft flexCenter">

                <div class="newsWrp">

                    <ul class="news-listing col-100 floatLft">

                        <?php if(!empty($spokenNews)){

                            foreach ($spokenNews as $key => $News) {

                        ?>

                        <li class="inlineBlk">

                           <a href="<?php echo $News['newsLink']; ?>" target="_blank">

                            <div class="news-card col-100 floatLft">

                                    <div class="news-img-outer col-100 floatLft">

                                        <div class="news-img-inner col-100 floatLft"><img src="<?php echo base_url();?>uploads/news/<?php echo $News['newsThumbImage']; ?>" alt="<?php echo $News['newsThumbImage']; ?>"></div>

                                    </div>

                                    <p class="col-100 floatLft"><?php echo $News['newsDescription']; ?></p>

                                </div>

                           </a>

                        </li>

                         <?php }}else{ ?>

                            <h2 class="floatLft col-100 textCenter">No Records</h2>

                        <?php } ?>

                    </ul>

                </div>

            </div>

        </div>

    </section>
    <div class="mfp-hide white-popup-block popup-partner" id="partner-pop">
        <div class="pop-inner col-100 floatLft">
            <form name="partnerWithForm" id="partnerWithForm" method="post" action="" class="np-form ">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <h2 class="partnerHead floatLft">Partner with us</h2>
                <ul class="partner-formList col-100 floatLft">
                    <li class="col-100 floatLft">
                        <div class="input-div col-100 floatLft">
                            <label class="floatLft body-font">Name*</label>
                            <input type="text" minlength="50" class="text-box col-100 floatLft body-font textalpha"  id="partnerName" name="partnerName">
                        </div>
                            <span id="partnerName_validate" class="error_info"></span>
                    </li>
                    <li class="col-100 floatLft">
                        <div class="input-div col-100 floatLft">
                            <label class="floatLft body-font">Email Address*</label>
                            <input type="text" minlength="50" class="text-box col-100 floatLft body-font" id="partnerEmail" name="partnerEmail">
                        </div>
                            <span id="partnerEmail_validate" class="error_info EmailExist_validate"></span>
                    </li>
                    <li class="col-100 floatLft">
                        <div class="input-div col-100 floatLft">
                            <label class="floatLft body-font">Phone Number*</label>
                            <input type="text" minlength="10" maxlength="10" class="text-box col-100 floatLft body-font numberOnly" id="partnerPhone" name="partnerPhone">
                        </div>
                            <span id="partnerPhone_validate" class="error_info mobileExist_validate"></span>
                    </li>
                    <li class="col-100 floatLft">
                        <div class="input-div col-100 floatLft">
                            <label class="floatLft body-font">You want to partner as*</label>
                            <div class="selectWrp col-100 floatLft">
                                <select class="col-100 floatLft body-font" id="partnerType" name="partnerType">
                                <option value="0">Select option</option>
                                <option value="1"> A food stall</option>
                                <option value="2">Flea market</option>
                                <option value="3">A Sponsor</option>
                                <option value="4">An artist</option>
                                <option value="5">A volunteer</option>
                                <option value="6">Other</option>
                            </select>
                            </div>
                        </div>
                        <span id="partnerType_validate" class="error_info"></span>
                    </li>
                    <li class="col-100 floatLft">
                        <div class="input-div col-100 floatLft">
                            <label class="floatLft body-font">Please tell us a bit about yourself*</label>
                            <textarea rows="4" minlength="255" class="col-100 floatLft body-font" id="partnerComment" name="partnerComment"></textarea>
                        </div>
                            <span id="partnerComment_validate" class="error_info"></span>
                    </li>
                    <li class="col-100 floatLft">
                        <div class="input-div col-100 floatLft">
                            <button type="button" name="submitPartnerWithForm" id="submitPartnerWithForm"><img src="<?php echo base_url();?>front/images/partner-submit.png" alt=""></button>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="mfp-hide white-popup-block popup-thankyou" id="partner-thankyou">
        <div class="pop-inner col-100 floatLft textCenter">
            <div class="logo"><img src="<?php echo base_url();?>front/images/thank-success-img.png" alt=""></div>
            <h2 class="thankHead">Thank you</h2>
            <p class="body-font">Thank you for reaching out. We will be in touch with you super soon!</p>
        </div>
    </div>