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
        <br>
      </div>
      <a class="new-adder" href="javascript:void(0);" onclick="addNewModulGroup()">+ új modul</a>
      <p>A modul elemek hozzáadásához mentse a modulokat a bejegyzés elmentésével. Az elemek ezután adhatóak hozzá a modulokhoz.</p>
    </div>
    <div class="ct-sets">
      <h4>Tartalmak</h4>
      <div class="content-sets">
        <?php foreach ((array)$moduls as $ct) {
          $ct_slug = sanitize_title($ct);
          $ct_slug_safe = str_replace(array('-'),array('_'),$ct_slug);
          $meta_key = METAKEY_PREFIX . 'moduls';
          $savekey = METAKEY_PREFIX.'moduls_'.$ct_slug;
          $conte =  (get_post_meta($post->ID, $savekey, true));
          $cont = (is_serialized($conte)) ? maybe_unserialize($conte) : $conte;
          $cont['content'] = stripslashes($cont['content']);
          $modul_items = unserialize(get_post_meta($post->ID, METAKEY_PREFIX.'moduls_'.$ct_slug_safe, true));
        ?>
        <div class="set">
          <label for="<?=$meta_key.$ct_slug_safe?>"><?php echo $ct; ?></label>
          <div id="modulelem-<?=$ct_slug_safe?>" class="elem-inputs">
          <?php $ni = -1; foreach ( (array)$modul_items['title'] as $mi ): $ni++; ?>
          <div class="input">
            <div class="title">
              <input type="text" name="<?=METAKEY_PREFIX?>moduls[<?=$ct_slug_safe?>][title][]" value="<?=stripslashes($modul_items['title'][$ni])?>" placeholder="Modul elem elnevezése - Üresen hagyva törlődik az elem">
              <div class="sorting" title="Ragadja meg az átrendezéshez"><i class="fa fa-bars"></i></div>
            </div>
            <div class="shortdesc">
              <input type="text" name="<?=METAKEY_PREFIX?>moduls[<?=$ct_slug_safe?>][shortdesc][]" value="<?=stripslashes($modul_items['shortdesc'][$ni])?>" placeholder="Rövid ismertető szöveg">
            </div>
            <div class="content">
              <?php wp_editor( wpautop(stripslashes($modul_items['desc'][$ni])), METAKEY_PREFIX.'_moduls_'.$ct_slug_safe.'_'.$ni.'_desc', array(
                'textarea_name' => METAKEY_PREFIX.'moduls['.$ct_slug_safe.'][desc][]',
                'wpautop' => false
              )); ?>
            </div>
            <br>
            <div class="kiemelt">
              <label for="<?=METAKEY_PREFIX?>moduls_cb_<?=$ct_slug_safe?>_kiemelt"><input type="checkbox" id="<?=METAKEY_PREFIX?>moduls_cb_<?=$ct_slug_safe?>_kiemelt" name="<?=METAKEY_PREFIX?>moduls[<?=$ct_slug_safe?>][kiemelt][]" value="1" <?=($modul_items['kiemelt'][$ni] == '1')?'checked="checked"':''?>> Kiemelt elem</label>
            </div>
          </div>
          <?php endforeach; ?>
		  <div class="input">
            <div class="title">
              <input type="text" name="<?=METAKEY_PREFIX?>moduls[<?=$ct_slug_safe?>][title][]" value="" placeholder="Modul elem elnevezése">
              <div class="sorting" title="Ragadja meg az átrendezéshez"><i class="fa fa-bars"></i></div>
            </div>
            <div class="shortdesc">
              <input type="text" name="<?=METAKEY_PREFIX?>moduls[<?=$ct_slug_safe?>][shortdesc][]" value="" placeholder="Rövid ismertető szöveg">
            </div>
            <div class="content">
              <?php wp_editor( '', METAKEY_PREFIX.'_moduls_'.$ct_slug_safe.'_'.($ni+1).'_desc', array(
                'textarea_name' => METAKEY_PREFIX.'moduls['.$ct_slug_safe.'][desc][]',
                'wpautop' => false
              )); ?>
            </div>
            <br>
            <div class="kiemelt">
              <label for="<?=METAKEY_PREFIX?>moduls_cb_<?=$ct_slug_safe?>_kiemelt"><input type="checkbox" id="<?=METAKEY_PREFIX?>moduls_cb_<?=$ct_slug_safe?>_kiemelt" name="<?=METAKEY_PREFIX?>moduls[<?=$ct_slug_safe?>][kiemelt][]" value="1" <?=($modul_items['kiemelt'][$ni] == '1')?'checked="checked"':''?>> Kiemelt elem</label>
            </div>
          </div>
          </div>
          <a class="new-adder" href="javascript:void(0);" onclick="addNewModulElem('<?=$ct_slug_safe?>')">+ új modul elem</a>
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
      '<div class="title"><input type="text" name="<?=METAKEY_PREFIX?>moduls['+modulslug+'][title][]?>" value="" placeholder="Modul elem elnevezése"><div class="sorting" title="Ragadja meg az átrendezéshez"><i class="fa fa-bars"></i></div></div>'+
      '<div class="shortdesc"><input type="text" name="<?=METAKEY_PREFIX?>moduls['+modulslug+'][shortdesc][]?>" value="" placeholder="Rövid ismertető szöveg"></div>'+
      '<div class="content"><textarea id="<?=METAKEY_PREFIX?>moduls_content_'+modulslug+'_'+wpeditorcount+'" name="<?=METAKEY_PREFIX?>moduls['+modulslug+'][desc][]?>"></textarea></div>'+
      '<br>'+
      '<div class="kiemelt"><label for="<?=METAKEY_PREFIX?>moduls_cb_'+modulslug+'_kiemelt"><input type="checkbox" id="<?=METAKEY_PREFIX?>moduls_cb_'+modulslug+'_kiemelt" name="<?=METAKEY_PREFIX?>moduls['+modulslug+'][kiemelt][]" value="1"> Kiemelt elem</label></div>'+
      '</div>');
      var editorId = '<?=METAKEY_PREFIX?>moduls_content_'+modulslug+'_'+wpeditorcount;
      wp.editor.initialize(editorId, {
          tinymce: {
            plugins: 'charmap, hr, media, paste, tabfocus, textcolor, fullscreen, wordpress, wpeditimage, wpgallery, wplink, wpdialogs, wpview' ,
            toolbar1: 'bold, italic, strikethrough, bullist, numlist, blockquote, hr, alignleft, aligncenter, alignright, link, unlink, wp_more, spellchecker, fullscreen, wp_adv' ,
            toolbar2: 'formatselect, underline, alignjustify, forecolor, pastetext, removeformat, charmap, outdent, indent, undo, redo, wp_help' ,
            wpautop: true
          },
          quicktags: true,
          mediaButtons: true,
          language: 'hu'
      });
      wpeditorcount++;
    }

    jQuery(document).ready(function($)
    {
       $('.inputs > .created').sortable({
           opacity: 0.6,
           cursor: 'move',
       });

       $('.content-sets .set .elem-inputs').sortable({
           opacity: 0.6,
           cursor: 'move',
       });
    });
  </script>
</div>
