<?php
require 'php/generic.php';
$row_g = mysqli_fetch_array($search_general);
$rowName = explode(" ",$row_g['g_Sitename']);
$rowNameFirst = $rowName[0];
array_shift($rowName);
$rowSecondName = implode(" ",$rowName);
?>
<script>
var seed = window.location.search.substring(window.location.search.indexOf('seed=') + 5);
if (seed.indexOf('&') >= 0) {
    seed = seed.substring(0, seed.indexOf('&'));
}
var text = seed.replace("%", " ");
alert(text)
</script>


<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title><?php echo $row_g['g_Sitename']; ?></title>

     <link rel="stylesheet" href="css/Desktop/global.css">
     <link rel="stylesheet" href="css/Mobile/global.css">
     <link rel="stylesheet" href="css/Desktop/index.css">
     <link rel="stylesheet" href="css/Mobile/index.css">
     <link rel="shortcut icon" type="image/png" href="images/icons/webIcon.png"> 
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
   

  </head>
<body>
<div class="for_desktop"><!--For Descktop div-->

    <div id="up">
        <div id="header" class="navbar_header">
            <div class="one">
                <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="img1" onclick="goHome()" class="logo_top"
                onerror="this.src='upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>'">   
                <script src="js/redirectPage.js"></script>
                    <div>
                        <p class="a p_title" style="margin-top:10%; text-transform:uppercase;"><?php echo $rowNameFirst; ?></p>
                        <P class="b p_title" style="text-transform:uppercase;"><?php echo $rowSecondName; ?></P>
                    </div>
            </div>


        </div><!--End of header div-->


        <div id="content">
                <div id="left" class="left_content_index">
                    <p class="ourVision">Welcome to</p>
                    <p class="ourVision1" style="text-transform:Capitalize;"><?php echo $rowNameFirst; ?></p>
                    <p class="ourVision2" style="text-transform:Capitalize;"><?php echo $rowSecondName; ?></p>
                    <p id="text" class="visionText"><?php echo $row_Preview['h_Tagline']; ?></p>
                </div>

                <div id="right">
                    <img src="upload_img_generic/<?php echo $row_g['h_Layoutimg']; ?>" id="index_right_img" onerror="this.src='upload_img_generic/<?php echo $row_g['h_Layoutimg']; ?>'">
                </div>
                
        </div><!--End of content div-->
        
    </div><!--End of up div-->

 

    <div id="sub_content">
            <p id="Ourbest">Our Best Services</p>

            <div id="best_ser_content" data-aos="fade-up-right" data-aos-duration="500">
                <div class="box">
                    <img src="images/pt_index.png">
                    Pregnancy Test
                </div>
                <div class="box"  data-aos="fade-up-right" data-aos-duration="500">
                    <img src="images/pn_index.png">
                    Pre-natal Checkup
                </div>
                <div class="box" data-aos="fade-up-left" data-aos-duration="500">
                    <img src="images/post_index.png">
                    Post-natal Checkup
                </div>
                <div class="box" data-aos="fade-up-left" data-aos-duration="500">
                    <img src="images/fp_index.png">
                    Family Planning
                </div>
            </div>
    </div>

    <div id="sub_content_1">
        <div id="left" data-aos="zoom-in-down" data-aos-duration="500" class="slideshow">
            <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                <img src="upload_img_generic/<?php echo $row_g['h_slide1']; ?>" onerror="this.src='upload_img_generic/<?php echo $row_g['h_slide1']; ?>'"> 
            </div>
            <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                <img src="upload_img_generic/<?php echo $row_g['h_slide2']; ?>" onerror="this.src='upload_img_generic/<?php echo $row_g['h_slide2']; ?>'">
            </div>
            <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                <img src="upload_img_generic/<?php echo $row_g['h_slide3']; ?>" onerror="this.src='upload_img_generic/<?php echo $row_g['h_slide3']; ?>'">
            </div>
        </div>

        <div id="right">
            <p id="vision_header">Our Vision</p>
            <p id="vision_content"><?php echo $row_g['g_Vision']; ?></p>
        </div>
    </div>

    <div id="getInTouch">
        <div id="top">
            <p id="a">GET IN TOUCH</p>
            <P id="b">Contact</P>
        </div>

        <div id="bot">
            <div class="box">
                <img src="images/index_contact.png" alt="">
                <p id="a">Contact</p>
                <p id="b"><?php echo $row_g['g_Contact']; ?></p>
            </div>
            <div class="box" >
                <img src="images/index_loc.png" alt="">
                <p id="a">Location</p>
                <p id="b"><?php echo $row_g['g_Location']; ?></p>
            </div>
            <div class="box">
                <img src="images/index_email.png" alt="">
                <p id="a">Email</p>
                <p id="b" style="word-break: break-all;"><?php echo $row_g['g_Email']; ?></p>
            </div>
            <div class="box" >
                <img src="images/index_working.png" alt="">
                <p id="a">WORKING HOURS</p>
                <p id="b"><?php echo $row_g['g_WorkingHours']; ?></p>
            </div>
        </div>
    </div>
     


</div><!--End of for_desktop div -->


<!------------------------------------------------------------------------------------------------------------->


</body>

</html>



<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->

<script src="jquery/pagesAnim.js"></script>

<!--Script for scrolling animation-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>





<script>
$(".slideshow > div:gt(0)").hide();

setInterval(function() {
  $('.slideshow > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('.slideshow');
}, 3000);



</script>