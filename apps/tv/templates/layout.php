<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

  <?php include_http_metas() ?>
  <?php include_metas() ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  
  <?php include_title() ?>
  
  <link rel="shortcut icon" href="/favicon.ico" />
  
</head>
<body>
  <div id="content" class="container_15">
    <div id="headerbar">
      <?php include_component('utils', 'bar', array('bar' => 'Headerbar')) ?>
      <?php //include_partial('global/cab_menu')?>
    </div><!--fin div headerbar-->
    
    <div id="body">  
      <div id="slidebar" class="grid_3">  
        <?php include_component('utils', 'bar', array('bar' => 'Slidebar')) ?>
      </div>
    
      <div id="other_body" class="grid_12">
        <?php echo $sf_data->getRaw('sf_content') ?>
      </div>
  
      <div style="clear:both"></div>
    </div>
    
    <div id="footerbar">
      <?php include_component('utils', 'bar', array('bar' => 'Footerbar')) ?>
    </div>  
  </div>
  <?php include_partial('global/googleanalytics')?>
</body>
</html>
