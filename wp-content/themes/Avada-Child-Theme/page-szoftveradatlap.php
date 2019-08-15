<?php
/* Template Name: Szoftver adatlap */
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
 exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>

<div class="szoftver-adatlap adatlap-page">
  <div class="wrapper">
    <?php echo the_title(); ?>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php
get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
