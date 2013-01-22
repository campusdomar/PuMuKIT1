<!-- Vista previa -->
<?php if( isset($transcoder) ):?>
<div>
  <p style="text-align:center; font-size: large;">
    <?php echo $transcoder->getId()?>
  </p>

  <div style="overflow:hidden; text-align:center; padding:5px; border:solid 1px #DDD; background:#DDD; " >
    <div style="font-weight: bold; text-align:center;">Informaci&oacute;n general</div>
    <br />
    <div style="text-align:left; color: rgb(0, 0, 0);">
      <span style="font-weight: bold">T&iacute;tulo serie:&nbsp;</span>
      <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getMm()->getSerial()->getTitle(); ?></span>
    </div>
    <div style="text-align:left; color: rgb(0, 0, 0);">
      <span style="font-weight: bold">T&iacute;tulo MM:&nbsp;</span>
      <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getMm()->getTitle(); ?></span>
    </div>
    <div style="text-align:left; color: rgb(0, 0, 0);">
    <span style="font-weight: bold">Path Inicial:&nbsp;</span>
      <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getPathini(); ?></span>
    </div>
    <div style="text-align:left; color: rgb(0, 0, 0);">
      <span style="font-weight: bold">Path Final:&nbsp;</span>
      <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getPathend(); ?></span>
    </div>
    <div style="text-align:left; color: rgb(0, 0, 0);">
      <span style="font-weight: bold">Idioma v&iacute;deo:&nbsp;</span>
      <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getLanguage()->getName(); ?></span>
    </div>
    <br />
    <a href="#" onclick="this.innerHTML=((this.innerHTML=='(m&aacute;s informaci&oacute;n)')?'(menos informaci&oacute;n)':'(m&aacute;s informaci&oacute;n)'); Effect.toggle('more_info','blind'); return false">(m&aacute;s informaci&oacute;n)</a>
    <div id="more_info" style="display:none">
      <br />
      <div style="font-weight: bold; text-align:center;">Informaci&oacute;n Pumukit</div>
      <br />
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">ID serie:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getMm()->getSerialId()?></span>
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">&nbsp;-- &nbsp;ID OM:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getMmId()?></span>
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">&nbsp;--&nbsp;ID Transc:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getId()?></span>
      </div>  
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="font-weight: bold">Email:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getEmail(); ?></span>
      </div>
      <div style="text-align:left; color: rgb(0, 0, 0);">  
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">Comentario:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getDescription()?></span>
      </div>
      <br />
      <div style="font-weight: bold; text-align:center;">Informaci&oacute;n Transcodificador</div>
      <br />
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">Estado:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getStatusId()?></span>
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">&nbsp;-- &nbsp;Perfil:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getPerfil()->getName()?></span>
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">&nbsp;--&nbsp;Prioridad:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getPriority()?></span>
      </div>
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">CPU:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo (($transcoder->getCpu())?$transcoder->getCpu()->getIp():'Sin Cpu')?></span>
      </div>
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">Extensi&oacute;n inicial:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getExtIni()?></span>
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">&nbsp;-- &nbsp;Extensi&oacute;n final:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getExtEnd()?></span>
      </div>
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">PID:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getPid()?></span>
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">&nbsp;-- &nbsp;Duraci&oacute;n:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getDurationString()?></span>
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">&nbsp;--&nbsp;Tama&ntilde;o:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getSize()?></span>
      </div>
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">Fecha subida:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getTimeIni()?></span>
      </div>
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">Inicio Transcodificaci&oacute;n:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getTimeStart()?></span>
      </div>
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">Fin Transcodificaci&oacute;n:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getTimeEnd()?></span>
      </div>
      <div style="text-align:left; color: rgb(0, 0, 0);">
        <span style="text-align: left; color: rgb(0, 0, 0); font-weight: bold;">Nombre del fichero subido:&nbsp;</span>
        <span style="color: rgb(0, 0, 0);"><?php echo $transcoder->getName()?></span>
      </div>
    </div>
  </div>
</div>
  <?php else:?>
<p>
  Seleccione alg&uacute;n proceso.
</p>
<?php endif?>


