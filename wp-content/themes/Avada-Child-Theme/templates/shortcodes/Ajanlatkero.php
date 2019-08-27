<a name="_form"></a>
<form id="mailsend" action="" method="post">
  <input type="hidden" name="formtype" value="<?=$tipus?>">
  <div class="group-holder requester-holder" style="width: <?=$width?>%;">
      <div class="flxtbl">
        <div class="name">
          <div class="form-input-holder">
            <input type="text" id="name" name="name" class="form-control" placeholder="Név *" value="">
          </div>
        </div>
        <div class="email">
          <div class="form-input-holder">
            <input type="text" id="email" name="email" class="form-control" placeholder="E-mail *" value="">
          </div>
        </div>
        <div class="phone">
          <div class="form-input-holder">
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Telefon *" value="">
          </div>
        </div>
        <?php if ($tipus == 'ajanlatkeres'): ?>
          <?php
          if ( $post = get_page_by_path( 'szoftvereink', OBJECT, 'page' ) )
                $id = $post->ID;
            else
                $id = 0;
          if ($id != 0) {
            $szoftvers = get_children(array(
              'post_parent' => $id,
              'orderby' => 'menu_order',
              'order' => 'ASC'
            ));
          }
        ?>
        <div class="company">
          <div class="form-input-holder">
            <input type="text" id="company" name="company" class="form-control" placeholder="Cég" value="">
          </div>
        </div>
        <?php if ($szoftvers): ?>
        <div class="szoftver">
          <div class="form-input-holder">
            <select id="szoftver" name="szoftver" class="form-control">
              <option value="">-- válassza ki a kívánt szoftvert --</option>
              <option value="Információt kérek a Nekem megfelelő szoftverekről.">Információt kérek a Nekem megfelelő szoftverekről.</option>
              <option value="" disabled="disabled"></option>
              <?php foreach ((array)$szoftvers as $s): ?>
              <option value=""><?=$s->post_title?> - <?php echo get_post_meta($s->ID, METAKEY_PREFIX.'szoftver_subtitle', true); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <?php endif; ?>

        <?php endif; ?>
        <div class="uzenet">
          <div class="form-input-holder">
            <textarea name="uzenet" id="uzenet" class="form-control" placeholder="Üzenet"></textarea>
          </div>
        </div>
        <div class="accepts">
          <div class=""><input type="checkbox" name="adatvedelem" id="adatvedelem" value="1"> <label for="adatvedelem">* Az ajánlatkérés elküldésével elfogadom az <a href="/adavedelmi-nyilatkozat/" target="_blank">Adatvédelmi Nyilatkozatot</a> és hozzájárulok az adatai kezeléséhez.</label></div>
          <div class=""><input type="checkbox" name="marketing" id="marketing" value="1"> <label for="marketing">Hozzájárulok: marketing és üzleti célú megkeresésekhez, melyek az általam írt igényekkel relevánsak.</label></div>
        </div>
      </div>
  </div>

  <div class="btns">
    <div id="mail-msg" style="display: none; width: <?=$width?>%;">
      <div class="alert"></div>
    </div>
    <button type="button" id="mail-sending-btn" onclick="ajanlatkeresKuldes();"><?php echo $button_text; ?></button>
  </div>

</form>


<script type="text/javascript">
var mail_sending_progress = 0;
var mail_sended = 0;

grecaptcha.ready(function() {
    grecaptcha.execute('<?=CAPTCHA_SITE_KEY?>', {action: 'contactform'}).then(function(token) {
       jQuery('#mailsend .btns').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
    });
});

function ajanlatkeresKuldes()
{
  if(mail_sending_progress == 0 && mail_sended == 0){
    jQuery('#mail-sending-btn').html('<?php echo __('<?php echo $whatisit; ?> küldése folyamatban', 'Avada'); ?> <i class="fa fa-spinner fa-spin"></i>').addClass('in-progress');
    jQuery('#mailsend .missing').removeClass('missing');

    mail_sending_progress = 1;
    var mailparam  = jQuery('#mailsend').serializeArray();

    jQuery.post(
      '<?php echo admin_url('admin-ajax.php'); ?>?action=contact_form',
      mailparam,
      function(data){
        var resp = jQuery.parseJSON(data);
        console.log(resp);
        if(resp.error == 0) {
          mail_sended = 1;
          jQuery('#mail-msg').hide();
          jQuery('#mail-msg .alert').html('').removeClass('alert-danger');
          jQuery('#mailsend #name').val('');
          jQuery('#mailsend #email').val('');
          jQuery('#mailsend #phone').val('');
          jQuery('#mailsend #company').val('');
          jQuery('#mailsend #szoftver').val('');
          jQuery('#mailsend #uzenet').val('');
          jQuery('#mail-sending-btn').html('<?php echo __( $whatisit.' elküldve', 'Avada'); ?> <i class="fa fa-check-circle"></i>').removeClass('in-progress').addClass('sended');
        } else {
          jQuery('#mail-sending-btn').html('<?php echo $button_text; ?>').removeClass('in-progress');
          jQuery('#mail-msg').show();
          jQuery('#mail-msg .alert').html(resp.msg).addClass('alert-danger');
          mail_sending_progress = 0;
          if(resp.missing != 0) {
            jQuery.each(resp.missing_elements, function(i,e){
              jQuery('#mailsend #'+e).addClass('missing');
            });
          }
        }
      }
    );
  }
}
</script>
