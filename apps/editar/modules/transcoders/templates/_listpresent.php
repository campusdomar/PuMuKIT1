<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('present_transcoder', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%">P</th>
      <th width="1%"></th>
      <th width="1%">Img</th>
      <th width="1%">Id</th>
      <th>Path</th>
      <th>Perfil</th>
      <th>Porcentaje</th>
      <th>Fecha</th> 
    </tr>
  </thead>
  <tbody>
  <?php if (count($transcoders) == 0):?>
    <tr>
      <td colspan="13">
       Listado de procesos vacío.
      </td>
    </tr>
  <?php endif; ?>
  <?php $i = 1; foreach ($transcoders as $transcoder): $odd = fmod(++$i, 2);?>
    <?php include_partial('table', array('odd' => $odd, 'transcoder' => $transcoder, 'checkbox_name' => 'present_transcoder'));?>
  <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="13">
        <div class="float-right">
          <?php include_partial('transcoders/pager_ajax', array(
            'name' => 'present_transcoder', 
            'page' => $page, 
            'total' => $total,
            'div' => 'list_present_transcoders',
            'url' => 'transcoders/listpresent'
          )) ?> 
        </div>
        <?php echo $total_transcoder ?>/<?php echo $total_transcoder_all ?> Transcodificador
      </th>
    </tr>
  </tfoot>
</table>
<br />
