<h1 id="index_h1"><?php echo __('Principal')?></h1>

<?php foreach ($widgets as $w): ?>
  <div class="index_widget">
    <?php include_component('widgets', $w->getWidget()->getName() ) ?>
  </div>
<?php endforeach ?>
