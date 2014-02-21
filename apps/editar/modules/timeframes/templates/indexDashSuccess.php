<?php
$editorial1_color    = sfConfig::get('mod_timeframes_editorial1_color', '#00FF00');
$editorial2_color = sfConfig::get('mod_timeframes_editorial2_color', '#0000FF');
if (!isset($destacados)) $destacados = 'all';
function escogeOrigenXml($destacados){
  switch ($destacados){
    case 'tv':
      $ruta_xml = '@editorial1_timeline';
      break;
    case 'radio':
      $ruta_xml = '@editorial2_timeline';
      break;
    default:
      $ruta_xml = '@all_editorial_timeline';
      break;
  }
  return $ruta_xml;
} ?>
<h3 class="cab_body_div"><img src="/images/admin/cab/serial_ico.png"/><?php echo __(' Línea de tiempo - Decisiones editoriales temporizables')?></h3>


<div id="timeframes-dashboard-cabecera" style="overflow:hidden;">

  <div id="leyenda" style="float:left;">
      <div style="color:<?php echo $editorial1_color?>;width:100px; border-top: 3px solid;">Editorial1</div>
      <div style="color:<?php echo $editorial2_color?>;width:100px; border-top: 3px solid;">Editorial2</div>
      <?php //echo "DEBUG -  ". link_to('xml con la lista de eventos a mostrar', escogeOrigenXml($destacados), true);?>
  </div>
  <div id="timeframes-dashboard-select" style="float:left; padding:0 0 0 10px;">
     <form id="form-destacados" name="form-destacados" method="get" action="<?php echo url_for('timeframes/indexDash')?>">
      <div id = "select-destacados" style="width:150px; float:left;">
        <div style="font-weight:bold;">&nbsp;Editorial <span style="color:<?php echo $editorial1_color?>">1</span> / <span style="color:<?php echo $editorial2_color?>">2</span></div>
        <?php echo select_tag('destacados',
          options_for_select(
            array('all'   => __('Todos'),
                  'tv'    => __('Destacados TV'),
                  'radio' => __('Destacados Radio')),
            $sf_user->getAttribute('destacados', null, 'tv_admin/timeframes')), array('onchange' => 'Javascript:this.form.submit();')); ?>
      </div>
      <div id="contenedor-checkbox-destacados" style="float:left;">
        <div>&nbsp;</div>
        <div style="height:20px;float:left; ">
          <input type='hidden' value='0' name='incluye_fijas'><?php // para forzar que envíe 0 cuando el checkbox está inactivo?>
          <?php echo checkbox_tag('incluye_fijas', 1, $incluye_fijas==1,
          array('style' => 'margin:5px 3px;',
                'onchange' => "Javascript:this.form.submit();"));?>
        </div>
        <div style="float:left;font-weight:bold;margin-top:5px;"><?php echo __('Incluir')?> <span style="border-top: 3px solid #CFDEEA;"><?php echo __('decisiones editoriales fijas')?></span></div>    
      </div>
      <div id="contenedor-checkbox-publicados" style="float:left;">
        <div>&nbsp;</div>
        <div style="height:20px;float:left; ">
          <input type='hidden' value='0' name='incluye_en_proceso'><?php // para forzar que envíe 0 cuando el checkbox está inactivo?>
          <?php echo checkbox_tag('incluye_en_proceso', 1, $incluye_en_proceso==1,
          array('style' => 'margin:5px 3px 5px 20px;',
                'onchange' => "Javascript:this.form.submit();"));?>
        </div>
        <div style="float:left;font-weight:bold;margin-top:5px;"><?php echo __('Incluir piezas no publicadas o en proceso')?></div>    
      </div>
    </form>
  </div>
  <div style="margin:12px 0 0 48%;"><a href="javascript:centraTimeline();"><?php echo __('Centrar hoy')?></a></div>
</div>

<div style="text-align: center">
 
  <div id="my-timeline" style="height: 600px; border: 1px solid #aaa"></div>
  <br />
  <br />
  <noscript>
	<?php echo __('Esta página usa Javascript para mostrar una línea de tiempo. Active Javascript en su navegador para visualizar correctamente la página.')?>
  </noscript>
