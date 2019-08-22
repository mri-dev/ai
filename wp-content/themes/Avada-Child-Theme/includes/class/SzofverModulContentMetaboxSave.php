<?php
  class SzofverModulContentMetaboxSave implements MetaboxSaver
  {
    public function __construct()
    {
    }
    public function saving($post_id, $post)
    {
      global $wpdb;
      $set = array();
      $adder = $_POST[METAKEY_PREFIX . 'moduls_add'];

      foreach ((array)$adder as $a) {
        if( $a == '' ) continue;
        $set[] = $a;
      }

      $set = serialize($set);
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'moduls_set', $set );
      unset($set);

      $content_sets = $_POST[METAKEY_PREFIX . 'moduls'];

      foreach ((array)$content_sets as $setk => $datas) {
        $setk = str_replace(array('-',"'"), array('_',""), $setk);
        $savekey = METAKEY_PREFIX.'moduls_'.$setk;
        $savedata = array();
        $i = -1;
        foreach ((array)$datas['title'] as $ii )
        { $i++;
          $title = $datas['title'][$i];
          $sdesc = $datas['shortdesc'][$i];
          $desc = $datas['desc'][$i];

          if ($title == '') {
            continue;
          }

          $savedata['title'][] = $title;
          $savedata['shortdesc'][] = $sdesc;
          $savedata['desc'][] = $desc;
        }
        $savedata = maybe_serialize($savedata);
        $savedata = addslashes($savedata);
        auto_update_post_meta( $post_id, $savekey, $savedata );
      }
    }
  }
?>
