<?php use_helper('Object', 'JSRegExp') ?>

<div style="float:left; border: 1px solid rgb(206, 194, 194); padding: 5px; margin: 1% 2% 1% 0%; position: relative;">
  <table>
     <tr>
       <td style="padding: 1px;">
         <input type="hidden" id="show_advanced" name="searchs[selected]" value="<?php echo $sf_user->getAttribute('selected', 0, 'tv_admin/virtualserial/searchs');?>" />
         <label style="position: inherit; margin: 12px 0px 3px;" for="title" class="required long">Título:</label>	
         <div style="overflow: hidden; margin: 5px;">
              <input placeholder="Introduce un título..." type="text" name="searchs[title]" id="title" size="60" value="<?php echo $sf_user->getAttribute('title', null, 'tv_admin/virtualserial/searchs');?>">
         </div>
         <label style="position: inherit; margin: 7px 0px 3px;" for="subtitle" class="required long"><?php echo __('Subtítulo:')?></label>	
         <div style="overflow: hidden; margin: 5px;">
              <input placeholder=<?php echo __('Introduce un subtítulo...')?> type="text" name="searchs[subtitle]" id="subtitle" size="60" value="<?php echo $sf_user->getAttribute('subtitle', null, 'tv_admin/virtualserial/searchs');?>">
         </div>
         <label style="position: inherit; margin: 7px 0px 3px;" for="keyword" class="required long">Keyword:</label>	
         <div style="overflow: hidden; margin: 5px;">
              <input placeholder=<?php echo __('Introduce una palabra clave...')?> type="text" name="searchs[keyword]" id="keyword" size="60" value="<?php echo $sf_user->getAttribute('keyword', null, 'tv_admin/virtualserial/searchs');?>">
         </div>
         <label style="position: inherit; margin: 7px 0px 3px;" for="publicdateAdvanced" class="required long"><?php echo __('Fecha de publicación')?>:</label>	
         <div style="overflow: hidden; margin: 5px;">
              <input placeholder=<?php echo __('Introduce fecha inicial de búsqueda...')?> type="text" onchange="compruebaIntervaloFecha('PublicDate');" name="searchs[publicdateAdvancedStart]" id="timestartPublicDate" size="25" value="<?php echo $sf_user->getAttribute('publicdateAdvancedStart', null, 'tv_admin/virtualserial/searchs');?>">
              <img id="trigger_publicdateAdvancedStart" style="cursor: pointer; vertical-align: middle" src="/images/admin/buttons/date.png" alt="DateAdvancedStart">
              <input placeholder=<?php echo __('Introduce fecha final de búsqueda...')?> type="text" onchange="compruebaIntervaloFecha('PublicDate');" name="searchs[publicdateAdvancedFinish]" id="timeendPublicDate" size="25" value="<?php echo $sf_user->getAttribute('publicdateAdvancedFinish', null, 'tv_admin/virtualserial/searchs');?>">
              <img id="trigger_publicdateAdvancedFinish" style="cursor: pointer; vertical-align: middle" src="/images/admin/buttons/date.png" alt="DateAdvancedFinish">
              <span id="error_PublicDate" style="display:none" class="error"></span> 
         </div>
       
         <label style="position: inherit; margin: 7px 0px 3px;" for="recorddateAdvanced" class="required long">Fecha de grabación:</label>	
         <div style="overflow: hidden; margin: 5px;">
              <input placeholder="Introduce fecha inicial de búsqueda..." type="text" onchange="compruebaIntervaloFecha('RecordDate');" name="searchs[recorddateAdvancedStart]" id="timestartRecordDate" size="25" value="<?php echo $sf_user->getAttribute('recorddateAdvancedStart', null, 'tv_admin/virtualserial/searchs');?>">
              <img id="trigger_recorddateAdvancedStart" style="cursor: pointer; vertical-align: middle" src="/images/admin/buttons/date.png" alt="DateAdvancedStart">
              <input placeholder="Introduce fecha final de búsqueda..." type="text" onchange="compruebaIntervaloFecha('RecordDate');" name="searchs[recorddateAdvancedFinish]" id="timeendRecordDate" size="25" value="<?php echo $sf_user->getAttribute('recorddateAdvancedFinish', null, 'tv_admin/virtualserial/searchs');?>">
              <img id="trigger_recorddateAdvancedFinish" style="cursor: pointer; vertical-align: middle" src="/images/admin/buttons/date.png" alt="DateAdvancedFinish">
              <span id="error_RecordDate" style="display:none" class="error"></span> 
         </div>
       
         <?php echo label_for('description_advanced', 'Descripci&oacute;n:', array( 'style' => 'position:inherit; margin: 7px 0px 3px;', 'class' => 'required long')) ?>
         <div class="content content_long" style="overflow: hidden; margin: 5px;">
             <textarea name="searchs[description_advanced]" id="searchs_description_advanced" style="max-width: 365px;" rows="2" cols="50"><?php echo $sf_user->getAttribute('description_advanced', null, 'tv_admin/virtualserial/searchs')?></textarea>
         </div>
         <label style="position: inherit; margin: 7px 0px 3px;" for="titular" class="required long">Titular:</label>	
         <div style="overflow: hidden; margin: 5px;">
              <input placeholder="Introduce un titular..." type="text" name="searchs[titular]" id="titular" size="60" value="<?php echo $sf_user->getAttribute('titular', null, 'tv_admin/virtualserial/searchs');?>">
         </div>
         <?php echo label_for('news', 'Novedad:', array( 'style' => 'position:inherit; margin: 7px 0px 3px;', 'class' => 'required long')) ?>
         <div style="overflow: hidden; margin: 12px;">
           <input type="checkbox" name="searchs[news]" id="news" <?php echo $sf_user->getAttribute('news', null, 'tv_admin/virtualserial/searchs')=='on'?'checked="true"':'';?>>
         </div>
         <?php echo label_for('editorial1', 'Decisión editorial 1:', array( 'style' => 'position:inherit; margin: 7px 0px 3px;', 'class' => 'required long')) ?>
         <div style="overflow: hidden; margin: 18px;">
           <input type="checkbox" name="searchs[editorial1]" id="editorial1" <?php echo $sf_user->getAttribute('editorial1', null, 'tv_admin/virtualserial/searchs')=='on'?'checked="true"':'';?>>
         </div>
         <?php echo label_for('editorial2', 'Decisión editorial 2:', array( 'style' => 'position:inherit; margin: 7px 0px 3px;', 'class' => 'required long')) ?>
         <div style="overflow: hidden; margin: 24px;">
           <input type="checkbox" name="searchs[editorial2]" id="editorial2" <?php echo $sf_user->getAttribute('editorial2', null, 'tv_admin/virtualserial/searchs')=='on'?'checked="true"':'';?>>
         </div>
         <?php //echo label_for('download', 'Descarga:', array( 'style' => 'position:inherit; margin: 7px 0px 3px;', 'class' => 'required long')) ?>
         <!--<div class="content content_long">
           <div style="float:right"> </div>-->
           <!-- SELECT -->
           <!--<select style="margin:0px 0px 15px" name="searchs[download]" id="download">
             <option value="" >Todos</option>
             <option <?php echo $sf_user->getAttribute('download', null, 'tv_admin/virtualserial/searchs') == 1?'selected="selected"':''?>value="1" ><?php __('No permitida descarga')?></option>
             <option <?php echo $sf_user->getAttribute('download', null, 'tv_admin/virtualserial/searchs') == 2?'selected="selected"':''?>value="2" ><?php echo __('Permitida Descarga')?></option>
           </select>
         </div>-->
       </td>


       <td style="padding: 1px;">
         <?php $persons = $sf_user->getAttribute('person', array(), 'tv_admin/virtualserial/searchs'); foreach ($roles as $role):?>
           <label style="position: inherit; <?php echo ($role->getRank()==1)?'margin: 12px 0px 3px;':'margin: 7px 0px 3px;'?>" for="<?php echo $role->getName()?>" class="required long"><?php echo $role->getName()?>:</label>	
           <div style="overflow: hidden; margin: 5px;">
                <input placeholder="Introduce <?php echo ($role->getName() == 'Postproducion')?$role->getName():'un ' . $role->getName()?>..." type="text" name="searchs[person][<?php echo $role->getId()?>]" id="actor" size="55" value="<?php echo ( isset($persons[$role->getId()]) && strlen($persons[$role->getId()]) != 0)?$persons[$role->getId()]:'' ?>">
           </div>
         <?php endforeach;?>
         <?php echo label_for('broadcast_advanced', 'Perfil de acceso:', array( 'style' => 'position:inherit; margin: 7px 0px 3px;', 'class' => 'required long')) ?>
         <div class="content content_long">
           <div style="float:right"> </div>
           <!-- SELECT -->
           <select style="margin:0px 0px 15px" name="searchs[broadcast_advanced]" id="broadcast_advanced">
             <option <?php echo $sf_user->getAttribute('broadcast_advanced', null, 'tv_admin/virtualserial/searchs') == -1?'selected="selected"':''?>value="-1">Todos</option>
             <option <?php echo $sf_user->getAttribute('broadcast_advanced', null, 'tv_admin/virtualserial/searchs') == 1?'selected="selected"':''?>value="1">pub</option>
             <option <?php echo $sf_user->getAttribute('broadcast_advanced', null, 'tv_admin/virtualserial/searchs') == 2?'selected="selected"':''?>value="2" >pri</option>
           </select>
         </div>
         <?php echo label_for('status', 'Estado:', array( 'style' => 'position:inherit; margin: 7px 0px 3px;', 'class' => 'required long')) ?>
         <div class="content content_long">
           <div style="float:left"> </div>
           <!-- SELECT -->
           <select style="margin:0px 0px 15px;" name="searchs[status]" id="status">
             <option <?php echo $sf_user->getAttribute('status', null, 'tv_admin/virtualserial/searchs') == '-1'?'selected="selected"':''?>value="-1" ><?php echo __('Todos')?></option>
             <option <?php echo $sf_user->getAttribute('status', null, 'tv_admin/virtualserial/searchs') == 0?'selected="selected"':''?>value="0" ><?php echo __('Publicado')?></option>
             <option <?php echo $sf_user->getAttribute('status', null, 'tv_admin/virtualserial/searchs') == 1?'selected="selected"':''?>value="1" ><?php echo __('Bloqueado')?></option>
             <option <?php echo $sf_user->getAttribute('status', null, 'tv_admin/virtualserial/searchs') == 2?'selected="selected"':''?>value="2" ><?php echo __('Oculto')?></option>
           </select>
         </div>
       </td>
       <input type="submit" name="search" value="Buscar" id="enviar" class="btn" style="background: #ddd url(/images/1.8/lupa_buscador.png) no-repeat 0% 50%; cursor:pointer; padding: 4px 4px 4px 20px; width: 60px; position:absolute; right: 20px; bottom: 10px;" />
     </tr>
  </table>
