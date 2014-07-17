<?php

	require_once("../inc/config.php");
	require_once(ROOT_PATH . "inc/products.php");
    $shirt1=rand(101,132);
    $shirt2=rand(101,132);
    $shirt3=rand(101,132);
    $shirt4=rand(101,132);
    $color='%blue%';
	//$recent = get_products_recent2($shirt1, $shirt2, $shirt3, $shirt4);
    $recent3 = get_products_recent3($color);

?><?php 
$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
?>
<html>
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