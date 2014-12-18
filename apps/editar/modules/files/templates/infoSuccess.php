<div id="tv_admin_container">
<form>
<fieldset>
<h2><?php echo "<strong>HTML:</strong>"; ?></h2>
<div class="form-row">
  <?php echo label_for('embed', 'Incrustaci&oacute;n IFRAME:', 'class="required" ') ?>
  <div class="content">
    <textarea id="embed_code" name="embed_code" readonly="readonly" cols="80" rows="5" onclick="this.select()"><iframe src="http://<?php 
        echo sfConfig::get('app_info_link') . '/' . $sf_user->getCulture()
      ?>/video/iframe/<?php
        echo $file->getMmId()
    ?>.html" width="570" frameborder="0">
  Not undestand iframes
</iframe></textarea>
  </div>
</div>

<?php if($file->getPerfil()->getExtension() == 'wmv'):?>
<h2><?php echo "<strong>EMBED:</strong>"; ?></h2>
<div class="form-row">
  <?php echo label_for('embed', 'Resoluci&oacute;n original:', 'class="required" ') ?>
  <div class="content">
		  <textarea id="embed_code" name="embed_code" readonly="readonly" cols="80" rows="5" onclick="this.select()"><object id="MediaPlayer" 
       classid="CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6"
       standby="Loading Microsoft Windows Media Player components..."
       type="application/x-oleobject" width="<?php echo $file->getPerfil()->getResolutionHor()?>" height="<?php echo $file->getPerfil()->getResolutionVer() ?>">
    <param name="url" value="<?php echo $file->getUrl()?>" />
    <param name="AutoStart" value="true" />
    <param name="ShowControls" value="1" />
    <param name="uiMode" value="full" />

    <param value="<?php echo $file->getUrl()?>" name="filename"/>
    <param value="1" name="showcontrols"/>
    <param value="0" name="showdisplay"/>
    <param value="0" name="showstatusbar"/>
    <param value="0" name="autosize"/>
  
    <embed 
           width="<?php echo $file->getPerfil()->getResolutionHor()?>" height="<?php echo $file->getPerfil()->getResolutionVer() ?>"
           autosize="0" 
           showstatusbar="0" 
           showdisplay="0" 
           showcontrols="1" 
           filename="<?php echo $file->getUrl()?>"
           pluginspage="http://www.microsoft.com/windows/downloads/contents/products/mediaplayer/" 
           type="application/x-mplayer2" 
    />
</object></textarea>
	</div>
	<br />
	<?php echo label_for('embed', 'Resoluci&oacute;n 480x320:', 'class="required" ') ?>
	<div class="content">
		  <textarea id="embed_code" name="embed_code" readonly="readonly" cols="80" rows="5" onclick="this.select()"><object id="MediaPlayer" 
       classid="CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6"
       standby="Loading Microsoft Windows Media Player components..."
       type="application/x-oleobject" width="480" height="320">
    <param name="url" value="<?php echo $file->getUrl()?>" />
    <param name="AutoStart" value="true" />
    <param name="ShowControls" value="1" />
    <param name="uiMode" value="full" />

    <param value="<?php echo $file->getUrl()?>" name="filename"/>
    <param value="1" name="showcontrols"/>
    <param value="0" name="showdisplay"/>
    <param value="0" name="showstatusbar"/>
    <param value="0" name="autosize"/>
  
    <embed 
           width="480" height="320"
           autosize="0" 
           showstatusbar="0" 
           showdisplay="0" 
           showcontrols="1" 
           filename="<?php echo $file->getUrl()?>"
           pluginspage="http://www.microsoft.com/windows/downloads/contents/products/mediaplayer/" 
           type="application/x-mplayer2" 
    />
</object></textarea>
	</div>
</div>

<?php endif ?>

<h2><?php echo "<strong>URL:</strong>"; ?></h2>
<div class="form-row">
  <?php echo label_for('embed', 'V&iacute;deo:', 'class="required" ') ?>
  <div class="content">
    <input type="text" onclick="this.select()" size="80" value="<?php echo $file->getUrlLink(true) ?>" />
  </div>
  <br />
  <?php echo label_for('embed', 'Serie:', 'class="required" ') ?>
  <div class="content">
    <input type="text" onclick="this.select()" size="80" value="<?php echo $file->getMm()->getUrl(true) ?>" />   
  </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
  <li><?php echo button_to_function('OK', "Modalbox.hide()", 'class=tv_admin_action_save') ?> </li>
</ul>

</form>
</div>


