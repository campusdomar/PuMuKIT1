<div style="background-color: #000; width: 620px; height: 465px; margin: 10px 0px 20px;" id="preview">
  <?php echo __('Necesita instalar el Plugin de Flash')?>
</div>


<script type='text/javascript' src='/js/swfobject.js'></script>
<script type='text/javascript'>
  var s1 = new SWFObject('/swf/player.swf?autostart=false','player','620','465','9');
  s1.addParam('allowfullscreen','true');
  s1.addParam('allowscriptaccess','always');
  s1.addParam('flashvars','repeat=list&file=<?php echo $file->getUrl()?>');
  	<?php $captions = $mmobj->getCaptions();
	if ($captions != null):?>
		s1.addVariable('plugins', 'captions-2');
		s1.addVariable('captions.back', 'false'); <?php // Con true añade un rectángulo negro a los subtítulos ?>
		s1.addVariable('captions.file', <?php echo "'" . $captions->getUrl() . "'"?>);
	<?php endif?>
  s1.write('preview');
</script>
