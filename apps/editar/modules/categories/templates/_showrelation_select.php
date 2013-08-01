<?php if($mainc->getId() == $c->getId()):?>

<select disabled="disabled">
   <option>&nbsp;</option>
</select>

<?php elseif($c->getMetacategory()):?>

<select disabled="disabled">
   <option>meta</option>
</select>

<?php else:?>

<?php
$val = 0;
foreach($relations as $rs){
  if(($rs->getOneId() == $mainc->getId())&&($rs->getTwoId() == $c->getId())){
    $val = ($rs->getRecommended()?1:2);
  }
}

?>

<select onchange="cat_relation_change(<?php echo $mainc->getId()?>, <?php echo $c->getId()?>, this.value);">
  <option <?php echo ($val==0)?'selected="selected"':'' ?> value="none">Ninguno</option>
  <option <?php echo ($val==1)?'selected="selected"':'' ?> value="rec">Recomendar</option>
  <option <?php echo ($val==2)?'selected="selected"':'' ?> value="aso">Asociar</option>
</select>


<?php endif ?>