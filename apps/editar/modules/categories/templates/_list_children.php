<?php foreach($nodes as $node): $c = $node[CategoryPeer::TREE_ARRAY_NODE];$has_children = count($node[CategoryPeer::TREE_ARRAY_CHILDREN])?>
    <tr onmouseover="this.addClassName('tv_admin_row_over')" 
        onmouseout="this.removeClassName('tv_admin_row_over')" 
        class="tv_admin_row_<?php echo $odd ?> <?php echo $parent?> <?php echo $path?>" 
        style="display:none" >
      <td>
        <input id="<?php echo $c->getId()?>" class="category_checkbox" type="checkbox">
      </td>
      <td>
  <!-- TODO  Delete con hijos -->
    <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=borrar title=borrar'), 
                              array('update' => 'list_categories', 
                                    'url' => 'categories/delete?id='.$c->getId(), 
                                    'script' => 'true', 
                                    'confirm' => 'Seguro')); ?>
      </td>
<td>
    <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar'), 
                         'categories/edit?id=' . $c->getId(), 
                         array('title' => 'Editar categoria ' . $c->getCodName()), 
                         array('width' => '800')) ?>
      </td>
<td>
    <?php echo m_link_to(image_tag('admin/mbuttons/copy_inline.gif', 'alt=nuevo title=hijo'), 
                         'categories/create?parent_id=' . $c->getId(), 
                         array('title' => 'Nueva categoria hijo para ' . $c->getCodName()), 
                         array('width' => '800')) ?>
      </td>
<td>
    <?php echo m_link_to(image_tag('admin/mbuttons/relation_inline.gif', 'alt=relations title=relations'), 
                         'categories/showrelations?id=' . $c->getId(), 
                         array('title' => 'Editar relaciones de la categoria ' . $c->getCodName()), 
                         array('width' => '800')) ?>
      </td>
<td>
    <?php echo $c->getId() ?>
      </td>
<td>
   <?php echo str_repeat('<ul class="category_tree" ><li class="element" >', $node[CategoryPeer::TREE_ARRAY_LEVEL] -1)?>
   <ul class="category_tree" ><li class="<?php echo ($has_children)?'collapsed':'element'?>" >
    <span class="icon" onclick="javascript:toggle_section_cat(<?php echo $c->getId() ?>, this)">&nbsp;</span> 
    <span> <?php echo $c->getCodName() ?> </span>
   <?php echo str_repeat('</li></ul>', $node[CategoryPeer::TREE_ARRAY_LEVEL])?>
</ul>
      </td>
      <td>
      <?php echo $c->getNumMm() ?>
      </td>
    </tr>
    <?php if(count($node[CategoryPeer::TREE_ARRAY_CHILDREN])):?>
        <?php include_partial('list_children', array('path'  => $path . ' c_' . $c->getId(), 
                                                     'parent'=> ' p_' . $c->getId(), 
                                                     'nodes' => $node[CategoryPeer::TREE_ARRAY_CHILDREN])) ?>
    <?php endif?>

<?php endforeach?>
