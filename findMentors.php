<?php 

<a href="memberlist.php">Memberlist</a><br /> 
<a href="edit_account.php">Edit Account</a><br /> 
<a href="findmentors.php">FindMentors</a><br /> 
<a href="logout.php">Logout</a>
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
     
    // Everything below this point in the file is secured by the login system 
     
    // We can display the user's username to them by reading it from the session array.  Remember that because 
    // a username is user submitted content we must use htmlentities on it before displaying it to the user. 
?> 
Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>, Welcome Back!<br /> 

<?php

    require_once("inc/config.php");
    require_once(ROOT_PATH . "inc/products.php");
    $color='%blue%';
    //$recent = get_products_recent2($shirt1, $shirt2, $shirt3, $shirt4);
    $recent3 = get_products_recent3($color);

?><?php 
$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
?>

<head>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style2.css" type="text/css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700" type="text/css">
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>favicon.ico">
</head>

            <div class="section shirts page">

                <div class="wrapper">

                <h2>Find Awesome Mentors</h2>

                <ul class="products">
                    <?php
                        foreach(array_reverse($recent) as $product) {
                            include(ROOT_PATH . "inc/partial-product-list-view.html.php");
                        }
                    ?>
                </ul>
                <ul class="products">
                    <?php
                        foreach(array_reverse($recent3) as $product) {
                            include(ROOT_PATH . "inc/partial-product-list-view.html.php");
                        }
                    ?>
                </ul>

                </div>
            </div>



<?php include(ROOT_PATH . 'inc/footer.php') ?>
<a href="edit_account.php">Edit Account</a><br /> 
<a href="logout.php">Logout</a>