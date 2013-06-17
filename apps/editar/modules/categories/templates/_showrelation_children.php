<?php foreach($nodes as $node): $c = $node[CategoryPeer::TREE_ARRAY_NODE]; $has_children = count($node[CategoryPeer::TREE_ARRAY_CHILDREN]);?>
<div class="form-row" style="overflow: hidden; padding: 0px">
  <div style="width:100%; float:left; padding: 5px; padding-left: <?php echo ($node[CategoryPeer::TREE_ARRAY_LEVEL] * 20) ?>px">
   <?php include_partial('showrelation_select', array('mainc'=> $mainc, 'c' => $c, 'relations' => $relations)) ?>
   <?php echo $c->getCod()?> - <?php echo $c->getName() ?>
  </div>
</div>
  <?php if($has_children):?>
    <?php include_partial('showrelation_children', array('mainc'=> $mainc, 
                                                         'nodes' => $node[CategoryPeer::TREE_ARRAY_CHILDREN],
                                                         'relations' => $relations)) ?>
  <?php endif?>
<?endforeach?>