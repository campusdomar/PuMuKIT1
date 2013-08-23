<?php use_helper('Object');?>

<div style="height:41px"></div>
<div id="tv_admin_container" style="padding: 4px 20px 20px">
<fieldset id="tv_fieldset_none" class="" style="position:relative">

<div style="text-align: right; padding: 5px 20px">
  <input type="checkbox" checked="checked" onchange="toggle_show_all();"/> Mostrar todas las categorias
</div>


<dl style="margin: 0px">


    <?php /*$aux = CategoryPeer::buildTreeArray(); foreach(($aux[0][CategoryPeer::TREE_ARRAY_CHILDREN]) as $node): $c = $node[CategoryPeer::TREE_ARRAY_NODE] */?>
   <?php foreach(CategoryPeer::doSelectParents() as $c): $children = $c->getChildren() ?>
   <?php if(!$c->getDisplay()) continue?>
   <div class="form-row">
   <dt><?php echo $c->getName()?>:</dt>
   <dd>
     <div id="category<?php echo $c->getId()?>_mms">

<div style="overflow:hidden">

<div style="float: left; height: 260px" class="category" id="all_category_<?php echo $c->getId()?>">
   <?php /*if(count($node[CategoryPeer::TREE_ARRAY_CHILDREN])): $children = $node[CategoryPeer::TREE_ARRAY_CHILDREN] */?>
   <?php if(count($children)):?>
     <ul class="category_tree" >
       <?php include_partial('list_categories_ajax', array('mm_id' => $mm->getId(), 
                                                      'parent'=> 'root', 
                                                      'block_cat' => $c->getId(),
                                                      'nodes' => $children)) ?>
     </ul>
   <?php endif?>
</div>

<div style="height: 160px; float: left; padding: 120px 5px 0px">
 <a href="#" onclick="if ( $$('.clicked_category_left')[0] != undefined ) { $$('.clicked_category_left')[0].ondblclick() } return false;">&#8592;</a>
 <a href="#" onclick="if ( $$('.clicked_category_right')[0] != undefined ) { $$('.clicked_category_right')[0].ondblclick() } return false;">&#8594;</a>
</div>

<div style="width:400px; height: 260px; border: 1px solid #bbb; float: left;" class="category" id="select_category_<?php echo $c->getId()?>">
    <ul class="category_tree" id="select_ul_category_<?php echo $c->getId()?>" >
       <?php foreach($mm->getCategorys($c) as $mmc):?>
       <li class="element" id="select_li_<?php echo $mmc->getId() ?>" >
          <span class="icon">&nbsp;</span>
          <span onclick="$$('.clicked_category_left').invoke('removeClassName', 'clicked_category_left'); this.addClassName('clicked_category_left');" ondblclick="javascript:del_tree_cat(<?php echo $mmc->getId()?>, <?php echo $mm->getId() ?>);" >
          <?php echo $mmc->getCod() ?> - <?php echo $mmc->getName() ?> 
          </span>
       </li>
       <?php endforeach?>
    </ul>
</div>

</div>
     </div>
   </dd>
   </div>
   <?php endforeach?>


</dl>
</fieldset>
</div>

