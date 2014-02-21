<fieldset style="padding: 5px; border: 1px solid #EEE">
<legend style="font-weight: bold"><?php echo __('&Uacute;LTIMAS SERIES CREADAS')?></legend>

<ul style="margin-left: 15px;">
<?php foreach($serials as $s):?>
  <li>
    <a href="<?php echo url_for('mms/index?serial=' . $s->getId()) ?>"><?php echo $s->getTitle()?></a>
    (<?php echo $s->getPublicdate('d/m/Y')?>)
  </li>
<?php endforeach?>
</ul>

</fieldset>