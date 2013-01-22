<h2><?php echo __('Programas') ?></h2>

<div>
  <table>
  <?php foreach( $softwares as $software):?>
    <tr>
      <td><?php echo image_tag('tv/software/' . $software[0] . '.gif')?> </td><td> <?php echo link_to($software[1], $software[2])?> </td>
    </tr>
  <?php endforeach?>
  </table>
</div>