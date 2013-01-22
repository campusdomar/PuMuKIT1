#!/usr/bin/env php
<?php

/**
 * pr batch script
 *
 * Here goes a brief description of the purpose of the batch script
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

//START
fwrite(STDERR, "Start:\n");


//CONTROLER
$c = new Criteria();
SerialPeer::addPublicCriteria($c);
SerialPeer::addBroadcastCriteria($c);

$serials = SerialPeer::doSelectWithI18n($c, 'es');

$cr = new Criteria();
$cr->add(RolePeer::DISPLAY, true);
$roles = RolePeer::doSelectWithI18n($cr, 'es');
?>

//VIEW

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
 <docs><?php echo 'xml/arca' ?></docs>
 <generator>Pumukit V1</generator>
 <ttl>1440</ttl>
 <language>es</language>
 <image>
  <url><?php echo sfConfig::get('app_info_logo')?></url>
  <link><?php echo sfConfig::get('app_info_link')?></link>
  <title><?php echo sfConfig::get('app_info_copyright')?></title>
 </image>
	
<?php foreach($serials as $s): $mms = $s->getMmsPublic();?>
  <?php $order = 0; foreach($mms as $v): $order++?>

    <item>

      <?php if(count($mms)!=1):?>
        <arca:course>
        <arca:title><?php echo str_replace('&', '&amp;', $s->getTitle())?></arca:title>
        <arca:description><?php echo str_replace('&', '&amp;', $s->getDescription()) ?></arca:description>
        <arca:image><?php echo $s->getFirstUrlPic(true) ?></arca:image>
        <arca:order><?php echo $order ?></arca:order>
        </arca:course>
      <?php endif?>

      <title><?php echo str_replace('&', '&amp;', $v->getTitle())?></title>

      <link><?php echo 'serial/index?id='.$s->getId()  ?></link>
      <description>
        <?php $value = $v->getDescription(); echo str_replace('&', '&amp;', $value ? $value : $s->getDescription()) ?>
      </description>
      <pubDate><?php echo $v->getPublicdate('r') ?></pubDate>
      <g:publish_date><?php echo $v->getPublicdate() ?></g:publish_date>
      <author><?php echo sfConfig::get('app_info_mail')?></author>

      <source url="<?php echo 'xml/arca'?>">Universidad de Vigo Television</source> 
      <media:thumbnail url="<?php echo $v->getFirstUrlPic(true) ?>" height="82" width="100" />
      <media:copyright>Universidad de Vigo</media:copyright>
      <guid isPermaLink="true"><?php echo 'serial/index?id='.$s->getId().'#'.$v->getId() ?></guid>

      <?php foreach($roles as $role):?>
        <?php $actors = $v->getPersons($role->getId()); foreach($actors as $a): ?>
          <media:credit role="<?php $role->getXml() ?>"><?php echo $a->getName()?></media:credit>
        <?php $a->clearAllReferences(true); endforeach?>
      <?php endforeach?>

      <?php $grounds = $v->getGroundsWithI18n(); foreach($grounds as $g): ?>
        <category domain="<?php echo $g->getGroundTypeWithI18n()->getName()?>"><?php echo $g->getName()?></category>
      <?php $g->clearAllReferences(true); endforeach?>

      <media:group>
      <?php $files = $v->getFiles(); foreach($files as $f): ?>
        <?php if($f->getAudio() ): ?>
          <media:content url="<?php echo 'video/index?id=' . $f->getId()?>"
            type="audio/wma" 
            medium="audio" isDefault="true" expression="full" 
            channels="1" duration="<?php echo $f->getDuration()?>" 
            lang="<?php echo strtolower( $f->getLanguage()->getCod() ) ?>"  />
        <?php else: ?>
          <media:content url="<?php echo 'video/index?id=' . $f->getId()?>"
            type="video/wmv" 
            medium="video" isDefault="true" expression="full" framerate="25" 
            channels="1" duration="<?php echo $f->getDuration()?>" 
            height="<?php echo $f->getResolution()->getVer() ?>" width="<?php echo $f->getResolution()->getHor() ?>"
            lang="<?php echo strtolower( $f->getLanguage()->getCod() ) ?>"  />
        <?php endif ?>
      <?php $f->clearAllReferences(true); endforeach?>
      <?php $mat = $v->getMaterialsWithI18n(); foreach($mat as $m): ?>
        <media:content
          url="<?php echo $m->getUrl(true)?>"
          type="application/<?php echo $m->getMatType()->getType()?>"
          medium="document"
          expression="full"
          lang="es" />
      <?php $m->clearAllReferences(true); endforeach?>
      </media:group>


    </item>
    <?php $v->clearAllReferences(true); endforeach;?>
  <?php fwrite(STDERR, "   - " . $s->getId(). " Mem usada:" . memory_get_usage(true) . "MB  \r"); ?>
<?php $s->clearAllReferences(true); endforeach;?>

</channel>
</rss>


<?php fwrite(STDERR, "\n\n\n"); ?>
