<?php use_helper('Object') ?>

<!-- classic -->
<?php
  echo select_tag('grounds'.$serial->getId().'_sel_select', 
		  objects_for_select($grounds_sel->getRawValue(), 'getId', 'getName'), 
		  array('size' => 20, 
			'style' => 'width:400px; height: 160px',
			'ondblclick' => "if(this.value != '') new Ajax.Updater('ground3". $serial->getId()."_mms', 
                                                          '/editar_dev.php/prueba/deleteground/ground/' + this.value +'/id/".$serial->getId()."' , 
                                                          {asynchronous:true, evalScripts:true});"
			)
		  );
?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php
  echo select_tag('grounds'.$serial->getId().'_select', 
		  objects_for_select($grounds->getRawValue(), 'getId', 'getName'), 
		  array('size' => 20, 
			'style' => 'width:500px; height: 160px',
			'ondblclick' => "if(this.value != '') new Ajax.Updater('ground3". $serial->getId() ."_mms', 
                                                          '/editar_dev.php/prueba/addground/ground/' + this.value +'/id/".$serial->getId()."', 
                                                          {asynchronous:true, evalScripts:true});"
			)
		  );
?>
