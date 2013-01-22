<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<rss version="2.0"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:g="http://base.google.com/ns/1.0"
     xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
     xmlns:arca="http://arca.uc3m.es/">
<channel>
 <title><?php echo sfConfig::get('app_info_title')?></title>
 <description><?php echo sfConfig::get('app_info_description')?></description>
 <link><?php echo sfConfig::get('app_info_link')?></link>
 <copyright><?php echo sfConfig::get('app_info_copyright')?></copyright>
 <managingEditor><?php echo sfConfig::get('app_info_mail')?></managingEditor>
 <webMaster><?php echo sfConfig::get('app_info_mail')?></webMaster>
 <category domain="categoria_canal">universidad</category>
 <docs><?php echo url_for('xml/lastnews' , true) ?></docs>
 <generator>Pumukit V1</generator>
 <ttl>1440</ttl>
 <language>es</language>
 <image>
  <url><?php echo sfConfig::get('app_info_logo')?></url>
  <link><?php echo sfConfig::get('app_info_link')?></link>
  <title><?php echo sfConfig::get('app_info_copyright')?></title>
 </image>


  <?php $order = 0; foreach($mms as $v): $order++?>
    <item>
      <title><?php echo str_replace('&', '&amp;', $v->getTitle())?></title>
      <link><?php echo url_for('video/index?id='.$v->getId() , true) ?></link>
      <description><![CDATA[
         <a href="<?php echo url_for('video/index?id=' . $v->getId(), true)?>"><img style="margin-right: 6px; float: left;" src="<?php echo $v->getFirstUrlPic(true)?>" width="100" height="82" /></a>

        <?php $value = $v->getDescription(); echo str_replace('&', '&amp;', ($value ? $value : $v->getDescription())) ?><br />]]>
      </description>
      <pubDate><?php echo $v->getPublicdate('r') ?></pubDate>
      <author><?php echo sfConfig::get('app_info_mail')?></author>
      <?php foreach($roles as $role):?>
        <?php $actors = $v->getPersons($role->getId()); foreach($actors as $a): ?>
         <media:credit role="<?php echo $role->getXml() ?>"><?php echo $a->getHName()?></media:credit>
      <?php $a->clearAllReferences(true); endforeach?>
      <?php endforeach?>

      <?php $grounds = $v->getGroundsWithI18n(); foreach($grounds as $g): ?>
         <category domain="<?php echo $g->getGroundTypeWithI18n()->getName()?>"><?php echo $g->getName()?></category>
      <?php $g->clearAllReferences(true); endforeach?>
        <!-- Datos característicos de item multimedia -->

      <?php $files = $v->getFilesPublic(); $mats = $v->getMaterialsWithI18n(); ?>
      <?php if(count($files) + count($mats) > 1) echo '<media:group>' ?>
      <?php  foreach($files as $f): ?>
        <?php if($f->getAudio() ): ?>
          <media:content url="<?php echo url_for('video/index?id=' . $v->getId(), true)?>"
            type="audio/wma"
            medium="audio" isDefault="true" expression="full"
            channels="1" duration="<?php echo $f->getDuration()?>"
            lang="<?php echo strtolower( $f->getLanguage()->getCod() ) ?>"  />
        <?php else: ?>
           <media:content url="<?php echo url_for('video/index?id=' . $v->getId(), true)?>"
            type="video/wmv"
            medium="video" isDefault="true" expression="full" framerate="25"
            channels="1" duration="<?php echo $f->getDuration()?>"
            height="<?php echo $f->getPerfil()->getResolutionVer() ?>" width="<?php echo $f->getPerfil()->getResolutionHor() ?>"
            lang="<?php echo strtolower( $f->getLanguage()->getCod() ) ?>"  />
        <?php endif ?>
      <?php $f->clearAllReferences(true); endforeach?>
      <?php foreach($mats as $m): if(!$m->getDisplay()) continue ?>
      <media:content
          url="<?php echo $m->getUrl(true)?>"
          type="application/<?php echo $m->getMatType()->getType()?>"
          medium="document"
          expression="full"
          lang="es" />
      <?php $m->clearAllReferences(true); endforeach?>
      <?php if(count($files) + count($mats) > 1) echo '</media:group>' ?>

    </item>
  <?php $v->clearAllReferences(true);endforeach;?>

</channel>
</rss>