</div>
<script type="text/javascript">
  Timeline_ajax_url="/js/timeline_2.3.1/timeline_ajax/simile-ajax-api.js";
  Timeline_urlPrefix='/js/timeline_2.3.1/timeline_js/';
  Timeline_parameters='bundle=true';
</script>
<!--
<script src="/js/timeline_2.3.1/timeline_js/timeline-api.js" type="text/javascript">
</script>
-->
<script type="text/javascript">

var tl;
Event.observe(window, 'load', function() {
  var eventSource = new Timeline.DefaultEventSource();
  var bandInfos = [
    Timeline.createBandInfo({
      eventSource:    eventSource,
      timeZone:       1,
      width: '85%',
      intervalUnit:   Timeline.DateTime.DAY,
      intervalPixels: 80
    }),
    Timeline.createBandInfo({
      eventSource:    eventSource,
      timeZone:       1,
      overview: true,
      width: '15%',
      intervalUnit:   Timeline.DateTime.MONTH,
      intervalPixels: 200
    })
  ];  

  bandInfos[1].syncWith = 0;
  bandInfos[1].highlight = true;
 
  tl = Timeline.create(document.getElementById('my-timeline'), bandInfos);
  tl.loadXML('<?php echo url_for(escogeOrigenxml($destacados)) . "?incluye_fijas=".$incluye_fijas . "&incluye_en_proceso=".$incluye_en_proceso?>', function(xml, url) { eventSource.loadXML(xml, url); });

})
function centraTimeline() {
            tl.getBand(0).scrollToCenter(new Date());
        }
<?php  // Sobrecargo la función que pinta la burbuja ?>
var oldFillInfoBubble = Timeline.DefaultEventSource.Event.prototype.fillInfoBubble;
var weekday = new Array( __('Domingo'), __('Lunes'), __('Martes'), __('Miércoles'), __('Jueves'), __('Viernes'), __('Sábado'));
var monthname = new Array( __('Enero'), __('Febrero'), __('Marzo'), __('Abril'), __('Mayo'), __('Junio'), __('Julio'), echo __('Agosto') , __('Septiembre'), __('Octubre'), __('Noviembre'), __('Diciembre'));
Timeline.DefaultEventSource.Event.prototype.fillInfoBubble = function(elmt, theme, labeller) {
    var eventObject = this;
    if (eventObject._end != eventObject._earliestEnd && eventObject._start != eventObject._latestStart){
        var div_title = document.createElement("div");
        div_title.className = "timeline-event-bubble-title";
        var a_title = document.createElement("a");
        a_title.setAttribute('href', eventObject._link);
        a_title.innerHTML = eventObject._text;
        div_title.appendChild(a_title);
        var div_time = document.createElement("div");
        div_time.className = "timeline-event-bubble-time";
        div_time.innerText = "Decisión editorial permanente";
        elmt.appendChild(div_title);
        elmt.appendChild(div_time);
    } else {
        // oldFillInfoBubble.call(this, elmt, theme, labeller); // antigua función para crear el html de la burbuja
        var start = new Date(eventObject._start);
        var start_es = weekday[start.getDay()] + " " + start.getDate() + " de " + monthname[start.getMonth()] + " de " + start.getFullYear() + " " + start.toLocaleTimeString();
        var end = new Date(eventObject._end);
        var end_es = weekday[end.getDay()] + " " + end.getDate() + " de " + monthname[end.getMonth()] + " de " + end.getFullYear() + " " + end.toLocaleTimeString();
        var div_title = document.createElement("div");
        div_title.className = "timeline-event-bubble-title";
        var a_title = document.createElement("a");
        a_title.setAttribute('href', eventObject._link);
        a_title.innerHTML = eventObject._text;
        div_title.appendChild(a_title);
        var div_time = document.createElement("div");
        div_time.className = "timeline-event-bubble-time";
        div_time.innerText = start_es + "\n" + end_es;
        elmt.appendChild(div_title);
        elmt.appendChild(div_time);
    }
}
</script>
<br />