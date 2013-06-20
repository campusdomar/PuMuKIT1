<?php use_helper('Object', 'JSRegExp') ?>

<div id="tv_admin_container" style="padding: 4px 20px 20px">

<?php echo form_remote_tag(array( 
  'update' => 'list_mms', 
  'url' => 'virtualserial/update_pub',
  'script' => 'true',
  'failure' => visual_effect('opacity', 'mm_save_error_pub', array('duration' => '3.0', 'from' => '1.0', 'to' => '0.0')),
  'success' => visual_effect('opacity', 'mm_save_ok_pub', array('duration' => '3.0', 'from' => '1.0', 'to' => '0.0'))
)) ?>


<?php echo object_input_hidden_tag($mm, 'getId') ?>
<?php echo object_input_hidden_tag($mm, 'getSerialId') ?>

<div id="remember_save_mm_pub" style="display: none; position: absolute; color:red; border: 1px solid red; padding: 5px; background-color:#fdc; font-weight:bold;">
  <?php echo __('Pulse OK para que el cambio de publicacion tenga efecto')?>
</div>

<ul class="tv_admin_actions" style="width: 100%">
  <span id="mm_save_error_pub" style="color:red; opacity:0.0; filter: alpha(opacity=0); ZOOM:1">Guardado ERROR</span>
  <span id="mm_save_ok_pub" style="color:blue; opacity:0.0; filter: alpha(opacity=0); ZOOM:1">Guardado OK</span>
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save  onclick=return procesaOk();'); ?></li>
  <li><?php echo reset_tag('Cancel','name=reset class=tv_admin_action_delete onclick=procesaReset();'); ?></li>
</ul> 


<fieldset id="tv_fieldset_none" class="" style="background-color: rgba(255, 255, 255, 0.4);">


<div class="form-row">
  <?php echo label_for('status', 'Estado:', 'class="required long" ') ?>
  <div class="content content_long">
    <div style="float:right"> </div>


<!-- SELECT -->
<select style="margin:0px 0px 15px" name="status" id="filters_anounce" onchange="$('remember_save_mm_pub').show()" <?php echo ($sf_user->getAttribute('user_type_id', 1) == 0)?'':'disabled="disabled"' ?> >
  <option <?php echo (($mm->getStatusId() == MmPeer::STATUS_NORMAL)?'selected="selected"':''); ?>value="0" >Publicado</option>
  <option <?php echo (($mm->getStatusId() == MmPeer::STATUS_BLOQ)?'selected="selected"':''); ?>value="1" >Bloqueado</option>
  <option <?php echo (($mm->getStatusId() == MmPeer::STATUS_HIDE)?'selected="selected"':''); ?>value="2" >Oculto</option>
</select>
<!-- END SELECT -->

  </div>

  <div class="content content_long" style="margin-top:3px;">
    <?php $value = object_checkbox_tag($mm, 'getEditorial3', array (
      'control_name' => 'editorial3',
      'onchange' => "$('remember_save_mm_pub').show()")); 
      echo $value ? $value : '&nbsp;' ?>&nbsp; Revisado
  </div>

  <div id="pub_mm_info" style="width: 99%; padding:5px;"></div>
</div>
<!-- else avisar para publicar-->


<!-- Si no tiene master podia no poder cambiar pub_channels -->
<div class="form-row" id="list_pub_channel" <?php echo ($mm->getStatusId() == 1)?'style="background-color: #f2f2f2"':'"';?>>
  <?php echo label_for('pub', 'Canales de Publicacion:', 'class="required long" ') ?>
  <div id="list_pub_<?php echo $mm->getId()?>" class="content content_long">
    <?php include_partial('list_pub', array('mm' => $mm)) ?>
  </div>
</div>

<script  type="text/javascript">
sombreaCalendarios = function(id){
  $('calendarios'+id).style.opacity="0.5";
  $('error_start' + id).hide();
  $('error_end' + id).hide();
  $('intervalo' + id).innerHTML = "";
  $('intervalo' + id).hide();
}
sombreaRadiosYCalendarios = function(id){
  $('radios'+id).style.opacity="0.5";
  sombreaCalendarios(id);
}
descubreRadiosMarcaEditorial = function(id){
  $('radios'+id).style.opacity="1";
  $('editorial'+id).checked=true;
}
procesaEditorial = function(id){
  if ($('editorial'+id).checked){
    $('radios'+id).style.opacity="1";
    if ($('temporizada' + id + '_temporizada').checked==true){
      procesaTemporizada(id);
    } 
  } else {
<?php //En chrome no actualiza hasta que no se pincha en otro checkbox de editorial ¿? ?>
    sombreaRadiosYCalendarios(id);
  }
  $('remember_save_mm_pub').show();
}
procesaPermanente = function(id){
  descubreRadiosMarcaEditorial(id);
  sombreaCalendarios(id);
}
procesaTemporizada = function(id){
  descubreRadiosMarcaEditorial(id);
  $('calendarios'+id).style.opacity="1";
  muestraPasadoActivoFuturo(id);
}

