<div id="tv_admin_container">

<form onsubmit="return false;" action="#" method="post">

<input type="hidden" name="id" id="id" value="<?php echo  $category->getId() ?>" />


<fieldset>
<div style="max-height: 600px; overflow-y: scroll; overflow-x: hidden;">
<?php if (count($categories) == 0):?>
  <div style="float:left; padding: 1%; min-height: 30px;">
    No existen categorias en la BBDD.     
  </div>
<?php endif ?>
<?php foreach($categories as $node): $c = $node[CategoryPeer::TREE_ARRAY_NODE]; $has_children = count($node[CategoryPeer::TREE_ARRAY_CHILDREN]);?>
<div class="form-row" style="overflow: hidden; padding:0px">
  <div style="width:100%; float:left; padding: 5px; padding-left: <?php echo ($node[CategoryPeer::TREE_ARRAY_LEVEL] * 20) ?>px">
   <?php include_partial('showrelation_select', array('mainc'=> $category, 'c' => $c, 'relations' => $relations)) ?>
    <?php echo $c->getCod() ?> - <?php echo $c->getName() ?>
  </div>
</div>
  <?php if($has_children):?>
   <?php include_partial('showrelation_children', array('mainc'=> $category, 
                                                        'nodes' => $node[CategoryPeer::TREE_ARRAY_CHILDREN], 
                                                        'relations' => $relations)) ?>
  <?php endif?>
<?php endforeach?>
</div>
</fieldset>

<ul class="tv_admin_actions">
  <li><?php echo button_to_function('Ok', "Modalbox.hide()", 'class=tv_admin_action_save') ?> </li>
</ul>

</form>
</div>
