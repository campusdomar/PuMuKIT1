<?php foreach($nodes as $node): $c = $node[CategoryPeer::TREE_ARRAY_NODE]; $has_children = count($node[CategoryPeer::TREE_ARRAY_CHILDREN])?>
  <li draggable="false" id="cat_li_children_<?php echo $c->getId()?>" class="<?php echo ($parent == 'root')?'':'nodisplay'?>
                                                           cat_li_parent_<?php echo $parent?> 
                                                           <?php echo ($has_children)?'collapsed':'element' ?> 
                                                           <?php echo $c->getMetacategory()?'metacategory':'' ?> 
                                                           <?php echo ($c->getNumMm()==0)?'nomm':''?>">
    <span class="icon" onclick="javascript:toggle_tree_cat(this, '<?php echo $c->getId()?>')">&nbsp;</span>
    <span <?php if(!$c->getMetacategory()):?> ondblclick="javascript:add_tree_several_cat(<?php echo $c->getId()?>, <?php echo $mm_id ?>, <?php echo $block_cat ?>);" <?php endif ?> >
      <?php echo $c->getCod() ?> - <?php echo $c->getName() ?> 
      <?php if(!$c->getMetacategory()):?>(<span id="info_num_mm_<?php echo $c->getId() ?>"><?php echo $c->getNumMm()?></span>)<?php endif ?>
    </span>
    <?php if($has_children):?>
      <ul id="cat_ul_children_<?php echo $c->getId()?>" class="category_tree" >
        <?php include_partial('list_categories', array('mm_id' => $mm_id, 
                                                       'parent' => $c->getId(), 
                                                       'block_cat' => $block_cat,
                                                       'nodes' => $node[CategoryPeer::TREE_ARRAY_CHILDREN])) ?>
      </ul>
    <?php endif?>
  </li>
<?php endforeach?>

