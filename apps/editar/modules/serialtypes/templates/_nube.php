<div id="contacto">
<ul style="line-height: 30px; list-style-type: none; text-align:center; font-family: 'Optima';">

   <?php foreach($tags as $tag):?>
  <li style="display: inline;">
   <?php $gr = 200 - intval($tag[1] * 6)?>
    <span  style="font-size:<?php echo $tag[1]?>px; text-decoration: none; color:rgb(<?php echo $gr?>, <?php echo $gr?>, <?php echo $gr?>)">
      <?php echo $tag[0] ?>
   </span>&nbsp;&nbsp;&nbsp;&nbsp;
  </li>
<?php endforeach?>

</ul>
</div>
