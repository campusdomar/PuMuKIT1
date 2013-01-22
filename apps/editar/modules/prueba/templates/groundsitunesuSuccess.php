<?php foreach($sts as $a): ?>
  <h3 class="cab_body_div"><?php echo $a->getId()?>    <?php echo $a->getName()?></h3>

  <p>
Por cada serie que se inserta en iTunesU se muestra su titulo, descripcion, area, y lugares don fueron grabados sus objetos multimedia
  </p>

  <p>
En la lista de la izquiera se muestran la catalogacion marcada y en la de la derecha la posible. Se quitan o insertan con <span style="font-size: 140%">doble click</span> en el elemento.
  </p>


<div style="width: 80%; border: 1px solid #000; padding: 15px; ">


<?php
$c = new Criteria();
$c->add(SerialPeer::PUBLICDATE, "2008-01-01", Criteria::GREATER_EQUAL);
$c->add(SerialPeer::SERIAL_TYPE_ID, $a->getId());
SerialPeer::addBroadcastCriteria($c, array('pub'));
SerialPeer::addPublicCriteria($c, 2);

$serials = SerialPeer::doSelectWithI18n($c, 'es');
?>

  <?php foreach($serials as $s):      $pps = $s->getPlaces();?>
    <h1><?php echo $s->getTitle()?></h1>
    <h3><?php echo $s->getSubtitle()?></h3>
    <p>
    <?php echo $s->getDescription() ?>
    </p>
    <p>
      <span style="font-weight: bold">Area antigua: <?php echo $a->getName()?></span>
      <br />Lugares:
      <?php foreach($pps as $pp):?>
        <?php echo $pp->getName()?>, 
      <?php endforeach?>
      <br />Idiomas: 
      <?php foreach($s->getLanguages() as $l):?>
        <?php echo $l->getName()?>, 
      <?php endforeach?>
    </p>
    <p>
      <div id="ground3<?php echo $s->getId()?>_mms">
        <?php include_component('prueba', 'ground', array('serial' => $s))?>
      </div>
    </p>
    <hr />
  
  
  
  <?php endforeach?>
  </div>
<?php endforeach?>




<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />