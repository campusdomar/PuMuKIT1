<fieldset style="padding: 5px; border: 1px solid #EEE">
<legend style="font-weight: bold">INFO</legend>

<div style="text-align: center; padding-bottom: 15px; background:transparent  url(<?php echo sfConfig::get('app_info_logo') ?>) no-repeat">
  <div><?php echo sfConfig::get('app_info_title') ?></div>
  <div style="font-weight: bold"><?php echo sfConfig::get('app_info_copyright') ?></div>
  <div><?php echo sfConfig::get('app_info_link') ?></div>
</div>

<h4 style="padding-bottom: 10px">N&uacute;mero de objetos:</h4>

<div id="total_filter_date">
  <div>
    <div id="pager_time" style="float:left;">
      <div style="float:left; margin:0em .5em; background:transparent url(/images/admin/pag/sliderbgleft.png) no-repeat scroll left center; height:18px;  width:333px; ">
        <div id="track_time" style="background-color : #aaa;  height : 18px; background:transparent url(/images/admin/pag/sliderbgright.png) no-repeat scroll right center; position: relative">
          <div id="handle_time_ini" style="display : none; background-color : #f00; width : 12px; height : 18px; cursor : move; background:transparent url(/images/admin/pag/sliderhandle.png) no-repeat scroll center; position: absolute"> </div>
          <div id="handle_time_end" style="display : none; background-color : #f00; width : 12px; height : 18px; cursor : move; background:transparent url(/images/admin/pag/sliderhandle.png) no-repeat scroll center; position: absolute;"> </div>
        </div>
      </div>
    </div>
  </div>
  
  <script language="javascript" type="text/javascript">
    //<![CDATA[
  
    var handles = ["handle_time_ini", "handle_time_end"];
    new Control.Slider(handles, "track_time",{
      range: $R(<?php echo $time_ini ?>, <?php echo $time_end ?>),
      values: $R(<?php echo $time_ini ?>, <?php echo $time_end ?>),
      sliderValue: [<?php echo $time_ini ?>, <?php echo $time_end ?>],
      restricted: true,
      onSlide: function(v){
        var date_ini = new Date((v[0] * 86400000));
        $("val_time_ini").innerHTML= ('01/' + (1 + date_ini.getMonth()) + '/' + (1900 + date_ini.getYear())); 
        var date_end = new Date((v[1] * 86400000));
        $("val_time_end").innerHTML= ('01/' + (1 + date_end.getMonth()) + '/' + (1900 + date_end.getYear())); 
      },
      onChange: function(v){
        new Ajax.Updater("info_total_div", "<?php echo url_for("dashboard/total")?>/ini/" + v[0] + "/end/" + v[1]);
        
      }
    });
  
    $("handle_time_ini").show();    <?php  //evito efecto de empezar en cero y ponerse en su posicion ?>
    $("handle_time_end").show();    <?php  //evito efecto de empezar en cero y ponerse en su posicion ?>
    //]]>
  </script>
  
  <br />
  <div>
    <span style="font-weight: bold">Fecha Ini: </span><span id="val_time_ini"><?php echo date('d/m/Y', $time_ini * 86400)?></span> &nbsp;&nbsp;&nbsp;&nbsp;
    <span style="font-weight: bold">Fecha Fin: </span><span id="val_time_end"><?php echo date('d/m/Y', $time_end * 86400)?></span>
  </div>
  <br />
</div>


<!--
<div id="total_filter_status">
  <?php foreach(PubChannelPeer::doSelect(new Criteria()) as $s):?>
    <span>
      <input type="checkbox" value="<?php echo $s->getId() ?>" checked="checked" /> 
      <?php echo $s->getName() ?>
      &nbsp;&nbsp;&nbsp;&nbsp;
    </span>
  <?php endforeach ?>
</div>
-->
<br /><br />

<!--
<div style="float:right;">
  <a href="#<?php //echo url_for('dashboard/infopdf') ?>"  target="_blanck">
    <img src="/images/admin/icons/pdf.jpg" alt="Exportar extadisticas a PDF" style="width: 25px;"/>
    <br />
    Exportar  
    <br />
    estad&iacute;sticas.
  </a>
</div>
-->


<div id="info_total_div" style="font-size: 120%; text-align: center">
  <?php include_component('dashboard', 'totalinfo', array("ini" => $time_ini, "end" => $time_end, "pub_channel" => "all")) ?>
</div>


</fieldset>