<script type="text/javascript">
    document.getElementById("trigger_publicdateAdvancedStart").disabled = false;
    Calendar.setup({
      inputField : "timestartPublicDate",
      ifFormat : "%e/%m/%Y %H:%M",
      daFormat : "%e/%m/%Y %H:%M",
      button : "trigger_publicdateAdvancedStart",
      showsTime : true
    });
    document.getElementById("trigger_publicdateAdvancedFinish").disabled = false;
    Calendar.setup({
      inputField : "timeendPublicDate",
      ifFormat : "%e/%m/%Y %H:%M",
      daFormat : "%e/%m/%Y %H:%M",
      button : "trigger_publicdateAdvancedFinish",
      showsTime : true
    });
    document.getElementById("trigger_recorddateAdvancedStart").disabled = false;
    Calendar.setup({
      inputField : "timestartRecordDate",
      ifFormat : "%e/%m/%Y %H:%M",
      daFormat : "%e/%m/%Y %H:%M",
      button : "trigger_recorddateAdvancedStart",
      showsTime : true
    });
    document.getElementById("trigger_recorddateAdvancedFinish").disabled = false;
    Calendar.setup({
      inputField : "timeendRecordDate",
      ifFormat : "%e/%m/%Y %H:%M",
      daFormat : "%e/%m/%Y %H:%M",
      button : "trigger_recorddateAdvancedFinish",
      showsTime : true
    });

