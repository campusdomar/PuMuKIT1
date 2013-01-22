<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.0">

  <?php foreach($serials as $s): $mms = PubChannelPeer::getMmsFromSerial(3, $s->getId())?>
  <?php $order = 1; foreach($mms as $v): ?>
    <url>
       <loc><?php echo url_for('serial/index?id='.$s->getId().'#'.$v->getId() , true)?></loc>
       <video:video>
          <video:content_loc><?php echo url_for('video/index?id='.$s->getId().'#'.$v->getId() , true)?></video:content_loc>
          <video:title>
            <?php echo str_replace('&', '&amp;', $s->getTitle())?> - <?php echo ($order++); $value= $v->getTitle(); echo str_replace('&', '&amp;', ($value == ''?'':' - '.$value))?>
          </video:title>
          <video:thumbnail_loc><?php echo $v->getFirstUrlPic(true) ?></video:thumbnail_loc>
          <video:description>
            <?php $value = $v->getDescription(); echo str_replace('&', '&amp;', $value ? $value : $s->getDescription()) ?>
          </video:description>
          <video:duration><?php echo $v->getDuration()?></video:duration>
       </video:video>
    </url>
  <?php endforeach;?>
<?php endforeach;?>
</urlset>

