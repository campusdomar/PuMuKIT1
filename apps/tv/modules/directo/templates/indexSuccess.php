<h1><?php echo $canal->getName(); ?></h1>  

<div id="directbackground"  style="text-align: center">

<p id="directdescription">
  <?php echo $sf_data->getRaw('canal')->getDescription(); ?>
</p>


  <?php     
    switch ($canal->getDirectType()) {
     case 'WMS':
       include_partial('asx', array('canal' => $canal));
       break;
     case 'FMS':
       include_partial('flv', array('canal' => $canal));
       break;
     default:
       echo $canal->getUrl();
       break;
    }
  ?>



</div>



<?php 
$event = $canal->getEventFuture();
if ($event !== null) {
  include_partial('next', array('event' => $event));
}
?>
