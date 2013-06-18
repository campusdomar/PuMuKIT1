<div style="float:left; width: 90%; max-width: 800px">
<form id="form_buscador" name="busqueda" method="post" onsubmit="new Ajax.Updater('list_mms', '<?php echo url_for("mms/list") ?>', {asynchronous:true, evalScripts:true, parameters:Form.serialize(this)}); $('search_loading_img').show(); return false;">

  <div style="float:left; width:5%">
    <div>Id.</div>
      <div>
        <input class="box_lupa" style="height:14px; width:20px; margin-right: 10px;" placeholder="<?php echo __("Id")?>..." name="searchs[search_id]" value="<?php echo $sf_user->getAttribute('search_id', null, 'tv_admin/mm/searchs');?>" maxlength="20" type="text" />
      </div>
      <noscript><?php echo submit_tag('go'); ?></noscript>
  </div>

  <div style="float:left; width:25%">
    <div>Palabras clave</div>
      <div style="position: relative">
        <input class="box_lupa" style="height:14px; width: 90%;" placeholder="<?php echo __("Busca")?>..." name="searchs[search]" value="<?php echo $sf_user->getAttribute('search', null, 'tv_admin/mm/searchs');?>" maxlength="100" type="text" />
        <input type="image" src="/images/uned/lupa_buscador.png" style="border:none; position: absolute; top: 0px; right: 6%;" name="startsearch" />
      </div>
  </div>
  <div style="float:left; width:10%">
    <div>Vídeo&nbsp;/&nbsp;Audio</div>
    <?php echo select_tag('searchs[type]',
      options_for_select(
        array('all'   => 'Todos',
              'video' => 'Vídeo',
              'audio' => 'Audio'),
        $sf_user->getAttribute('type', null, 'tv_admin/mm/searchs')),
      array('style' => 'width:90%;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \'' . url_for("mms/list") . '\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="float:left;width:10%">
    <div>Duración</div>
    <?php echo select_tag('searchs[duration]',
      options_for_select(
        array('all' => 'Todas',
              '-5'   => 'Hasta&nbsp;&nbsp;&nbsp;5 minutos',
              '-10'  => 'Hasta 10 minutos',
              '-30'  => 'Hasta 30 minutos',
              '-60'  => 'Hasta 60 minutos',
              '+60'  => 'Más de 60 minutos',),
        $sf_user->getAttribute('duration', null, 'tv_admin/mm/searchs')),
      array('style' => 'width:90%;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \'' . url_for("mms/list") . '\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="float:left; width:10%">
    <div>Año</div>
    <?php $opciones_form_years = array('all' => 'Todos') + $sf_data->getRaw('years');
      echo select_tag('searchs[year]',
      options_for_select( $opciones_form_years,
        $sf_user->getAttribute('year', null, 'tv_admin/mm/searchs')),
      array('style' => 'width:90%;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \'' . url_for("mms/list") . '\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="float:left; width:10%">
    <div>Género</div>
    <?php $opciones_form_genres = array('all' => 'Todos') + $sf_data->getRaw('genres');
      echo select_tag('searchs[genre]',
      options_for_select( $opciones_form_genres,
        $sf_user->getAttribute('genre', null, 'tv_admin/mm/searchs')),
      array('style' => 'width:90%;',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \'' . url_for("mms/list") . '\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="float:left; width: 10%; ">
    <div>Revisado</div>
    <?php echo select_tag('searchs[check]',
      options_for_select(
        array('all'=> 'Todos',
              'si' => 'Si',
              'no' => 'No'),
        $sf_user->getAttribute('check', null, 'tv_admin/mm/searchs')),
      array('style' => 'width: 90%; ',
            'onchange' => 'Javascript:new Ajax.Updater(\'list_mms\', \'/editar.php/mms/list\', {asynchronous:true, evalScripts:true, parameters:Form.serialize(\'form_buscador\')});')); ?>
  </div>
  <div style="width:15%; max-width:75px; float:left">
    <div>Eliminar filtros</div>
      <input type="submit" name="search" value="reset" onclick="console.log('onsubmit2'); $('reset').setValue('reset...')" id="reset" class="btn" style="cursor:pointer; width:90%; padding: 4px; margin-top:2px;" />
  </div>
  <div>
     <img src="/images/admin/load/spinner.gif" style="width:40px; display: none;" id="search_loading_img" />
  </div>
</form>
</div>