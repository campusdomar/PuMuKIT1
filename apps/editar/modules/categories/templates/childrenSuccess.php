<?php foreach($categories as $c): $children = $c->getChildren(); $has_children = count($children); ?>
    <tr onmouseover="this.addClassName('tv_admin_row_over')" onmouseout="this.removeClassName('tv_admin_row_over')" 
        class="tv_admin_row_0 <?php echo $class_name?>" id="row_cat_<?php echo $c->getId()?>" data-level="<?php echo $level?>">
      <td>
        <input id="<?php echo $c->getId()?>" class="category_checkbox" type="checkbox">
      </td>
      <td>
      <?php include_partial('delete', array('has_children' => $has_children, 'c' => $c)) ?>
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
<!--
<td>
    <?php echo m_link_to(image_tag('admin/mbuttons/relation_inline.gif', 'alt=relations title=relations'), 
                         'categories/showrelations?id=' . $c->getId(), 
                         array('title' => 'Editar relaciones de la categoria ' . $c->getId()), 
                         array('width' => '800')) ?>
      </td>
-->
<td>
      <?php echo $c->getId() ?> 
      </td>
<td>

<ul class="category_tree" >
   <?php echo str_repeat('<ul class="category_tree" ><li class="element" >', $level -1)?>
   <ul class="category_tree" ><li class="<?php echo ($has_children)?'collapsed noload':'element'?>" >
    <span class="icon" onclick="javascript:toggle_section_cat(<?php echo $c->getId() ?>, this, <?php echo $level?>)">&nbsp;</span> 
    <span id="info_cat_<?php echo $c->getId()?>"> <?php echo $c->getCodName() ?> </span>
   <?php echo str_repeat('</li></ul>', $level)?>
</ul>


    </td>
    <td>
      <?php echo $c->getNumMm() ?>
      </td>
    </tr>
  <?php endforeach?>