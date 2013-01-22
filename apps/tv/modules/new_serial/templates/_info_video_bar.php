<div class="title"; >
  <?php echo ($mm->getTitle() == ""?"&nbsp;":$mm->getTitle())?>
</div>

<div style="overflow: hidden">
<div style="float:left">
<?php echo $mm->getPublicdate("d/m/Y")?>
</div>
<div style="float:right">
Visto <?php echo $mm->getFirstFile()->getNumView()?> veces
</div>
</div>

<div style="text-align:right; margin: 5px 0px;">
  <div style="float:left; padding-top: 4px;">URL:</div>
  <input value="<?php echo $mm->getUrl(true)?>" style="width:85%" onclick="this.select()" readonly="readonly"/>
</div>

<div style="text-align:right">
  <div style="float:left; padding-top: 4px;">EMBED:</div>
  <input value="<?php echo $mm->getUrl(true)?>" style="width:85%" onclick="this.select()" readonly="readonly"/>
</div>

<div style="text-align:center">
<a href="#" onclick="new Ajax.Updater('row_left', '<?php echo url_for('new_serial/info?id='.$mm->getId()) ?>'); ">PLAY</a>
</div>



