<?php if( isset($serial) ):?>


<!--------------------->

  <table style="width:100%">
   <tbody>
   <tr> 
    <td style="background-color:transparent" height="53" valign="top" width="15%">
      <img src="<?php echo $serial->getFirstUrlPic()?>" style="border:3px solid #000000;" height="51" width="60" />
    </td>

    <td style="background-color:transparent" valign="top" width="85%">

    <!-- TITLE -->
      <div style="padding-left:5px">
        <a href="#"><?php echo $serial->getTitle()?></a> <br />
    <!-- LINE2 (PLACE) -->
        <strong><?php echo $sf_data->getRaw('serial')->getLine2Rich()?></strong><br />
    <!-- DATE -->
        <span style="color:#990000"><strong><?php echo $serial->getPublicDate('d/m/Y')?> </strong></span>
      </div>
    </td>
   </tr>
   </tbody>
  </table>


<!--------------------->




<?php else:?>
<p>
<?php __('Selecione alguna serie.')?>
</p>
<?php endif?>  