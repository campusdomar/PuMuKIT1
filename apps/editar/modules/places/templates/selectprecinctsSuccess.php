<?php use_helper('Object');?>

<?php echo select_tag('precinct_id',
  objects_for_select( $place->getPrecincts(), 'getId', 'getName' , null)
)?>