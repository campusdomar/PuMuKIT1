<?php foreach ($nodes as $applicable_cat):
  $children = $applicable_cat->getChildren(); 
  $has_children = count($children);

  $li_class  = "notload cat_li_parent_" . $parent;
  $li_class .= ($has_children)?' collapsed':' element';
  $li_class .= $applicable_cat->getMetacategory()?' metacategory':'';
  $li_class .= ($applicable_cat->getNumMm()==0)?' nomm':'';?>
  
  <li draggable="false" id="cat_li_children_<?php echo $applicable_cat->getId()?>" class="<?php echo $li_class?>">
    <span class="icon" onclick="javascript:toggle_tree_cat_mmless(this, '<?php echo $applicable_cat->getId()?>', <?php echo $block_cat ?>)">&nbsp;</span>
    <span <?php if(!$applicable_cat->getMetacategory()):?> onclick="$$('.clicked_category_right').invoke('removeClassName', 'clicked_category_right'); this.addClassName('clicked_category_right');" ondblclick="javascript:add_tree_cat_virtualground(<?php echo $applicable_cat->getId()?>, <?php echo $vg_id ?>, <?php echo $block_cat ?>);" <?php endif ?> >

      <?php echo $applicable_cat->getCod() ?> - <?php echo $applicable_cat->getName() ?> 
      <?php if(!$applicable_cat->getMetacategory()):?>(<span id="info_num_mm_<?php echo $applicable_cat->getId() ?>"><?php echo $applicable_cat->getNumMm()?></span>)<?php endif ?>
    </span>
    <?php if($has_children):?>
      <ul id="cat_ul_children_<?php echo $applicable_cat->getId()?>" class="category_tree" >
      </ul>
    <?php endif?>
  </li>

<?php endforeach?>