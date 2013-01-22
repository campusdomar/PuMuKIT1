<h2 id="index_notices_<?php echo $sf_user->getCulture() ?>"><?php echo __('Noticias') ?></h2>

<div id="notice_index">
  <table>
   <tbody>
    <?php $aux=$sf_data->getRaw('notices'); $total = count($notices); for($i = 0; $i<$total; $i++): $notice=$aux[$i]; $odd = fmod($i, 2)?>
      <tr id="row_notice_<?php echo $odd ?>">
        <td><div id="date"><?php echo $notice->getDate('d/m/y') ?></div></td>
        <td><div id="text"><?php echo $notice->getText() ?></div></td>
      </tr>
    <?php endfor;?>
   </tbody>
  </table>
</div>

<div class="mas"> <a href="<?php echo url_for('news/index')?>">[<?php echo __('Ver más')?>]</a> </div>