procesaTimestart = function(id){
  $('temporizada' + id + '_temporizada').checked = true;
  procesaTemporizada(id);
  $('error_start' + id).hide();
  $('remember_save_mm_pub').show(); 
}
procesaTimeend = function(id){
  $('temporizada' + id + '_temporizada').checked = true;
  procesaTemporizada(id);
  $('error_end' + id).hide();
  $('remember_save_mm_pub').show(); 
}
procesaOk = function(){
  if(comprobar_form_pub( $("temporizada1_temporizada").checked, $("timestart1").value, $("timeend1").value,
                         $("temporizada2_temporizada").checked, $("timestart2").value, $("timeend2").value,
                         <?php echo get_js_regexp_timedate($sf_user->getCulture())?> ) && ( $('pass1').value == $('pass2').value) ) {
    borraFechasSiInactivas();
    $('remember_save_mm_pub').hide();
    return true;
  } else {
    return false;
  }
}
procesaReset = function(){
  $('remember_save_mm_pub').hide();
  $('error_start1').hide();
  $('error_end1').hide();
  $('error_start2').hide();
  $('error_end2').hide();
  if ( <?php echo $mm->getBroadcastId()?> != 1 ) { 
     $('broadcast_password').show(); 
  } else { 
    $('broadcast_password').hide(); 
  }
}
borraFechasSiInactivas = function() {
  if (!$('temporizada1_temporizada').checked){
    $('timestart1').value="";
    $('timeend1').value="";
  }
  if (!$('temporizada2_temporizada').checked){
    $('timestart2').value="";
    $('timeend2').value="";
  }
}
dmy2ymd = function(date){
  var fecha = date.strip(); // prototype trim
  var separa = fecha.split(" ");
  var parts = separa[0].split("/");
  var ymd = parts[2] + '/' + parts[1] + '/'+parts[0];
  if (separa.length > 1){
    ymd += ' ' + separa[1];
  }
  
  return ymd;
}
compruebaIntervaloEditorial = function(id){
  var dstart = new Date(Date.parse(dmy2ymd($('timestart'+id).value)));
  var dend   = new Date(Date.parse(dmy2ymd($('timeend'+id).value)));
  var today  = new Date();
  var value  = false;
  var error  = '';
  if ($('timestart'+id).value === '' || $('timeend'+id).value === ''){
    error = 'Fechas incompletas';
  } else if (dstart > dend){
    error = 'Error: Inicio > Final';
  } else if (dend < today){
    value = -1;
  } else if (dstart > today){
    value = +1;
  } else if (dstart < today && today < dend){
    value = 0;
  }

  return [value, error];
}

mensajeIntervalo = function(array_value_error, id){
  value = parseInt(array_value_error[0],10);
  var span_id = 'intervalo' + id;
  $(span_id).innerHTML = "";
  if (isNaN(value)){
    mensaje = array_value_error[1];    
    $(span_id).style.color = "red";
  } else if (value == -1){
    mensaje = 'Evento pasado';
    $(span_id).style.color = "grey";
  } else if (value == +1){
    mensaje = 'Evento futuro';
    $(span_id).style.color = "grey";
  } else if (value == 0){
    mensaje = 'Evento activo';
    $(span_id).style.color = "green";
  } else {
    mensaje = '';
  }
  $(span_id).appendChild(document.createTextNode(mensaje));
  $(span_id).style.margin = "0px 10px";
  $(span_id).show();
  return;
}
muestraPasadoActivoFuturo = function(id){
  mensajeIntervalo(compruebaIntervaloEditorial(id),id);
  return;
}
</script>

<div class="form-row">
  <?php echo label_for('announce_label', 'Decisiones Editoriales:', 'class="required long" ') ?>
  <div class="content content_long" style="height:18px">
    <?php $value = object_checkbox_tag($mm, 'getAnnounce', array (
      'control_name' => 'announce',
      'onchange' => "$('remember_save_mm_pub').show()",
    )); echo $value ? $value : '&nbsp;' ?>&nbsp; Novedad
  </div>

