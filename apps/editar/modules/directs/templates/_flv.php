<div style="width:100%; margin:0 auto; text-align:center" style="color:red" id="preview">Necesita instalar el Plugin de Flash</div>

<script type='text/javascript'>
  var s1 = new SWFObject('/swf/player.swf?autostart=true','player','<?php echo $hor?>','<?php echo $ver?>','9');
  s1.addParam('allowfullscreen','true');
  s1.addParam('allowscriptaccess','always');
  s1.addParam('flashvars','repeat=list&file=<?php echo $url?>');
  s1.write('preview');
</script>