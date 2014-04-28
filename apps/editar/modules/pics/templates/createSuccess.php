<?php
$ver_siguiente = (($page == 1)? array('style' => 'display : none'): 
		  array('class' => 'tv_admin_action_next', 'style' => 'color : blue; font-weight : normal ', 'title' => __('Nueva Imagen')) );
$ver_anterior = (($page == $total)||($total == 0)? array('style' => 'display : none'): 
		 array('class' => 'tv_admin_action_previous', 'style' => 'color : blue; font-weight : normal ', 'title' => __('Nueva Imagen')) );
?>



<div id="tv_admin_container" style="width:100%">
  <?php echo form_remote_tag(array( 
    'update' => 'pic_'.$que.'s', 
    'url' => 'pics/update',
    'script' => 'true',
    'success' => 'Modalbox.hide()',
  )) ?>
    <?php echo input_hidden_tag('type', 'url') ?>
    <?php echo input_hidden_tag($que, $object_id) ?>

    <fieldset>
      <div class="form-row">
        <?php echo label_for('url', __('Escribir la URL:'), '') ?>
        <div class="content">
          <?php echo input_tag('url', '' ,'size=65') ?>
          <span id="error_url" style="display:none" class="error"><?php echo __('Formato URL no v&aacute;lido')?></span>
        </div>
      </div>
    </fieldset>

    <ul class="tv_admin_actions">
      <li>
        <?php echo submit_tag(__('Guardar'), array ('name' => 'add', 'class' => 'tv_admin_action_save', 'onclick' => 'return comprobar_form_url($("url").value)')) ?>
      </li>
    </ul>

  </form>
</div>
<div style="clear:both"></div>




<div id="tv_admin_container" style="width:100%">

  <form method="post" enctype="multipart/form-data" target="iframeUpload" action="<?php echo url_for('pics/upload')?>">

    <?php echo input_hidden_tag('type', 'url') ?>
    <?php echo input_hidden_tag($que, $object_id) ?>


    <fieldset>
      <div class="form-row">
        <?php echo label_for('file', __('A&ntilde;adir un archivo:'), '') ?>
        <div class="content">
          <?php echo input_file_tag('file', 'size=66') ?>
        </div>
      </div>
      <iframe name="iframeUpload" style="display:none" src=""></iframe>
    </fieldset>


    <ul class="tv_admin_actions">
      <li>
        <?php echo submit_tag(__('A&ntilde;adir'), array ('name' => 'add', 'class' => 'tv_admin_action_filenew', 'onclick' => "if($('file').value=='') { alert(__('Selecciona un archivo primero, Gracias'));return false; }")) ?>
      </li>
    </ul>

    </form>
  </div>

<div style="clear:both"></div>

<div id="tv_admin_container" style="width:100%">

    <fieldset>
      <div class="form-row">
        <?php echo label_for('other', __('Usar Imagen:'), '') ?>
        <div class="content">
          <?php if (count($pics) == 0):?>
            <?php echo __('No hay imágenes en la base de datos.')?>
          <?php endif ?>
          <?php foreach($pics as $pic):?>

	    <div style="padding: 18px; float:left">
              <div class="wrap0">
               <div class="wrap1">
                <div class="wrap2">
                 <div class="wrap3">
                   <?php echo link_to_remote(image_tag( $pic->getUrl() , 'size=100x82'), array('success' => 'Modalbox.hide()', 'update' => 'pic_'.$que.'s', 'url' => 'pics/update?type=pic&id='.$pic->getId().'&'.$que.'=' . $object_id, 'script' => 'true' ) ) ?>
                 </div>
                </div>
               </div>
              </div>
            </div>

          <?php endforeach;?>

        <div style="clear: left"></div>
        </div>
      </div>
    </fieldset>

<ul class="tv_admin_actions">
  <li>
    <?php echo m_link_to(__('Anterior'), 'pics/create?'.$que.'=' . $object_id. '&page='. ($page + 1), $ver_anterior, array('width' => '800'))?>
  </li>
  <li>
    <?php echo m_link_to(__('Siguiente'), 'pics/create?'.$que.'=' . $object_id. '&page='. ($page - 1), $ver_siguiente, array('width' => '800'))?>
  </li>
  <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul>

</div>


