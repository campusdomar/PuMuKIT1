<?php use_helper('Object') ?>

<div id="tv_admin_container" style="">


<h3 style="font-variant: small-caps">
  <?php echo $vground->getName()?> 
</h3>

<br />

<form method="post" enctype="multipart/form-data" target="iframeUpload" action="<?php echo url_for('virtualgrounds/update')?>">
<iframe name="iframeUpload" style="display:none" src=""></iframe>

<?php echo object_input_hidden_tag($vground, 'getId') ?>

<fieldset >

<div class="form-row">
  <?php echo label_for('cod', 'Nombre:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($vground, 'getCod', array ('size' => 13,  'control_name' => 'cod',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('name' , 'Rótulo:', 'class="required" ') ?>
  <?php $sep =''; foreach (sfConfig::get('app_lang_array', array('es')) as $lang): ?>
    <?php $vground->setCulture($lang);  echo $sep ?>  
  
    <div class="content">
      <?php $value = object_input_tag($vground, 'getName', array ('size' => 33,  'control_name' => 'name_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
    </div>
  
    <?php $sep='<br />'?>
  <?php endforeach; ?>
</div>


<div class="form-row">
  <?php echo label_for('description', 'Descripci&oacute;n:', 'class="required"') ?>
  <div class="content">
    <?php $value = object_textarea_tag($vground, 'getDescription', array (
      'size' => '80x3',
      'control_name' => 'description_' . $lang,
    )); echo $value ? $value:'&nbsp;' ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('decision' , 'Categorias:', 'class="required" ') ?>
  <div class="content">
    <input type="radio" name="decision" value="editorial1" <?php echo ($vground->getEditorial1()?'checked="checked"':'')?> />
    &nbsp; Decisi&oacute;n Editorial 1
   </div>
 
   <div class="content">
    <input type="radio" name="decision" value="editorial2" <?php echo ($vground->getEditorial2()?'checked="checked"':'')?> />
    &nbsp; Decisi&oacute;n Editorial 2
   </div>
 
   <?php /* foreach(GroundTypePeer::doSelect(new Criteria) as $gt):?>
   <div class="content">
     <input type="radio" name="decision" value="<?php echo $gt->getId()?>" 
            <?php echo (($vground->getGroundTypeId() == $gt->getId())?'checked="checked"':'')?> />
     &nbsp; <?php echo $gt->getName() ?>
       <?php echo m_link_to('configurar', 'virtualgrounds/editground?type=' . $gt->getId() . '&id=' . $vground->getId(), 
       array('title' => 'Configurar Categoria ' . $vground->getName()), array('width' => '800')) ?></td>
   </div>
   <?php endforeach */?>

   <div class="content">
     <input type="radio" name="decision" value="other" <?php echo ($vground->getOther()?'checked="checked"':'')?> />
     &nbsp; Categorías (Unesco, lugares...) 
       <?php echo m_link_to('configurar', 'virtualgrounds/editcategories?vg_id='. $vground->getId(), 
       array('title' => 'Configurar Categoria ' . $vground->getName()), 
       array('width' => '1200'),
       array('evalScripts' => 'true')) ?></td>
   </div>
</div>


<div class="form-row">
  <?php echo label_for('img' , 'Imagen:', 'class="required" ') ?>
    <div class="content">
      <div>
        <img id="ground_img_<?php echo $vground->getId()?>"  src="<?php echo $vground->getImg()?>" alt="No tiene imagen."/>
      </div>
      
      <input type="file" name="ground_imagen" />
    </div>
</div>

</fieldset>


<ul class="tv_admin_actions">
  <span id="info_msg_vground_<?php echo $vground->getId()?>"></span>
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save'); ?></li>
  <li><?php echo reset_tag('Cancel','class=tv_admin_action_delete') ?> </li>
</ul>

</form>
</div>


<br /><br /><br /><br /><br /><br />