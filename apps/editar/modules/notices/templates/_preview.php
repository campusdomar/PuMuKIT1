<!-- Vista previa -->
<?php if( isset($notice) ):?>
<div>
  <p style="text-align:center; font-weight: bolder; font-size: large;">
    <?php echo $notice->getDate('d/m/Y')?>
  </p>
  
  <p style="overflow:hidden; padding:5px; border:solid 1px #DDD; background:<?php echo ($notice->getWorking() ? '#FFEAD6' : '#DDD') ?>" >
    <?php echo $sf_data->getRaw('notice')->getText()?>
  </p>
</div>

<?php else:?>
<p>
  Selecione alguna noticia.
</p>
<?php endif?>  
