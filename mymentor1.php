<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user']))                                                   
                                                        
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } 



$z=0;


$_SESSION['viewingmentor']=$z;    


//view check




    ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title>Mentor Bear | Profile</title>

        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

        <meta name="description" content="FlexyCodes - FlexyCard vCard Template. Creating my personal page!"/>

        <!-- CSS | bootstrap -->
        <!-- Credits: http://getbootstrap.com/ -->
        <link  rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

        <!-- CSS | font-awesome -->
        <!-- Credits: http://fortawesome.github.io/Font-Awesome/icons/ -->
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />

        <!-- CSS | animate -->
        <!-- Credits: http://daneden.github.io/animate.css/ -->
        <link rel="stylesheet" type="text/css" href="css/animate.min.css" />

        <!-- CSS | Normalize -->
        <!-- Credits: http://manos.malihu.gr/jquery-custom-content-scroller -->
        <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css" />

        <!-- CSS | Colors -->
        <link rel="stylesheet" type="text/css" href="css/colors/DarkBlue.css" />

        <!-- CSS | Style -->
        <!-- Credits: http://themeforest.net/user/FlexyCodes -->
        <link rel="stylesheet" type="text/css" href="css/main.css" />

        <!-- CSS | prettyPhoto -->
        <!-- Credits: http://www.no-margin-for-errors.com/ -->
        <link rel="stylesheet" type="text/css" href="css/prettyPhoto.css"/> 

        <!-- CSS | Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
        <!-- Favicon 
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon/favicon.ico">-->

        <!--[if IE 7]>
                <link rel="stylesheet" type="text/css" href="css/icons/font-awesome-ie7.min.css"/>
        <![endif]-->

        <style>
            @media only screen and (max-width : 991px){
                .resp-vtabs .resp-tabs-container {
                    margin-left: 13px;
                }
            }
            @media only screen and (min-width : 800px) and (max-width : 991px){
                .resp-vtabs .resp-tabs-container {
                    margin-left: 13px;
                    width:89%;
                }
            }           

        </style>

    </head>

    <body>

        <!--[if lt IE 7]>
                <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Laoding page -->
        <div id="preloader"><div id="spinner"></div></div>

        <!-- .slideshow -->
        <!--<ul class="cb-slideshow" id="cb_slideshow">
            <li><span>Image 01</span><div></div></li>
            <li><span>Image 02</span><div></div></li>
            <li><span>Image 03</span><div></div></li>
            <li><span>Image 04</span><div></div></li>
            <li><span>Image 05</span><div></div></li>
            <li><span>Image 06</span><div></div></li>
        </ul> -->
        <!-- /.slideshow -->  

        <!-- .wrapper --> 
        <div class="wrapper">

            <!--- .Content --> 
            <section class="tab-content">
                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="row">   


                                <div class="col-md-3 widget-profil">
                                    <div class="row">

                                        <!-- Profile Image -->
                                         <div class="col-lg-12 col-md-12 col-sm-3 col-xs-12 ">

                                            
                                            
                                            <div class="image-holder one" id="pic_prof_1"  >
                                                
                                                <img class="head-image up circle center-cropped3" style="background-image" src=<?php echo $_SESSION['savedprof'][$z]['photo']; ?>  alt="" />
                                               

                                            </div>

                                            <!-- style for simple image profile -->     
                                           
                                        </div>
                                        <!-- End Profile Image -->

                                        <div class="col-lg-12 col-md-12 col-sm-9 col-xs-12">

                                            <!-- Profile info -->
                                            <div id="profile_info">

                                                <h1 id="name" class="transition-02"><?php echo htmlentities($_SESSION['savednaem'][$z]['username'], ENT_QUOTES, 'UTF-8'); ?></h1>

                                                <h4 class="line"><span class="value"><?php if($_SESSION['savedprof'][$z]['hschool']==1) {
                                                                        echo "High School";

                                                                    } else {
                                                                       
                                                                        echo "College";
                                                                    }

                                                                     ?> Student</span>
                                                                <div class="clear"></div></h4>
                                                <h6><span class="fa fa-map-marker"></span> <?php 

                                                echo htmlentities($_SESSION['savedprof'][$z]['state'], ENT_QUOTES, 'UTF-8'); ?></h6>
                                            </div>
                                            <!-- End Profile info -->  


                                            <!-- Profile Description -->
                                            <div id="profile_desc">
                                               
                                            </div>
                                            <!-- End Profile Description -->  


                                            <!-- Name -->
                                            <div id="profile_social">
                                                <h6></h6>
                                                    <h6>Chat Coming Soon</h6>
                                                <div class="clear"></div>
                                            </div> 
                                            <!-- End Name -->  

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-9 flexy_content" style="padding-left: 0;padding-right: 0;">

                                    <!-- verticalTab menu -->
                                    <div id="verticalTab">

                                        <ul class="resp-tabs-list">
                                            <li class="tabs-blog hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a" data-tab-name="blog">
                                                <span class="tite-list">blog</span>
                                                <i class="fa fa-user icon_menu icon_menu_active"></i>
                                            </li>


                                          
                                            <a href="private.php" id="print"><i class="fa fa-arrow-left icon_print"></i> </a>
                                            <a href="deletementor1.php" id="print"><i class="fa fa-times icon_print"></i> </a>
                                          

                                        </ul>
                                        <!-- /resp-tabs-list -->

                                        <!-- resp-tabs-container --> 
                                       
                                            <!-- profile -->
                                            <div id="profile2" class="content_2">
                                                <!-- .title -->
                                                <h1 class="h-bloc">Mentor Profiles</h1>

                                                <div class="row top-p">
                                                    <div class="col-md-6 profile-l">

                                                        <!--About me-->
                                                        <div class="title_content">
                                                            <div class="text_content">

                                                                <?php
                                                                echo htmlentities($_SESSION['savednaem'][$z]['username'], ENT_QUOTES, 'UTF-8'); ?></div>
                                                            <div class="clear"></div>
                                                        </div>

                                                        <ul class="about">

                                                            <li>
                                                                <i class="glyphicon glyphicon-user"></i>
                                                                <label>Name</label>
                                                                <span class="value"><?php 

                                                                echo htmlentities($_SESSION['savednaem'][$z]['username'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                                <div class="clear"></div>
                                                            </li>

                                                            <li>
                                                                <i class="glyphicon glyphicon-book" ></i>
                                                                <label>School</label>
                                                                <span class="value"><?php if($_SESSION['savedprof'][$z]['hschool']==1) {
                                                                        echo "High School";
                                                                    } else {
                                                                        echo "College";
                                                                    }

                                                                    echo " Student"; ?></span>
                                                                <div class="clear"></div>
                                                            </li>

                                                            <li> 
                                                                <i class="glyphicon glyphicon-map-marker"></i>
                                                                <label>State</label>
                                                                <span class="value"><?php echo htmlentities($_SESSION['savedprof'][$z]['state'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                                <div class="clear"></div>
                                                            </li>

                                                            <li>
                                                                <i class="glyphicon glyphicon-envelope"></i>
                                                                <label>Email</label>
                                                                <span class="value"><?php echo htmlentities($_SESSION['savednaem'][$z]['email'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                                <div class="clear"></div>
                                                            </li>

                                                            <li>
                                                                <i class="glyphicon glyphicon-phone"></i>
                                                                <label>Gender</label>
                                                                <span class="value"><?php if($_SESSION['savedprof'][$z]['gender']==1) {
                                                                        echo "Female";
                                                                    } else {
                                                                        echo "Male";
                                                                    }

                                                                     ?></span>
                                                                <div class="clear"></div>
                                                            </li>

                                                            <li>


                                                               

                                                                 <i class="glyphicon glyphicon-globe"></i>
                                                                <label>College</label>
                                                                <span class="value"><?php echo $_SESSION['savedid'][$z][1] ?></span>
                                                                <div class="clear"></div>
                                                                   
                                                    
                                                                  

                                                                
                                                            </li>

                                                        </ul>


                                                        <p style="margin-bottom:20px">
                                                            
                                                            
                                                        </p>

                                                        <p style="margin-bottom:20px">
                                                            <i class="fa fa-quote-left"></i>       
                                                           <?php 

                                                           echo htmlentities($_SESSION['savedprof'][$z]['me'], ENT_QUOTES, 'UTF-8'); ?>

                                                        </p>

                                                    </div>
                                                    <!-- End left-wrap -->

                                                    <div  class="col-md-6 profile-r " >

                                                            
                                                            <img class="center-cropped2" id='profimg' style="background-image" src=<?php echo $_SESSION['savedprof'][$z]['photo']; ?> alt="" />
                                                
                                                    </div>

                                                </div>

                                                <div class="clear"></div>


                                                <div class="row" id="services">
                                                    <div class="col-md-12">
                                                        <div class="title_content">
                                                            <div class="text_content">Interests</div>
                                                            <div class="clear"></div>
                                                        </div>
                                                        
                                                         <div class="col-md-4 pack-service center">
                                                            <div class="service">
                                                                <div class="service-icon"><i class="fa fa-tag"></i></div>
                                                                <div class="service-detail">
                                                                    <h6>Academics</h6>
                                                                    <h6></h6>
                                                                    <?php 

                                                        if($_SESSION['prof3'][$z]['art']==1) {
                                                                        echo "<i class='fa fa-photo'></i> Art<br>";
                                                        } 
                                                        if($_SESSION['prof3'][$z]['biology']==1) {
                                                                        echo "<i class='fa fa-leaf'></i> Biology<br>";
                                                                    } 
                                                        if($_SESSION['prof3'][$z]['chemistry']==1) {
                                                                         echo "<i class='fa fa-flask'></i> Chemistry<br>";
                                                                    } 
                                                        if($_SESSION['prof3'][$z]['computers']==1) {
                                                                        echo "<i class='fa fa-laptop' Computers></i><br>";
                                                                    }             
                                                        if($_SESSION['prof3'][$z]['engineering']==1) {
                                                                       echo "<i class='fa fa-cogs'></i> Engineering<br>";
                                                                    } 
                                                        if($_SESSION['prof3'][$z]['economics']==1) {
                                                                        echo "<i class='fa fa-dollar'></i> Economics <br>";
                                                                    } 
                                                        if($_SESSION['prof3'][$z]['english']==1) {
                                                                        echo "<i class='fa fa-pencil'></i> English<br>";
                                                                    } 
                                                        if($_SESSION['prof3'][$z]['history']==1) {
                                                                        echo "<i class='fa fa-backward'></i> History<br>";
                                                                    } 

                                                        if($_SESSION['prof3'][$z]['literature']==1) {
                                                                        echo "<i class='fa fa-book'></i> Literature<br>";
                                                                    } 
                                                        if($_SESSION['prof3'][$z]['math']==1) {
                                                                       echo "<i class='fa fa-table'></i> Math<br>";
                                                                    } 
                                                        if($_SESSION['prof3'][$z]['music']==1) {
                                                                         echo "<i class='fa fa-music'></i> Music<br>";
                                                                    } 
                                                        if($_SESSION['prof3'][$z]['physics']==1) {
                                                                        echo "<i class='fa fa-bolt'></i> Physics<br>";
                                                                    } 
                                                        
                                                    
                                                        
                                                       
                                                        
                                                        
                                                        
                                                        
                                                        

                                                                     
                                                       ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 pack-service">
                                                            <div class="service center">
                                                                <div class="service-icon"><i class="fa fa-smile-o"></i></div>
                                                                <div class="service-detail">
                                                                    <h6>Extracurriculars</h6>
                                                                    <h6></h6>
                                                                    <?php echo $_SESSION['savedprof'][$z]['extra1']."<br>"; ?>
                                                                    <?php echo $_SESSION['savedprof'][$z]['extra2']."<br>"; ?>
                                                                    <?php echo $_SESSION['savedprof'][$z]['extra3']."<br>"; ?>
                                                                    <?php echo $_SESSION['savedprof'][$z]['extra4']."<br>"; ?>
                                                                    <?php echo $_SESSION['savedprof'][$z]['extra5']."<br>"; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 pack-service">
                                                            <div class="service center">
                                                                <div class="service-icon"><i class="fa fa-star"></i></div>
                                                                <div class="service-detail">
                                                                    <h6>Favorite Animals</h6>
                                                                    <h6></h6>
                                                                    <p>Panda Bear</p>
                                                                    <p>Brown Bear</p>
                                                                    <p>Black Bear</p>
                                                                    <p>Polar Bear</p>
                                                                    <p>Grizzly Bear</p>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                         

                                                        


                                                        
                                                    </div> 
                                                </div><!-- End Services -->


                                                <div class="clear"></div>
                                                <div class="border-list"></div>

                                                <div class="row" id="services">
                                                   
                                                </div>    
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="bottom-p">
                                                            <div class="title_content">
                                                                <div class="text_content">Mentoring Details</div>
                                                                <div class="clear"></div>
                                                            </div>

                                                            <div class="panel-group" id="accordion">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapse_tabs">
                                                                                I'd love to mentor in...
                                                                                <i class="glyphicon glyphicon-chevron-up" style="float: right;font-size: 13px;"></i>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseOne" class="panel-collapse collapse in">
                                                                        <div class="panel-body">
                                                                           
                                                                           <?php  if($_SESSION['savedprof'][$z]['academics']==1) {
                                                                        echo "Academics <br>";

                                                                    }       
                                                                    if($_SESSION['savedprof'][$z]['applications']==1) {
                                                                        echo "Applications <br>";
                                                                    }
                                                                    if($_SESSION['savedprof'][$z]['careers']==1) {
                                                                        echo "Careers <br>";
                                                                    } 
                                                                    if($_SESSION['savedprof'][$z]['scholarship']==1) {
                                                                        echo "Scholarships <br>";
                                                                    } 
                                                                     if($_SESSION['savedprof'][$z]['sociallife']==1) {
                                                                        echo "Social Life <br>";
                                                                    } 
                                                                    
                                                                    
                                                                    if($_SESSION['savedprof'][$z]['transitioning']==1) {
                                                                        echo "Transitioning to College <br>";
                                                                    } 
                                                                    

                                                                    ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapse_tabs">
                                                                                My Availability...
                                                                                <i class="glyphicon glyphicon-chevron-down" style="float: right;font-size: 13px;"></i>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseTwo" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                           

                                                                 <?php  if($_SESSION['savedprof'][$z]['saturdays']==1) {
                                                                        echo "Saturdays <br>";

                                                                    }       
                                                                    if($_SESSION['savedprof'][$z]['sundays']==1) {
                                                                        echo "Sundays <br>";
                                                                    }
                                                                    if($_SESSION['savedprof'][$z]['weekdays']==1) {
                                                                        echo "Weekdays <br>";
                                                                    } 
                                                                    
                                                                    

                                                                    ?>





                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title">
                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapse_tabs">
                                                                                Time each week I'd like to mentor...
                                                                                <i class="glyphicon glyphicon-chevron-down" style="float: right;font-size: 13px;"></i>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapseThree" class="panel-collapse collapse">
                                                                        <div class="panel-body">
                                                                            <i class="fa fa-quote-left"></i>  
                                                                            <?php
                                                                                

                                                                                switch ($_SESSION['savedprof'][$z]['time']) {
                                                                                    case 1:
                                                                                        echo "15-30 Minutes";
                                                                                        break;
                                                                                    case 2:
                                                                                        echo "30-45 Minutes";
                                                                                        break;
                                                                                    case 3:
                                                                                        echo "45-60 Minutes";
                                                                                        break;
                                                                                    case 4:
                                                                                        echo "1-1.5 Hours";
                                                                                        break;
                                                                                    case 5:
                                                                                        echo "1.5-3 Hours";
                                                                                        break;
                                                                                    case 6:
                                                                                        echo "3+ Hours";
                                                                                        break;
                                                                                }
                                                                                ?>
                                                                           </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>

                                            </div>
                                       
                                        </div>
                                        <!-- End #resp-tabs-container --> 

                                    </div><!-- End verticalTab -->

                                </div><!-- End flexy_content -->


                            </div><!-- End row -->

                        </div><!-- End col-md-12 -->

                    </div><!-- End row -->

                </div><!-- End container -->

            </section>
            <!-- End Content -->

        </div>
        <!-- End wrapper -->


        <!-- jquery | jQuery 1.11.0 -->
        <!-- Credits: http://jquery.com -->
        <script type="text/javascript" src="js/jquery.min.js"></script>

        <!-- Js | bootstrap -->
        <!-- Credits: http://getbootstrap.com/ -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script> 

        <!-- Js | jquery.cycle -->
        <!-- Credits: https://github.com/malsup/cycle2 -->
        <script type="text/javascript" src="js/jquery.cycle2.min.js"></script>
        <script type="text/javascript" src="js/easyResponsiveTabs2.js"></script>
        <!-- jquery | rotate and portfolio -->
        <!-- Credits: http://jquery.com -->
        <script type="text/javascript" src="js/jquery.mixitup.min.js"></script> 
        <script type="text/javascript" src="js/HeadImage.js"></script>

        <!-- Js | easyResponsiveTabs -->
        <!-- Credits: http://webtrendset.com/demo/easy-responsive-tabs/Index.html -->
        <script type="text/javascript" src="js/easyResponsiveTabs.min.js"></script>     

        <!-- Js | mCustomScrollbar -->
        <!-- Credits: http://manos.malihu.gr/jquery-custom-content-scroller -->
        <script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>     

        <!-- jquery | prettyPhoto -->
        <!-- Credits: http://www.no-margin-for-errors.com/ -->
        <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>

        <!-- Js | gmaps -->
        <!-- Credits: http://maps.google.com/maps/api/js?sensor=true-->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="js/gmaps.min.js"></script>

        <!-- Js | Js -->
        <!-- Credits: http://themeforest.net/user/FlexyCodes -->
        <script type="text/javascript" src="js/main.js"></script>

        <!-- code js for image rotate -->
        <script type="text/javascript">

            var mouseX;
            var mouseY;
            var imageOne;

            /* Calling the initialization function */
            $(init);

            /* The images need to re-initialize on load and on resize, or else the areas
             * where each image is displayed will be wrong. */
            $(window).load(init);
            $(window).resize(init);

            /* Setting the mousemove event caller */
            $(window).mousemove(getMousePosition);

            /* This function is called on document ready, on load and on resize
             * and initiallizes all the images */
            function init() {

                /* Instanciate the mouse position variables */
                mouseX = 0;
                mouseY = 0;

                /* Instanciate a HeadImage class for every image */
                imageOne = new HeadImage("one");

            }

            /* This function is called on mouse move and gets the mouse position. 
             * It also calls the HeadImage function to display the correct image*/
            function getMousePosition(event) {

                /* Setting the mouse position variables */
                mouseX = event.pageX;
                mouseY = event.pageY;

                /*Calling the setImageDirection function of the HeadImage class
                 * to display the correct image*/
                imageOne.setImageDirection();

            }

        </script>


        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </body>
</html>


