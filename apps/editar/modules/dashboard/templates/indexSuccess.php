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



<?php echo javascript_tag("
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

})
");
?>

<br />
<br />
