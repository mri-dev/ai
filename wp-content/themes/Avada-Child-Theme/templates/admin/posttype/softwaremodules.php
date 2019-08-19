<?php global $wpdb, $post; ?>
<div class="programcontents modulcontents">
  <div class="wrapper">
    <div class="ct-groups">
      <?php
       $metakey = METAKEY_PREFIX . 'moduls_set';
       $moduls = unserialize(get_post_meta($post->ID, $metakey, true));
      ?>
      <h4>Modulok</h4>
      <div class="inputs">
        <div class="created">
          <?php foreach ((array)$moduls as $ct) { ?>
            <div class="input">
              <i class="fa fa-arrows-v"></i> <input type="text" name="<?=METAKEY_PREFIX?>moduls_add[]" value="<?=$ct?>" placeholder="Új modul címe">
            </div>
          <? } ?>
        </div>
        <div class="newinputs newmodulinputs">
          <div class="input new">
            <input type="text" name="<?=METAKEY_PREFIX?>moduls_add[]" value="" placeholder="Új modul címe">
          </div>
        </div>
      </div>
      <a class="new-adder" href="javascript:void(0);" onclick="addNewModulGroup()">+ új modul</a>
    </div>
    <div class="ct-sets">
      <h4>Tartalmak</h4>
      <div class="content-sets">
        <?php foreach ((array)$moduls as $ct) {
          $ct_slug = sanitize_title($ct);
          $meta_key = METAKEY_PREFIX . 'moduls';
          $savekey = METAKEY_PREFIX.'moduls_'.$ct_slug;
          $conte =  (get_post_meta($post->ID, $savekey, true));
          $cont = (is_serialized($conte)) ? maybe_unserialize($conte) : $conte;
          $cont['content'] = stripslashes($cont['content']);
        ?>
        <div class="set">
          <label for="<?=$meta_key.$ct_slug?>"><?php echo $ct; ?></label>
          <div id="modulelem-<?=$ct_slug?>"></div>
          <a class="new-adder" href="javascript:void(0);" onclick="addNewModulElem('<?=$ct_slug?>')">+ új modul elem</a>
        </div>
        <? } ?>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function addNewModulGroup() {
      jQuery(".newmodulinputs").append('<div class="input new"><input type="text" name="<?=METAKEY_PREFIX?>moduls_add[]" value="" placeholder="Új modul címe"></div>');
    }
    var wpeditorcount = 0;
    function addNewModulElem( modulslug ) {
      jQuery("#modulelem-"+modulslug).append('<div class="input new">'+
      '<div class="title"><input type="text" name="<?=METAKEY_PREFIX?>moduls[\''+modulslug+'\'][title][]?>" value="" placeholder="Modul elem elnevezése"></div>'+
      '<div class="shortdesc"><input type="text" name="<?=METAKEY_PREFIX?>moduls[\''+modulslug+'\'][shortdesc][]?>" value="" placeholder="Rövid ismertető szöveg"></div>'+
      '<div class="content"><textarea id="<?=METAKEY_PREFIX?>moduls_content_'+modulslug+'_'+wpeditorcount+'"></textarea></div>'+
      '</div>');
      var editorId = '<?=METAKEY_PREFIX?>moduls_content_'+modulslug+'_'+wpeditorcount;
      wp.editor.initialize(editorId, true);
      wpeditorcount++;
    }

    jQuery(document).ready(function($)
    {
       $('.inputs > .created').sortable({
           opacity: 0.6,
           cursor: 'move',
       });
    });
  </script>
</div>