<?php // Fila para decision editorial 1 - Destacados TV?>
  <div class="content content_long" style="overflow:hidden;" >
    <span class="editorial_fija" style="float:left; margin: 3px 0 0 0; width:115px;">
      <?php echo checkbox_tag('editorial1', 1, ($mm->getEditorial1() || isset($timeframe1)), array (
        'onchange' => "procesaEditorial(1);",
        'style' => 'float:left'
      ) );?>&nbsp; Destacados TV    
    </span>  
    <span class="temporizada" id="temporizada1" style="float:left;" >
      <span id="radios1" style="margin-top:6px;<?php if (!$mm->getEditorial1() && !isset($timeframe1)) echo "opacity:0.5;" //ojo, necesito algún caracter dentro de este span?>">&nbsp;
        <?php echo radiobutton_tag('temporizada1', 'permanente', (!isset($timeframe1)), 
          array('style'=> 'margin:3px;float:left;', 
                'onchange' => 'procesaPermanente(1)'));?> 
            <label for ="temporizada1_permanente" style="position:relative;padding:3px;margin-right:3px;color:black;width:auto;"> Permanente</label> 
        <?php echo radiobutton_tag('temporizada1', 'temporizada',    (isset($timeframe1)), 
          array('style'=> 'margin:3px;float:left;', 
                'onchange' => 'procesaTemporizada(1)')); ?> 
            <label for ="temporizada1_temporizada" style="position:relative;padding:3px 0 3px 3px;color:black;width:auto;"> Temporizado</label>
      </span>
      <span id="calendarios1" style="<?php if (!isset($timeframe1)) echo "opacity:0.5;"?>">
        <span>del: </span>
        <?php // ---- INICIALIZACIÓN VARIABLES DECISION EDITORIAL 1 ----
          if (!isset($timeframe1)) { // variable a retornar por el formulario
            // timeframe inicializado para poder pintar el textbox y calendario
            $timeframe1 = new CategoryMmTimeframe();
          }?>
        <?php $value = object_input_date_tag($timeframe1, 'getTimestart', array (
          'rich' => true,
          'withtime' => true,
          'calendar_button_img' => '/images/admin/buttons/date.png',
          'control_name' => 'timestart1',
          'onchange' => "procesaTimestart(1);",
          'size' => 14 //por defecto es 17
            )); echo $value ? $value : '&nbsp;' ?>
     
        <span id="error_start1" style="display:none" class="error">Formato de fecha no v&aacute;lido</span> 
    
        <?php //echo label_for('timeend1', 'al:', 'class="required long" ') ?>
        <span style="margin-left:5px;" >al: </span>
        
          <?php $value = object_input_date_tag($timeframe1, 'getTimeend', array (
            'rich' => true,
            'withtime' => true,
            'calendar_button_img' => '/images/admin/buttons/date.png',
            'control_name' => 'timeend1',
            'onchange' => "procesaTimeend(1);",
            'size' => 14 //por defecto es 17
              )); echo $value ? $value : '&nbsp;' ?>        
        <span id="intervalo1" style="display:none"></span>
        <?php if (isset($interval1cmp) && $interval1cmp !== ''):?>
        <script type="text/javascript">mensajeIntervalo ([<?php echo $interval1cmp;?>,''], 1) </script>
        <?php endif?>
        <span id="error_end1" style="display:none" class="error">Formato de fecha no v&aacute;lido</span>
      </span>
      
      
    </span> <!-- fin temporizada -->
  </div>


<?php // Fila para decision editorial 2 - Destacados Radio?>
  <div class="content content_long" style="overflow:hidden;" >
    <span class="editorial_fija" style="float:left; margin: 3px 0px 0px 0px; width:115px;">
      <?php $value = object_checkbox_tag($mm, 'getEditorial2', array (
        'control_name' => 'editorial2',
        'onchange' => "procesaEditorial(2);",
      )); echo $value ? $value : '&nbsp;' ?>&nbsp; Destacados Radio    
      

    </span>  

    <span class="temporizada" id="temporizada2" style="float:left;" >
      <span id="radios2" style="<?php if (!$mm->getEditorial2() && !isset($timeframe2)) echo "opacity:0.5;" //ojo, necesito algún caracter dentro de este span?>">&nbsp;
        <?php echo radiobutton_tag('temporizada2', 'permanente', (!isset($timeframe2)), array('style' => 'margin:3px;float:left;', 'onchange' => 'procesaPermanente(2)'));?><label for ="temporizada2_permanente" style="position:relative;padding:3px;margin-right:3px;color:black;width:auto;"> Permanente</label> 
        <?php echo radiobutton_tag('temporizada2', 'temporizada',    (isset($timeframe2)), array('style' => 'margin:3px;float:left;', 'onchange' => 'procesaTemporizada(2)')); ?><label for ="temporizada2_temporizada" style="position:relative;padding:3px 0 3px 3px;color:black;width:auto;"> Temporizado</label>
      </span>
      <span id="calendarios2" style="<?php if (!isset($timeframe2)) echo "opacity:0.5;"?>">
        <span>del: </span>
        <?php // ---- INICIALIZACIÓN VARIABLES DECISION EDITORIAL 2 ----
          if (!isset($timeframe2)) { // variable a retornar por el formulario
              // timeframe inicializado para poder pintar el textbox y calendario
              $timeframe2 = new CategoryMmTimeframe();
          }?>
        <?php $value = object_input_date_tag($timeframe2, 'getTimestart', array (
          'rich' => true,
          'withtime' => true,
          'calendar_button_img' => '/images/admin/buttons/date.png',
          'control_name' => 'timestart2',
          'onchange' => "procesaTimestart(2)",
          'size' => 14 //por defecto es 17
            )); echo $value ? $value : '&nbsp;' ?>
     
        <span id="error_start2" style="display:none" class="error">Formato de fecha no v&aacute;lido</span> 
        <span style="margin-left:5px;" >al: </span>       
          <?php $value = object_input_date_tag($timeframe2, 'getTimeend', array (
            'rich' => true,
            'withtime' => true,
            'calendar_button_img' => '/images/admin/buttons/date.png',
            'control_name' => 'timeend2',
            'onchange' => "procesaTimeend(2);",
            'size' => 14 //por defecto es 17
              )); echo $value ? $value : '&nbsp;' ?> 
        <span id="intervalo2" style="display:none"></span>
        <?php if (isset($interval2cmp) && $interval2cmp !== ''):?>
        <script type="text/javascript">mensajeIntervalo([<?php echo $interval2cmp;?>,''], 2) </script>
        <?php endif?>
        <span id="error_end2" style="display:none" class="error">Formato de fecha no v&aacute;lido</span> 
      </span>
    </span> <!-- fin temporizada -->
  </div>

