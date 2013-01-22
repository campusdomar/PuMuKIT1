<h2 id="index_announce_<?php echo $sf_user->getCulture() ?>"><?php echo __('Novedades') ?></h2>

<?php include_partial('global/announce', array('announces' => $announces)) ?>

<div class="mas"> <a href="<?php echo url_for('announces/index')?>">[<?php echo __('Ver más')?>]</a> </div>


