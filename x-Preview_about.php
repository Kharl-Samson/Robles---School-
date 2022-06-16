<?php
require 'php/generic.php';
$row_g = mysqli_fetch_array($search_general);
$rowName = explode(" ",$row_g['g_Sitename']);
$rowNameFirst = $rowName[0];
array_shift($rowName);
$rowSecondName = implode(" ",$rowName);

require 'php/previewgeneric.php';
$row_Previews = mysqli_fetch_array($search_generalPreview);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title><?php echo $row_g['g_Sitename']; ?></title>

     <link rel="stylesheet" href="css/Desktop/global.css">
     <link rel="stylesheet" href="css/Mobile/global.css">
     <link rel="stylesheet" href="css/Desktop/about.css">
     <link rel="stylesheet" href="css/Mobile/about.css">
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
   
     <!--Scrolling animation-->
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  </head>

<body>

<div class="for_desktop"><!--For Descktop div-->

    <div id="up">
        <div id="header" class="navbar_header">
            <div class="one">
                <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="img1" onclick="goHome()" class="logo_top">   
                <script src="js/redirectPage.js"></script>
                    <div>
                        <p class="a p_title" style="margin-top:10%; text-transform:uppercase;"><?php echo $rowNameFirst; ?></p>
                        <P class="b p_title" style="text-transform:uppercase;"><?php echo $rowSecondName; ?></P>
                    </div>
            </div>

        </div><!--End of header div-->


        <div id="content">
                <div id="left" class="left_content_about">
                        <p>About <?php echo $rowNameFirst; ?></p>
                        <p><?php echo $rowSecondName; ?></p>
                </div>

                <div id="right">
                    <img src="images/about_img.png">
                </div>    
        </div><!--End of content div-->
        
    </div><!--End of up div-->
    <div id="for_bottom_header_about">
            <div id="robles_about_box" data-aos="zoom-in-up">
                    <div id="top">
                        <div id="rob_Text" style="text-transform:uppercase;">
                            <p class="a"><?php echo $rowNameFirst; ?></p>
                            <P class="b"><?php echo $rowSecondName; ?></P>
                        </div>

                        <div id="tagline">
                            <p>making your</p>
                            <P><span style="color: #826ba4;">pregnancy</span> easy</P>
                        </div>
                    </div>

                    <div id="mid">                                
                        <p class="ourHistory_subtext"><?php echo $row_Previews['a_about']; ?></p>

                        <p id="provide">Our clinic provides</p>
                        <div id="provide_circle">
                            <span id="span_violet">care</span>
                            <span>happiness</span>
                            <span>quality</span>
                            <span id="span_violet">respect</span>
                        </div>
                    </div>
            </div>
    </div>

    <div id="content1_about">
           <center><img src="upload_img_generic/<?php echo $row_g['a_layoutimg']; ?>" class="about_robles_img" data-aos="fade-left"></center> 
    </div><!--End of content1_about div-->

    <div id="content2_about">

        <div id="weGradient">
            <p id="we_take_text">We take these values to heart</p>
            <div id="line"></div>
            <div id="values_about_container" data-aos="fade-right">
                <div class="values_about">
                    <img src="images/icons/passionate.png">
                    Passionate
                </div>
                <div class="values_about">
                    <img src="images/icons/professional.png">
                    Professional
                </div>
                <div class="values_about">
                    <img src="images/icons/efficient.png">
                    Efficient
                </div>
                <div class="values_about">
                    <img src="images/icons/innovative.png">
                    Innovative
                </div>
            </div>
        </div>


        <div id="getIntouch">
            <div id="left">
                <div class="location_text">Get in touch <img src="images/icons/getIntouchLoc.png" alt=""></div>
                <div class="location_subtext"><img src="images/index_loc.png" alt=""><?php echo $row_g['g_Location']; ?></div>
                <div class="location_subtext"><img src="images/index_contact.png" alt=""><?php echo $row_g['g_Contact']; ?></div>
                <div class="location_subtext"><img src="images/index_email.png" alt=""><?php echo $row_g['g_Email']; ?></div>
                <div class="location_subtext"><img src="images/index_working.png" alt=""><?php echo $row_g['g_WorkingHours']; ?></div>
            </div>
            <div id="right" data-aos="fade-up" data-aos-duration="500">
                <div style="width: 100%; height: 100%; border-radius:10px;"><iframe style="border-radius:10px;" width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Robles%20Maternity%20Clinic%20and%20Ultrasound,%20hospital,%20Apalit,%20Philippines+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/sport-gps/">bike gps</a></iframe></div>
            </div>
       
        </div>
           
           
     
    </div><!--End of content2_about div-->

</div><!--End of for_desktop div -->



</body>

</html>


<!--Script for typing effect-->
<script src="js/typingEffect.js"></script>
<!--Script for password-->

<!--Script for scrolling animation-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>


<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for pages Animation-->
<script src="jquery/pagesAnim.js"></script>

