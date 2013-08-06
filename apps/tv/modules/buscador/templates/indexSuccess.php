<?php setlocale(LC_TIME, $sf_user->getCulture().'_ES.utf-8') ?>
<div id="unedtv_mmobjs">
  <div class="titulo_widget titulo_widget_grande"> 
    <?php echo __($title)?>
  </div>

  <div style="margin: 5px 0px 0px 10px; padding-bottom:50px;">
     <form id="form_buscador" name="busqueda" method="get" action="<?php echo url_for('buscador/index')?>">
      <?php include_partial('global/buscador', array('unescos' => $sf_data->getRaw('unescos'), 'years' => $sf_data->getRaw('years'), 'genres' => $sf_data->getRaw('genres'), 'module' => 'buscador'))?>
     </form>
  </div>

  <?php include_partial('global/displaymmsdate', array('page' => $page, 'total' => $total, 'url' => '/buscador?', 'mms' => $mms))?>
</div>