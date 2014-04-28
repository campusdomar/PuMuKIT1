<?php foreach($grounds as $ground): ?>
<div>

    <select name="type" 
            id="select_virtual_to_<?php echo $ground->getId() ?>" 
            onchange="new Ajax.Request('<?php echo url_for("virtualgrounds/updaterelation")?>', {
                                    parameters: 'ground=<?php echo $ground->getId() ?>&amp;category=' + this.value + '&amp;type=' +  $('type').value
                                  })">
       <option value="0" <?php echo (null == $ground->getVirtualGroundId())?" selected=\"selected\" ":""?> >
         <?php echo __('Sin Seleccionar')?>
       </option>        
       <?php foreach(VirtualGroundPeer::doSelect(new Criteria()) as $category):?>
         <option value="<?php echo $category->getId() ?>" <?php echo ($category->getId() == $ground->getVirtualGroundId())?" selected=\"selected\" ":""?> >
           <?php echo $category->getName() ?>
         </option>        
       <?php endforeach?>

    </select>    
    <?php echo $ground->getName() ?>

</div>


<?php endforeach ?>
