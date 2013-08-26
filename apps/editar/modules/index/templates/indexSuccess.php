<div id="noResolution" style="text-align: center; display: none;">
   Su resolución es inferior a la mínima recomendada 1440 x 900. <br />
   <span style="font-size: 66%">( La resolución óptima recomendada es 1920 x 1080 ). </span>
</div>

<div id="div_login">
  
  <?php echo form_remote_tag(array(
  				 'update' => 'js',      
  				 'url' => 'index/login',
  				 'script' => 'true',
  				 )) ?>
    
    <?php echo label_for('login', 'Login:', 'class="required" ') ?>
    <div id="input_login">
      <?php echo input_tag('login')?>
    </div>
    
    <br />
    
    <?php echo label_for('passwd', 'Passwd:', 'class="required" ') ?>
    <div id="input_login">
      <?php echo input_password_tag('passwd')?>
    </div>
    
    <br />
    <div style="float:left; font-weight: bold; ">
      <?php echo sfConfig::get('app_metas_title')?>
    </div>
    <br />
    
    <div id="ok_login">
      <?php if($sf_request->getParameter('error') == 2):?>
        <span id="noSession" class="error" style="float:left; ">Sesi&oacute;n expirada&nbsp;</span>
      <?php endif ?>
      <span id="noEstandar" class="error" style="display:none; float:left; ">No compatible con IE</span>
      <span id="noUser" class="error" style="display:none; float:left; ">ERROR de LOGIN</span>
      <?php echo submit_tag('OK', 'class=ok')?>
    </div>
  
    <?php if(isset($url)) echo input_hidden_tag('url', substr(strtr($url, ' ', '/'), 1)) ?>  
  </from>
  </div>
  
  
  <?php echo javascript_tag("
    $('login').focus();
    if(/*@cc_on!@*/false) $('noEstandar').show();
    if (screen.width < 1440 ) $('noResolution').show();
  ") ?>
  
<div id="js"></div>
