<!DOCTYPE HTML>
<html>
  <head>
<?php
require_once("../wp-includes/query.php");
// remember, each post_type is a product (a woocommerce product)
$args = array('post_type' => 'product');
$pieces = new WP_Query($args);
?>
<script src="../js/boomshaka.js" type="text/javascript"></script>
<script src="../js/boomshaka-carousel.js" type="text/javascript"></script>
  </head>
  <body>
    <!-- FULL SCREEN? CAN YOU HEAR ME MAJOR TOM? -->
    <?php
    // do the loop here
    if ( $pieces->have_posts() ) : 
      while ( $pieces->have_posts() ) :
        echo('<div>');
          echo( get_the_thumbnail() );
        echo('</div>');
      endwhile;
    endif;
    ?>
    
  </body>
</html>