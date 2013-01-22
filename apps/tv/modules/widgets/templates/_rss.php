<h2>RSS</h2>

<div>
  <table>
  <?php foreach( $rsss as $rss):?>
    <tr>
    <td><?php echo image_tag('tv/iconos/' . $rss[0] . '.gif')?> </td><td> <?php echo link_to($rss[1], $rss[2])?> </td>
    </tr>
  <?php endforeach?>
  </table>
</div>