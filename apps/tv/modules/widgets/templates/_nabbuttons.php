<h2><?php echo __('Categor&iacute;as')?></h2>

<div style="width:100%; overflow:hidden;">
  <?php foreach($categories as $c_id => $c):?>
  <div style="width:30%; float:left; padding: 5px 0px; text-align: center; margin: 5px 3px 0px; background-color: #f0f0ff;">
    <a href="<?php echo url_for('categories/index?id=' . $c->getId())?>">
      <img style="width:60px; height:60px" id="img_cat_<?php echo $c_id ?>" src="<?php echo $c->getImg() ?>" />
    </a>
    <div>
      <a id="ancor_cat_<?php echo $c_id ?>" 
         style="text-decoration: none; color: #888; font-weight: bold; font-size: 100%" 
         href="<?php echo url_for('categories/index?id=' . $c->getId())?>">
        <?php echo $c->getName()?>
      </a>
    </div>
  </div>
  <?php endforeach?>
</div>
