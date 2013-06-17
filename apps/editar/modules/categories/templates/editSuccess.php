<?php use_helper('Object') ?>

<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_categories', 
  'url' => 'categories/update',
  'script' => 'true',
)) ?>

<?php echo object_input_hidden_tag($category, 'getId') ?>
<?php echo object_input_hidden_tag($category, 'isRoot') ?>
<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id ?>">

<fieldset>

<div class="form-row">
  <?php echo label_for('parent', 'Parent:', 'class="required" ') ?>
  <div class="content">
   <?php if($category->isRoot()): ?>
     Elemento es Root. 
   <?php else: ?>
     <?php echo $category->getParent()->getCod()?> - <?php echo $category->getParent()->getName()?>
   <?php endif ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('metacategory', 'Metacategory:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_checkbox_tag($category, 'getMetacategory', array ('control_name' => 'metacategory',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('display', 'Display:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_checkbox_tag($category, 'getDisplay', array ('control_name' => 'display',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('required', 'Required:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_checkbox_tag($category, 'getRequired', array ('control_name' => 'required',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('cod', 'Codigo:', 'class="required" ') ?>
  <div class="content">
  <?php $value = object_input_tag($category, 'getCod', array ('size' => 20,  'control_name' => 'cod',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('name', 'Nombre:', 'class="required" ') ?>
  <div class="content">
    <?php $sep =''; foreach ($langs as $lang): ?>
      <?php $category->setCulture($lang);  echo $sep ?>  
  
      <?php $value = object_input_tag($category, 'getName', array ('size' => 80,  'control_name' => 'name_' . $lang,
      )); echo $value ? $value.'<span class="lang">'.$lang.'</span>' : '&nbsp;' ?>
  
      <?php $sep='<br /><br />'?>
    <?php endforeach; ?>
  </div>
</div>


</fieldset>


<ul class="tv_admin_actions">
<li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
<li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  </ul>

</form>
</div>

