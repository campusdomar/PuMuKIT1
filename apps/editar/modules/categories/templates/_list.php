<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('category', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%">Id</th>
      <th>Cod - Nombre</th>
      <th>Obj. MM.</th>
    </tr>
  </thead>
  
  <tbody>
<?php if (count($categories) == 0):?>
    <tr>
      <td colspan="9">
        No existen categorias en la BBDD.
      </td>
    </tr>
<?php else:?>
   <?php $i = 1; foreach($categories as $node): $c = $node[CategoryPeer::TREE_ARRAY_NODE]; $odd = fmod(++$i, 2); $has_children = count($node[CategoryPeer::TREE_ARRAY_CHILDREN]);?>
    <tr onmouseover="this.addClassName('tv_admin_row_over')" onmouseout="this.removeClassName('tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($c->getId() == $sf_user->getAttribute('id', null, 'tv_admin/category')) echo ' tv_admin_row_this'?>" >
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
                           array('title' => 'Editar categoria ' . $c->getId()), 
                           array('width' => '800')) ?>
      </td>
<td>
      <?php echo m_link_to(image_tag('admin/mbuttons/copy_inline.gif', 'alt=nuevo title=Nueva categoría hijo'), 
                           'categories/create?parent_id=' . $c->getId(), 
                           array('title' => 'Nueva categoria hijo para ' . $c->getId()), 
                           array('width' => '800')) ?>
      </td>
<td>
    <?php echo m_link_to(image_tag('admin/mbuttons/relation_inline.gif', 'alt=relations title=relations'), 
                         'categories/showrelations?id=' . $c->getId(), 
                         array('title' => 'Editar relaciones de la categoria ' . $c->getId()), 
                         array('width' => '800')) ?>
      </td>
<td>
      <?php echo $c->getId() ?> 
      </td>
<td>

<ul class="category_tree" >
   <?php echo str_repeat('<li class="' . (($has_children)?'collapsed':'element') .'" >', $node[CategoryPeer::TREE_ARRAY_LEVEL])?>
    <span class="icon" onclick="javascript:toggle_section_cat(<?php echo $c->getId() ?>, this)">&nbsp;</span> 
    <span> <?php echo $c->getCodName() ?> </span>
   <?php echo str_repeat('</li>', $node[CategoryPeer::TREE_ARRAY_LEVEL])?>
</ul>


    </td>
    <td>
      <?php echo $c->getNumMm() ?>
      </td>
    </tr>
      <?php if($has_children):?>
        <?php include_partial('list_children', array('path' => 'c_'. $c->getId(), 
                                                     'parent' => 'p_'. $c->getId(),
                                                     'nodes'  => $node[CategoryPeer::TREE_ARRAY_CHILDREN])) ?>
      <?php endif?>

  <?php endforeach?>
<?php endif; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="10">&nbsp;</th>
    </tr>
  </tfoot>
</table>



<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>
