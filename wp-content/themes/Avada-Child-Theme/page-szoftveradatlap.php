<?php
/* Template Name: Szoftver adatlap */
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
 exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<section id="content" class="full-width">
<?php while ( have_posts() ) : ?>
  <?php the_post(); ?>
  <div class="szoftver-adatlap adatlap-page">
    <div class="wrapper">
      <div class="szofver-adatlap-holder">
        <div class="fusion-row">
          <div class="adatlap-top">
            <div class="image-list">
              <div class="cover-img">
                <img src="https://vallalkozzdigitalisan.hu/dl/partners/35/termek_logo1297.png<?php /*echo get_the_post_thumbnail_url(get_the_ID());*/ ?>" alt="<?php echo the_title(); ?>">
              </div>
              <div class="images">

              </div>
            </div>
            <div class="data">
              <div class="titles">
                <div class="icologo">
                  <img src="https://vallalkozzdigitalisan.hu/dl/partners/35/termek_logo1297.png<?php /*echo get_post_meta(get_the_ID(), 'ai_szoftver_logo', true);*/ ?>" alt="<?php echo the_title(); ?>">
                </div>
                <h1><?php echo the_title(); ?></h1>
                <h2>Vállalatirányítási rendszer <?php echo get_post_meta(get_the_ID(), 'ai_szoftver_alcim', true); ?></h2>
              </div>
              <div class="divider"></div>
              <div class="short-desc">
                <?php echo the_excerpt(); ?>
              </div>
            </div>
          </div>

          <div class="divider"></div>
          
          <div class="szoftver-modules">
            Modulok
          </div>

          <div class="divider"></div>

          <div class="box-nav">
            <ul>
              <li><a href="#ismerteto">Szoftver ismeretető</a></li>
            </ul>
          </div>
          <div class="data-boxes">
            <a name="ismerteto"></a>
            <div class="box">
              <h3>Szoftver ismeretető</h3>
              <div class="box-content">
                <?php the_content(); ?>
              </div>
              <div class="backtop"><a href="#top">lap tetejére</a></div>
            </div>
            <div class="box">
              <h3>Szoftver ismeretető</h3>
              <div class="box-content">
                <?php the_content(); ?>
              </div>
              <div class="backtop"><a href="#top">lap tetejére</a></div>
            </div>
          </div>
        </div>
      </div>

      <div class="video-holder">
        <div class="fusion-row">
          <div class="wrapper">
            <div class="ajanlatkeres">
              <div class="ajanlat-btn">
                <a href="/ajanlat-keres">Ajánlat kérés <i class="fa fa-arrow-circle-o-right"></i></a>
              </div>
              <div class="videos">
                <h2>Videó bemutatók</h2>
                <div class="video-set">
                  videos...
                  <br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>
</section>
<script type="text/javascript">
	(function($){
		$('#main > .fusion-row').css({
			width: '100%',
      maxWidth: '100%'
		});
	})(jQuery)
</script>
<?php wp_reset_postdata(); ?>
<?php do_action( 'avada_after_content' ); ?>
<?php
get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
