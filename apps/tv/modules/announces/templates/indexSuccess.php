<h1 id="announces_h1"><?php echo __('Novedades')?></h1>

<p style="padding:10px 0px">
  <?php echo __('Últimas grabaciones realizadas por este servicio, o cedidas por otras organizaciones, que están puestas a disposición de los usuarios de la Universidad, ordenadas según la fecha de creación o publicación.')?>
</p>

<div id="announce">
  <?php include_partial('global/announce', array('announces' => $announces)) ?>
</div>