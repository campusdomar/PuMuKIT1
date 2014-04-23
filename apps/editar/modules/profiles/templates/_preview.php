<!-- Vista previa -->
<?php if( isset($profile) ):?>
<div>
   <p style="text-align:center; font-size: large;">
    <?php echo $profile->getName()?>
  </p>

  <p style="overflow:hidden; padding:5px; text-align:left; border:solid 1px #DDD; background:#DDD; " >
   <span style="font-weight: bold"><?php echo __('Servidor:')?></span> 
   <?php echo $profile->getStreamserver()->getName()?>
   <br />
   <span style="font-weight: bold"><?php echo __('Reproducible:')?></span> 
    <?php echo $profile->getDisplay() ? "Sí" : "No" ?>
   <br />
   <span style="font-weight: bold"><?php echo __('Por defecto:')?></span> 
    <?php echo $profile->getWizard() ? "Sí" : "No" ?>
   <br />
    <span style="font-weight: bold"><?php echo __('Formato:')?></span> 
    <?php echo $profile->getFormat()?>
   <br />
   <span style="font-weight: bold">Codec:</span> 
    <?php echo $profile->getCodec()?>
   <br />
   <span style="font-weight: bold">Mime-Type:</span> 
    <?php echo $profile->getMimeType()?>
   <br />
   <span style="font-weight: bold"><?php echo __('Extensión:')?></span> 
    <?php echo $profile->getExtension()?>
   <br />
   <span style="font-weight: bold"><?php echo __('Resolución:')?></span> 
    <?php echo $profile->getResolutionHor()?>x<?php echo $profile->getResolutionVer()?>
   <br />
   <span style="font-weight: bold">BitRate:</span> 
    <?php echo $profile->getBitrate()?>
   <br />
   <span style="font-weight: bold">FrameRate:</span> 
    <?php echo $profile->getFramerate()?>
   <br />
   <span style="font-weight: bold">Channels:</span> 
    <?php echo $profile->getChannels() ?>
   <br />
   <span style="font-weight: bold"><?php echo __('Solo audio:')?></span> 
    <?php echo $profile->getAudio() ? "Sí" : "No" ?>
   <br />
   <span style="font-weight: bold"><?php echo __('Tiene script:')?></span> 
    <?php echo strlen($profile->getPrescript()) ? "Sí" : "No" ?>
   <br />
   <span style="font-weight: bold"><?php echo __('Descripción:')?></span> 
    <?php echo $profile->getDescription()?>
   <br />
   <?php if(sfConfig::get('app_transcoder_use')):?>
   <span style="font-weight: bold">Bat:</span> 
    <?php echo $profile->getBat()?>
   <br />
   <span style="font-weight: bold"><?php echo __('Fichero configuración:')?></span> 
   <?php echo $profile->getFileCfg()?>
   <br />
   <span style="font-weight: bold"><?php echo __('Aplicación:')?></span> 
   <?php echo $profile->getApp()?>
   <br />
   <?php endif?>
   
  </p>
</div>

  <?php else:?>
<p>
						 <?php echo __('Selecione o cree algun perfil.')?>
</p>
<?php endif?>


