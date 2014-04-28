<div>
  <div id="tv_admin_container" style="width:100%">
    <fieldset>
      <div class="form-row">
        <?php echo label_for('info', __('Info:'), 'object') ?>
        <div class="content" id="info_sendmail_object">
          <?php if( $object->getMail() ):?>
            <?php echo __('Ya anunciado en la lista de correo.')?>
          <?php else:?>
            <?php echo __('No anunciado en la lista de correo.')?>
          <?php endif ?>
          <?php echo $emails?>
        </div>
      </div>
    </fieldset>
  </div>

  <div id="tv_admin_container" style="width:100%">

    <fieldset style="border:5px solid #DDD;">
      <div class="form-row">
        <?php echo label_for('other', __('Vista Previa:'), '') ?>
        <div class="content">

          <?php include('sendMailSuccess.php')?>

        </div>
      </div>
    </fieldset>
  </div>

  <div id="tv_admin_container" style="width:100%">

    <?php echo form_remote_tag(array(
      'update' => 'info_sendmail_object',
      'script' => 'true',
      'url'    => 'emails/announceMail?' . $object->getTableName() . '=' . $object->getId(),
    )) ?>


    <?php echo input_hidden_tag('id', $object->getId() ) ?>

    <fieldset>
      <div class="form-row" >
        <?php echo label_for('to', __('Destinatario:'), '') ?>
        <div class="content">
          <?php echo input_tag('to', $to, 'size=99') ?>
          <?php echo reset_tag(__('Reset'), 'name=reset') ?>
        </div>
      </div>

      <div class="form-row" >
        <?php echo label_for('culture', __('Idioma:'), '') ?>
        <div class="content">
       
          <select name="culture" id="culture">
            <option value="es" selected="selected"><?php echo __('Espa&ntilde;ol')?></option>
            <option value="gl"><?php echo __('Gallego')?></option>
            <option value="en"><?php echo __('Inglés')?></option>
          </select>


        </div>
      </div>
    </fieldset>

    <ul class="tv_admin_actions">
      <li><?php echo submit_tag(__('Enviar'), array( 'name' => 'OK', 'class' => 'tv_admin_action_mail', 'confirm' => __('seguro de enviar el correo?') . ($object->getMail()?__('(Ya enviado antes a la lista)'):'') )) ?></li>
      <li><?php echo button_to_function(__('Cancel'), "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
    </ul> 

    </form>
  </div>
</div>
