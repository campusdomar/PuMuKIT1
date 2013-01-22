<h1 id="notices_h1"><?php echo __('Noticias')?></h1>

<h2 id="notices_<?php echo $sf_user->getCulture() ?>"><?php echo __('Noticias')?></h2>
<br />

<div id="notice_index">
  <table style="width:100%">
   <tbody>
     <?php $aux=$sf_data->getRaw('notices'); $total=count($notices); for($i = 0; $i<$total; $i++): $notice=$aux[$i]; $odd = fmod($i, 2)?>
      <tr id="row_notice_<?php echo $odd ?>">
        <td><div id="date"><?php echo $notice->getDate() ?></div></td>
        <td><div id="text"><?php echo $notice->getText() ?></div></td>
      </tr>
     <?php endfor;?>
   </tbody>
  </table>
</div>
