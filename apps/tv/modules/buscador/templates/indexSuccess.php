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

<?php // TEST 
/*?>
<div>
<h1><?php echo $vcat ?></h1>
</div>

<div style="margin: 5px 0px 15px">
  <?php foreach ($objects_by_year as $year => $y_serials):?>
    <h2 class="nada">
      <span><?php echo $year;?></span>
    </h2>

    <div style="overflow: hidden">
      <?php foreach($y_serials as $a_id => $a): ?>
        <div style="width:49%; padding: 2px; float: left">
          <?php include_partial('categories/block', array('announce' => $a))?>
        </div>
        <?php if(($a_id%2) != 0): //vertical separation between each pair of serial blocks?>
          <div style="width:100%; float:left">&nbsp;</div>
        <?php endif ?>
      <?php endforeach ?> 
    </div>
  <?php endforeach ?>
</div>

<?php if(0 == count($objects_by_year)): ?>
  <?php echo __('No existen vídeos en esta categoría'); ?>
<?php endif ?>
<?php //TEST END */?>

  <?php include_partial('global/displaymmsdate', array('page' => $page, 'total' => $total, 'url' => '/buscador?', 'mms' => $mms))?>
</div>