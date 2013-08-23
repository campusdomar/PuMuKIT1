<?php  foreach($nodes as $c): $children = $c->getChildren(); $has_children = count($children)?>
  <li draggable="false" id="cat_li_children_<?php echo $c->getId()?>" class="notload
                                                           cat_li_parent_<?php echo $parent?> 
                                                           <?php echo ($has_children)?'collapsed':'element' ?> 
                                                           <?php echo $c->getMetacategory()?'metacategory':'' ?> 
                                                           <?php echo ($c->getNumMm()==0)?'nomm':''?>">
    <span class="icon" onclick="javascript:toggle_tree_cat(this, '<?php echo $c->getId()?>', <?php echo $mm_id ?>, <?php echo $block_cat ?>)">&nbsp;</span>
    <span <?php if(!$c->getMetacategory()):?> onclick="$$('.clicked_category_right').invoke('removeClassName', 'clicked_category_right'); this.addClassName('clicked_category_right');" ondblclick="javascript:add_tree_cat(<?php echo $c->getId()?>, <?php echo $mm_id ?>, <?php echo $block_cat ?>);" <?php endif ?> >
      <?php echo $c->getCod() ?> - <?php echo $c->getName() ?> 
      <?php if(!$c->getMetacategory()):?>(<span id="info_num_mm_<?php echo $c->getId() ?>"><?php echo $c->getNumMm()?></span>)<?php endif ?>
    </span>
    <?php if($has_children):?>
      <ul id="cat_ul_children_<?php echo $c->getId()?>" class="category_tree" >
      </ul>
    <?php endif?>
  </li>
<?php endforeach?>

