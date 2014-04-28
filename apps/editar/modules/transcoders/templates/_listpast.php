<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('past_transcoder', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('P')?></th>
      <th width="1%"></th>
      <th width="1%"><?php echo __('Img')?></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th><?php echo __('Path')?></th>
      <th><?php echo __('Perfil')?></th>
      <th><?php echo __('Porcentaje')?></th>
      <th><?php echo __('Fecha')?></th> 
    </tr>
  </thead>
  <tbody>
  <?php if (count($transcoders) == 0):?>
    <tr>
      <td colspan="13">
       <?php echo __('Listado de procesos vacío.')?>
      </td>
    </tr>
  <?php endif; ?>

  <?php $i = 1; foreach ($transcoders as $transcoder): $odd = fmod(++$i, 2);?>
    <?php include_partial('table', array('odd' => $odd, 'transcoder' => $transcoder, 'checkbox_name' => 'past_transcoder'));?>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="13">
        <div class="float-right">
          <?php include_partial('transcoders/pager_ajax', array(
            'name' => 'past_transcoder', 
            'page' => $page, 
            'total' => $total,
            'div' => 'list_past_transcoders',
            'url' => 'transcoders/listpast'
          )) ?> 
        </div>
        <?php echo $total_transcoder ?>/<?php echo $total_transcoder_all ?> <?php echo __('Transcodificador')?>
      </th>
    </tr>
  </tfoot>
</table>
<br />
