<div class="cab_pan">

 <ul id="tvpumukites_pan">
  <li>
    <a href="<?php echo url_for('index/index')?>" 
       <?php echo (sfConfig::has("pan_nivel_1")) ? 'class="select"' : ''?> >
      <?php echo __("Inicio")?>
    </a>
  </li>

  <?php if($sf_user->getAttribute('nivel2_name') !== null):?>
  <li>
     &nbsp;»&nbsp; 
     <a href="<?php echo url_for($sf_user->getAttribute('nivel2_url'))?>" 
        <?php echo (sfConfig::has("pan_nivel_2")) ? 'class="select"' : ''?> >
       <?php echo $sf_user->getAttribute('nivel2_name')?>
     </a>
  </li>
  <?php endif;?>

  <?php if($sf_user->getAttribute('nivel3_name') !== null):?>
  <li>
     &nbsp;»&nbsp; 
     <a id="tvpumukites_pan_serial_a" href="<?php echo url_for($sf_user->getAttribute('nivel3_url'))?>" 
        <?php echo (sfConfig::has("pan_nivel_3")) ? 'class="select"' : ''?> >
       <?php echo $sf_user->getAttribute('nivel3_name')?>
     </a>
  </li>
  <?php endif;?>

  <?php if($sf_user->getAttribute('nivel4_name') !== null):?>
  <li id="tvpumukites_pan_mmobj">
     &nbsp;»&nbsp; 
     <a id="tvpumukites_pan_mmobj_a" href="<?php echo url_for($sf_user->getAttribute('nivel4_url'))?>" 
        <?php echo (sfConfig::has("pan_nivel_4")) ? 'class="select"' : ''?> >
       <?php echo $sf_user->getAttribute('nivel4_name')?>
     </a>
  </li>



<script type="text/javascript">
 //<![CDATA[
    var pan_mmobj = $('tvpumukites_pan_mmobj');
    var pan_serial = $('tvpumukites_pan_serial_a');
    var pan_mmobja = $('tvpumukites_pan_mmobj_a');
    if((pan_mmobj != null) &&(pan_serial != null)){
      var izq = ($('content').cumulativeOffset()[0]);
      var tamano = ( pan_mmobj.cumulativeOffset()[0] + pan_mmobj.offsetWidth - izq);
      while( tamano > 920){
      
        if(pan_serial.innerHTML.strip().length > 20){
          pan_serial.update(pan_serial.innerHTML.truncate(pan_serial.innerHTML.strip().length -1 ));
        }else{
          pan_mmobja.update(pan_mmobja.innerHTML.truncate(pan_mmobja.innerHTML.strip().length -1 ));
        }
        var tamano = ( pan_mmobj.cumulativeOffset()[0] + pan_mmobj.offsetWidth - izq);
      }
    }
 //]]>
</script>


  <?php endif;?>

 </ul>
</div>