<h3 class="cab_body_div"><img src="/images/admin/cab/serial_ico.png"/> Dashboard</h3>

<div style="text-align: center">
  <div id="my-timeline" style="height: 150px; border: 1px solid #aaa"></div>
  <br />
  <br />
  <noscript>
  This page uses Javascript to show you a Timeline. Please enable Javascript in your browser to see the full page. Thank you.
  </noscript>

  <?php foreach($blocks as $block): ?>
  <div class="dashboard_element">
    <?php include_component('dashboard', $block)?>
  </div>
  <?php endforeach ?>
</div>

<script type="text/javascript">


Event.observe(window, 'load', function() { 
  var eventSource = new Timeline.DefaultEventSource();
  var bandInfos = [
    Timeline.createBandInfo({
      eventSource:    eventSource,
      width: '70%',
      intervalUnit:   Timeline.DateTime.DAY, 
      intervalPixels: 100
    }),
    Timeline.createBandInfo({
      eventSource:    eventSource,
      overview: true,
      width: '30%',
      intervalUnit:   Timeline.DateTime.MONTH, 
      intervalPixels: 200
    })
  ];  

  bandInfos[1].syncWith = 0;
  bandInfos[1].highlight = true;
 
  tl = Timeline.create(document.getElementById('my-timeline'), bandInfos);
  Timeline.loadXML('/editar.php/dashboard/serial_timeline.xml', function(xml, url) { eventSource.loadXML(xml, url); });

});

<?php  // Sobrecargo la función que pinta la burbuja y sólo pinto el título y la fecha traducida al español ?>
var oldFillInfoBubble = Timeline.DefaultEventSource.Event.prototype.fillInfoBubble;
var weekday = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var monthname = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
Timeline.DefaultEventSource.Event.prototype.fillInfoBubble = function(elmt, theme, labeller) {
    var eventObject = this;
    
    // oldFillInfoBubble.call(this, elmt, theme, labeller); // antigua función para crear el html de la burbuja
    var start = new Date(eventObject._start);
    var start_es = weekday[start.getDay()] + " " + start.getDate() + " de " + monthname[start.getMonth()] + " de " + start.getFullYear() + " " + start.toLocaleTimeString();
    var div_title = document.createElement("div");
    div_title.className = "timeline-event-bubble-title";
    var a_title = document.createElement("a");
    a_title.setAttribute('href', eventObject._link);
    a_title.innerHTML = eventObject._text;
    div_title.appendChild(a_title);
    var div_time = document.createElement("div");
    div_time.className = "timeline-event-bubble-time";
    div_time.innerText = start_es;
    elmt.appendChild(div_title);
    elmt.appendChild(div_time);
}
</script>
<br />
<br />
