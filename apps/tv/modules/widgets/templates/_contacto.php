<h2><?php echo __('Contacto') ?></h2>

<div id="contacto">
  <?php echo (strlen($mail) ==0)?'':mail_to($mail, _encodeText($mail), 'encode=true') ?><br/>
  Tlf: <?php echo $telefono; ?><br/>
  <?php echo (strlen($info) ==0)?'':link_to(($sf_params->get('temp')==$info)?'<strong>[+Info]</strong>':'[+Info]', 'templates/index?temp=' . $info) ?>
</div>