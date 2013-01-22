<div id="directo_info" >
  <table id="directo_announces">		
    <thead>
      <tr> 
        <td valign="top" colspan="2">
          <?php echo __('Pr&oacute;xima transmisi&oacute;n en directo') ?>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr class="impar"> 
        <td width="25%" valign="top">
          <div align="right">E<font size="1">VENTO</font><br/></div>
        </td>
        <td width="75%"><div align="center">
          <strong><?php echo $event->getName() ?></strong></div>
        </td>
      </tr>
      <tr class="par">
        <td width="22%" valign="top">
          <div align="right">L<font size="1">UGAR</font></div>
        </td>
        <td width="78%"><div align="center">
          <strong><?php  echo $event->getPlace()?></strong></div>
        </td>
      </tr>
      <tr class="impar"> 
        <td valign="top"> 
          <div align="right">D<font size="1">ATA</font></div>
        </td>
        <td>
          <div align="center"><strong><font color="#000066"><?php echo $event->getDate('d/m/Y') ?></font></strong></div>
        </td>
      </tr>
      <tr class="par"> 
        <td valign="top"> 
          <div align="right">H<font size="1">ORA</font></div>
        </td>
        <td>
          <div align="center"><strong><font color="#000066"><?php echo $event->getDate('H:i') ?></font></strong></div>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr> 
        <td valign="top" colspan="2">
  <?php echo __('La emisi&oacute;n es en diferido, excepto durante la transmisi&oacute;n anunciada') ?>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

</div>

<br />
<br />
<br />
