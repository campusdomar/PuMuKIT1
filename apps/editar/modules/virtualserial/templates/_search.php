 <form id="form_buscador" name="busqueda" method="post" onsubmit="return procesaForm(this);">
    <select id="options_mms" style="margin: 10px 10px 10px 2px; width: 9%; float:left; background-color: #ffc; overflow: hidden;" title="Acciones sobre elementos selecionados" onchange="window.change_select('mm', $('options_mms'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>

      <option value="delete_sel_virtual">Borrar selecionados</option>
      <option value="inv_announce_virtualserial_sel">Anunciar/Desanunciar selecionados</option>
      <option disabled="">---</option>
      <option disabled="" value="set_status_0_sel">Bloquear selecionados</option> 
      <option disabled="" value="set_status_1_sel">Ocultar selecionados</option> 
      <option disabled="" value="set_status_2_sel">Publicar selecionados</option> 
      <option disabled="" value="set_status_3_sel">Publicar totalmente selecionados</option>
    </select>
 <div style="float:left; width: 89%;">
  <div style="float:left; width: 5%; ">
    <div>Id.</div>
      <div>
        <input class="box_lupa" style="height:14px; width: 70%;" placeholder="<?php echo __("Id")?>..." name="searchs[search_id]" value="<?php echo $sf_user->getAttribute('search_id', null, 'tv_admin/virtualserial/searchs');?>" maxlength="20" type="text" />
      </div>
      <noscript><?php echo submit_tag('go'); ?></noscript>
  </div>

  <div style="float:left; width: 5%; ">
    <div>Serie</div>
      <div>
        <input class="box_lupa" style="height:14px; width: 70%;" placeholder="<?php echo __("Serie")?>..." name="searchs[serial]" 
               value="<?php echo $sf_user->getAttribute('serial', null, 'tv_admin/virtualserial/searchs');?>" maxlength="20" type="text" />
      </div>
  </div>

  <div style="float:left; width:20%;">
    <div>Palabras clave</div>
      <div style="position: relative">
        <input class="box_lupa" placeholder="<?php echo __("Busca")?>..." name="searchs[search]" 
               value="<?php echo $sf_user->getAttribute('search', null, 'tv_admin/virtualserial/searchs');?>" maxlength="100" type="text" 
               style="height:14px; width: 90%;"/>
        <input type="image" src="/images/1.8/lupa_buscador.png" style="border:none; position: absolute; top: 0px; right: 6%;" name="startsearch" />
      </div>
  </div>
  <div style="width: 10%; float:left; overflow:hidden">
    <div>Vídeo&nbsp;/&nbsp;Audio</div>
    <?php echo select_tag('searchs[type]',
      options_for_select(
        array('all'   => 'Todos',
              'video' => 'Vídeo',
              'audio' => 'Audio'),
        $sf_user->getAttribute('type', null, 'tv_admin/virtualserial/searchs')),
      array('style' => 'width: 90%; margin: 0px;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \''. url_for('virtualserial/list') .'\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="width:10%; float:left">
    <div>Duración</div>
    <?php echo select_tag('searchs[duration]',
      options_for_select(
        array('all' => 'Todas',
              '-5'   => 'Hasta&nbsp;&nbsp;&nbsp;5 minutos',
              '-10'  => 'Hasta 10 minutos',
              '-30'  => 'Hasta 30 minutos',
              '-60'  => 'Hasta 60 minutos',
              '+60'  => 'Más de 60 minutos',),
        $sf_user->getAttribute('duration', null, 'tv_admin/virtualserial/searchs')),
      array('style' => 'width: 90%; margin: 0px;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \''. url_for('virtualserial/list') .'\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="width: 10%;  float:left">
    <div>Año</div>
    <?php $opciones_form_years = array('all' => 'Todos') + $sf_data->getRaw('years');
      echo select_tag('searchs[year]',
      options_for_select( $opciones_form_years,
        $sf_user->getAttribute('year', null, 'tv_admin/virtualserial/searchs')),
      array('style' => 'width:90%; margin: 0px;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \''. url_for('virtualserial/list') .'\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="width: 10%; float:left">
    <div>Género</div>
    <?php $opciones_form_genres = array('all' => 'Todos') + $sf_data->getRaw('genres');
      echo select_tag('searchs[genre]',
      options_for_select( $opciones_form_genres,
        $sf_user->getAttribute('genre', null, 'tv_admin/virtualserial/searchs')),
      array('style' => 'width:90%; margin: 0px;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \''. url_for('virtualserial/list') .'\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="width: 10%; float:left; ">
    <div>Revisado</div>
    <?php echo select_tag('searchs[check]',
      options_for_select(
        array('all'=> 'Todos',
              'si' => 'Si',
              'no' => 'No'),
        $sf_user->getAttribute('check', null, 'tv_admin/virtualserial/searchs')),
      array('style' => 'width: 90%; margin: 0px;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \''. url_for('virtualserial/list') .'\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
<div style="float: left; width: 15%; max-width: 52px;">
 <div>Avanzada</div>
<div class="advanced_search_up_down" style="font-weight:bolder; font-size: 22px; background-color: #ddd; padding: 3px 0px; margin-top: 2px;">
     <div title="Mostrar/Ocultar búsqueda avanzada" <?php echo ($sf_user->getAttribute('selected', 0, 'tv_admin/virtualserial/searchs') == 0 )?'class="inv"':'class'?> style="" href="#" onclick="RecorrerForm(this); return false;">
        &nbsp;&nbsp;
     </div>
</div>
</div>
  <div style="width:15%; max-width:75px; float:left; margin-left: 1%;">
    <div>Eliminar filtros</div>
      <input type="submit" name="search" value="reset" onclick="$('show_advanced').value = 0; $('reset').setValue('reset...')" id="reset" class="btn" style="cursor:pointer; width:90%; padding: 3px; margin-top:2px;" />
  </div>
  <div>
     <img src="/images/admin/load/spinner.gif" style="width:40px; display: none;" id="search_loading_img" />
  </div>

<div style="clear: left;"></div>
<div id="advanced_search" <?php echo ($sf_user->getAttribute('selected', 0, 'tv_admin/virtualserial/searchs') == 0 )?'style="display:none; width: 100%;"':'style="display:inline; width: 100%;"'?> >
  <?php include_partial('advanced_search', array('years' => $sf_data->getRaw('years'),
                                        'genres' => $sf_data->getRaw('genres'), 'roles' => $sf_data->getRaw('roles')))?>
</div>
</div>
<div id="some_advanced_data" style="display: none;">
  Existe algún campo con datos en el formulario avanzado. Debe eliminarlo o resetear para ocultar la búsqueda avanzada.
</div>
</form>
<?php echo javascript_tag("
function change_display_advanced() {
   if ( $('show_advanced').value == 0 ) {
      $('show_advanced').value = 1;
   } else {
      $('show_advanced').value = 0;
   }
}
function procesaForm(obj) {
  var Procesa = true;

  for ( i=0; i< $$('.error').length; i++ ) {
    if ( i == 0 || i == 1 ) {
      if ( $$('.error')[i].innerHTML != '' ) { Procesa = false; }
    }
  }
  if (Procesa) {
    $('search_loading_img').show();
    new Ajax.Updater('mm_mms', '" . url_for('virtualserial/listfromtree') . "', {asynchronous:true, evalScripts:true, parameters:Form.serialize(obj)});
     return false;
  } else {
    return false;
  }
}
") ?>