</div>


<div class="form-row">
  <?php echo label_for('broadcast_id', 'Perfil de acceso:', 'class="required long"') ?>
  <div class="content content_long">
     <select name="broadcast_id" id="broadcast_id" onchange="$('remember_save_mm_pub').show(); change_pass(this);">
        <option <?php echo (($mm->getBroadcastId() == 1)?'selected="selected"':''); ?>value="1" >pub</option>
        <option <?php echo (($mm->getBroadcastId() != 1)?'selected="selected"':''); ?>value="2" >pri</option><!-- Mostramos pri pero se guarda como cor -->
     </select>  
     <span id="broadcast_password" style="<?php echo (($mm->getBroadcastId() != 1)?'display:inline;':'display:none;'); ?>">
       <?php $broadcast = BroadcastPeer::retrieveByPk($mm->getBroadcastId());?>
       <input onchange="check_pass($('pass1'), $('pass2'), $('broadcast_id').value); $('remember_save_mm_pub').show()" type="password" placeholder="Introduce una contraseña..." size="25" maxlength="256" style="margin: 5px;" name="pass1" id="pass1" value="<?php echo (($broadcast != NULL)?$broadcast->getPasswd():'');?>" />
       <input onchange="check_pass($('pass1'), $('pass2'), $('broadcast_id').value); $('remember_save_mm_pub').show()" value="<?php echo (($broadcast != NULL)?$broadcast->getPasswd():'');?>" type="password"  placeholder="Repite la contraseña..." size="25" maxlength="256" name="pass2" id="pass2" />
       <input type="button" style="background-color: #ffc; border-right: 1px solid #ddd !important; padding-left: 20px;" class="tv_admin_action_save" id="view_passwd" onclick="toggleName(this); replaceType(pass1); replaceType(pass2); return false;" value="Ver contraseña" />
       <input type="button" style="background-color: #ffc; border-right: 1px solid #ddd !important; padding-left: 20px;" class="tv_admin_action_save" id="gen_passwd" onclick="genpasswd($('pass1'),$('pass2')); return false;" title="Genera una contraseña aletaoria" value="Generar contraseña" />
       <span id="passwdFail" style="display: none; color: red; margin: 0px 10px;">Las contraseñas deben ser iguales.</span>
     </span>
  </div>
</div>



<!--
<div class="form-row">
  <?php echo label_for('itunesu', 'iTunes U:', 'class="required long" ') ?> 
  <div class="content content_long">
    <?php if(count($mm->getSerial()->getSerialItuness()) == 0):?>
      <a href="#" onclick="
  new Ajax.Updater('itunes_mm_info', '<?php echo url_for('virtualserial/ituneson?id=' . $mm->getId())?>', {asynchronous:true, evalScripts:true}); return false;
">Publicar en itunes U.</a>
    <?php else:?>
      <a href="#" onclick="
  new Ajax.Updater('itunes_mm_info', '<?php echo url_for('virtualserial/ituneson?id=' . $mm->getId())?>', {asynchronous:true, evalScripts:true}); return false;
">Quitar de itunes U.</a>
    <?php endif?>

  </div>
  <div id="itunes_mm_info" style="width: 99%; padding:10px;">
    <?php include_partial('virtualserial/itunes_list', array('itunes' => $mm->getSerial()->getSerialItuness()))?>
  </div>
</div>
-->


</fieldset>

</form>
</div>