function RecorrerForm(obj) {
   var exit="";
   var frm = document.getElementById('form_buscador');
   if ( $('show_advanced').value == 1 ) {
      for (i=0;i<frm.elements.length;i++) {
        if ( (frm.elements[i].type == 'text') && frm.elements[i].name != 'searchs[search_id]' && frm.elements[i].name != 'searchs[serial]' && frm.elements[i].name != 'searchs[search]') {
           if ( frm.elements[i].value!='' ) {
  	      $('some_advanced_data').show();
 	      new Effect.Fade('some_advanced_data', { duration: 7.0, from: 1.0, to: 0.0 });
	      return false;
	   }
        } else if ( frm.elements[i].type == 'checkbox' ) {
	   if ( frm.elements[i].checked ) {
	      $('some_advanced_data').show();
 	      new Effect.Fade('some_advanced_data', { duration: 7.0, from: 1.0, to: 0.0 });
	      return false;
	   }
	}
      }
      if ( $('broadcast_advanced').value != -1 || $('broadcast_advanced').value != -1 ) {      
         $('some_advanced_data').show();
 	 new Effect.Fade('some_advanced_data', { duration: 7.0, from: 1.0, to: 0.0 });
	 return false;
      }
   }
   //if( document.getElementById('NoOOMMMessage') ) Effect.toggle('NoOOMMMessage');
   Effect.toggle('advanced_search', 'blind', { 
      afterFinish: function () { 
         obj.toggleClassName('inv'); 
      } 
   });
   change_display_advanced();
   return true;
}

compruebaIntervaloFecha = function(id){
  var dstart = new Date(Date.parse(dmy2ymd($('timestart'+id).value)));
  var dend   = new Date(Date.parse(dmy2ymd($('timeend'+id).value)));
  var today  = new Date();
  var value  = false;
  var error  = '';
  if (dstart > dend){
    error = 'Error: Inicio > Final';
  } else if (dstart > today){
    error = 'Fecha de inicio en el futuro';
  }

  if (error != '') {
    $('error_' + id).innerHTML = error;
    $('error_' + id).style.float = "left";
    $('error_' + id).show();
  } else {
    $('error_' + id).innerHTML = '';
    $('error_' + id).hide();
  }
}
</script>
</div>
