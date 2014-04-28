<h1><?php echo __('Estadísticas generadas automáticamente por PuMuKIT')?></h1>



<h3><?php echo __('Número y duración de los objetos multimedia por años y estado')?></h3>

<table>
<thead>
<tr>
  <th></th>
  <?php foreach($statuss as $s): ?>
    <th><?php echo $s ?></th>
  <?php endforeach ?>
</tr>
</thead>
<body>
<?php foreach($anos as $a): $i++?>
  <tr <?php echo ($i % 2 == 0)?'class="odd"':''?>>
    <td><span style="font-weight: bold"><?php echo "$a" ?></span></td>
  <?php foreach($statuss as $sid => $s): ?>
    <td><?php echo $num_mms_A[$a][$sid] ?> (<?php echo $num_hours_A[$a][$sid] ?>'')</td>
  <?php endforeach ?>
  </tr>
<?php endforeach ?>


</tbody>
</table>


<h3><?php echo __('Número y duración de los objetos multimedia por años y género')?></h3>

<table>
<thead>
<tr>
  <th></th>
  <?php foreach($genres as $g): ?>
    <th><?php echo $g->getName() ?></th>
  <?php endforeach ?>
</tr>
</thead>
<body>
<?php foreach($anos as $a): $i++?>
  <tr <?php echo ($i % 2 == 0)?'class="odd"':''?>>
    <td><span style="font-weight: bold"><?php echo "$a" ?></span></td>
  <?php foreach($genres as $g): ?>
    <td><?php echo $num_mms_C[$a][$g->getId()] ?> (<?php echo $num_hours_C[$a][$g->getId()] ?>'')</td>
  <?php endforeach ?>
  </tr>
<?php endforeach ?>


</tbody>
</table>




<h3><?php echo _('Numero y duración de los objetos multimedia por meses y estado')?></h3>

<table>
<thead>
<tr>
  <th></th>
  <?php foreach($statuss as $s): ?>
    <th><?php echo $s ?></th>
  <?php endforeach ?>
</tr>
</thead>
<body>
<?php $i = 0; foreach($anos as $a): ?>
  <?php foreach($meses as $m): $i++?>
    <tr <?php echo ($i % 2 == 0)?'class="odd"':''?>>
      <td><span style="font-weight: bold"><?php echo "$m-$a" ?></span></td>
    <?php foreach($statuss as $sid => $s): ?>
      <td><?php echo $num_mms_B[$a][$m][$sid] ?> (<?php echo $num_hours_B[$a][$m][$sid] ?>'')</td>
    <?php endforeach ?>
    </tr>
  <?php endforeach ?>
<?php endforeach ?>


</tbody>
</table>










