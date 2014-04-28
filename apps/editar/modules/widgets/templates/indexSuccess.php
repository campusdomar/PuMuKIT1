<h3 class="cab_body_div"><img src="/images/admin/cab/widget_ico.png"/> <?php echo __('WebTV Layout')?></h3>


<div>
<table class="widget">
 <tbody>
  <tr>
   <td class="widget" colspan="2">
     <?php include_partial('widgets/list', array('name' => 'Headerbar', 'bar' => 1,  'widgets' => $bar_header, 'type' => 2));?>
   </td>
  </tr>

  <tr>
   <td class="widget">
    <?php include_partial('widgets/list', array('name' => 'IndexBody', 'bar' => 6, 'widgets' => $body_index, 'type' => 3));?>
   </td>
   <td class="widget" width="33%">
    <?php include_partial('widgets/list', array('name' => 'BarBody', 'bar' => 5, 'widgets' => $bar_body, 'type' => 1));?>
   </td>
  </tr>

  <tr>
   <td class="widget" colspan="2">
    <?php include_partial('widgets/list', array('name' => 'Footerbar', 'bar' => 2, 'widgets' => $bar_footer, 'type' => 2));?>
   </td>
  </tr>
 </tbody>
</table>
</div>