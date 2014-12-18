<dt>
<?php echo $name?>:
</dt>
<dd>
<table>
 <tbody>
  <?php $t = count($widgets) ; for( $i=0; $i<$t; $i++): $widget = $widgets[$i] //idea primer y ultimo apate ?>  
    <tr>
      <td><ul><li></li><ul></td>
      <td>
        <?php if($widget->getWidget()->getConfigurable()):?>
	  <?php $aux1 = $widget->getWidget()->getWidgetModules(); if(count($aux1) != 0):?>
	    <a href="<?php echo url_for($aux1[0]->getModule(). '/index') ?>">
              <?php echo image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar class=miniTag')?>
            </a>
          <?php else:?>        
            <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=editar title=editar class=miniTag'), 'widgets/edit?id='.$widget->getId(), array('title' => 'Editar widget '.$widget->getId() . ' - "' . $widget->getWidget()->getName() .'"'), array('width' => '800')) ?>       
          <?php endif?>
        <?php endif?>


      </td>
      <td><?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=quitar title=quitar class=miniTag'), array('update' => 'body_div', 'url' => 'widgets/delete?id='.$widget->getId().'&bar='.$bar, 'script' => 'true', 'confirm' => '&iquest;Seguro que desea borrar el widget?'))?></td>
      <td><?php echo (( $i == 0) ? '&nbsp;' : (link_to_remote('&#8593;', array('update' => 'body_div', 'url' => 'widgets/up?id='.$widget->getId().'&bar='.$bar, 'script' => 'true'))))   ?></td>
      <td><?php echo (( $i == $t-1)? '&nbsp;' : (link_to_remote('&#8595;', array('update' => 'body_div', 'url' => 'widgets/down?id='.$widget->getId().'&bar='.$bar, 'script' => 'true')))) //dos espacios para misma anchura que flecha?></td>
      <td><?php echo $widget->getWidget()->getName(); ?></td>
    </tr>
  <?php endfor; ?>
  <tr>
    <td><ul><li></li><ul></td>
    <td colspan="6"><?php echo m_link_to('nuevo...', 'widgets/create?type='.$type.'&bar='.$bar, array('title' => 'Crear ' ), array('width' => '800')) ?></td>
  </tr>
 </tbody>
</table>
</ul>
</dd>