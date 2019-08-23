<?php
  global $wpdb, $post;
  wp_enqueue_media();
  $my_saved_attachment_post_id = (int)get_post_meta($post->ID, METAKEY_PREFIX . 'szoftver_logo_id', true);

  if ($my_saved_attachment_post_id != 0) {
    $logo_attachment_url = wp_get_attachment_url( $my_saved_attachment_post_id );
  }
?>
<table class="<?=TD?>">
  <tr>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'szoftver_subtitle'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Szoftver alcíme</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input autocomplete="off" id="<?=$metakey?>" type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
  </tr>
  <tr>
    <td>
      <?php $logo_metakey = METAKEY_PREFIX . 'szoftver_logo_id'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Szoftver logója</strong></label></p>
      <img id='logo-preview' src='<?=$logo_attachment_url?>' width='100' height='100' style='max-height: 100px; width: 100px;'>
      <br>
      <button type="button" id="btn_medialib_logo">Kiválasztás</button>
      <input type='hidden' name='<?=$logo_metakey?>' id='<?=$logo_metakey?>' value='<?=$my_saved_attachment_post_id?>'>
    </td>
  </tr>
  <tr>
    <td>
      <?php $metakey = METAKEY_PREFIX . 'szoftver_videos'; ?>
      <p><label class="post-attributes-label" for="<?=$metakey?>"><strong>Videók (YouTube videók)</strong></label></p>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <textarea name="<?=$metakey?>" style="width: 100%; min-height: 100px;"><?=$value?></textarea>
      <p>
      A videó URL-ek új sorba legyenek linkenként.</p>
    </td>
  </tr>
</table>

<script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			jQuery('#btn_medialib_logo').on('click', function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Válassza ki a képet',
					button: {
						text: 'Kép kiválasztása',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#logo-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#<?=$logo_metakey?>' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

					// Finally, open the modal
					file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script>
