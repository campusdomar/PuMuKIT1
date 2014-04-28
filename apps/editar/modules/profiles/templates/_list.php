<table cellspacing="0" class="tv_admin_list">
  <thead>
    <tr>
      <th width="1%">
        <input type="checkbox" onclick="window.click_checkbox_all('profile', this.checked)">
      </th>
      <th colspan="4" width="5%"></th>
      <th width="1%"><?php echo __('Id')?></th>
      <th><?php echo __('Nombre')?></th>
      <th width="1%"><?php echo __('Display')?></th>
      <th width="1%"><?php echo __('Wizard')?></th>
      <th width="1%"><?php echo __('Master')?></th>
      <th><?php echo __('CanalPub')?></th>
      <th><?php echo __('Extensión')?></th>
      <th><?php echo __('MIME type')?></th>
      <th><?php echo __('Servidor')?></th>
      <th><?php echo __('Archivos')?></th>
    </tr>
  </thead>
  
  <tbody>
  <?php if (count($profiles) == 0):?>
    <tr>
      <td colspan="15">
       <?php echo __('No existen perfiles con esos valores.')?>
      </td>
    </tr>
  <?php endif; ?>
  <?php $t = count($profiles) ; for( $i=0; $i<$t; $i++): $profile = $profiles[$i]; $odd = fmod($i, 2) ?>
    <tr onmouseover="Element.addClassName(this,'tv_admin_row_over')" onmouseout="Element.removeClassName(this,'tv_admin_row_over')" class="tv_admin_row_<?php echo $odd ?><?php if($profile->getId() == $sf_user->getAttribute('id', null, 'tv_admin/profile')) echo ' tv_admin_row_this'?>" >
      <td>
        <input id="<?php echo $profile->getId()?>" class="profile_checkbox" type="checkbox">
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo m_link_to(image_tag('admin/mbuttons/edit_inline.gif', 'alt=' . __('editar') . ' title=' . __('editar')), 'profiles/edit?id=' . $profile->getId(), array('title' => __('Editar perfil "').$profile->getName() . '"'), array('width' => '800')) ?>
      </td>
      <!-- <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/delete_inline.gif', 'alt=' . __('borrar') . ' title=' . __('borrar')), array('update' => 'list_profiles', 'url' => 'profiles/delete?id='.$profile->getId(), 'script' => 'true', 'confirm' => __('&iquest;Seguro que desea borrar el perfil? (No se puede si tiene archivos asociados)')))?> 
      </td> -->
      <td>
        <?php echo link_to_remote(image_tag('admin/mbuttons/copy_inline.gif', 'alt=' . __('copiar') . ' title=' . __('copiar')), array('update' => 'list_profiles', 'url' => 'profiles/copy?id='.$profile->getId(), 'script' => 'true'))?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo ((($page == 1)&&( $i == 0)) ? '&nbsp;' : (link_to_remote('&#8593;', array('update' => 'list_profiles', 'url' => 'profiles/up?id='.$profile->getId(), 'script' => 'true'))).(link_to_remote('&#8657;', array('update' => 'list_profiles', 'url' => 'profiles/top?id='.$profile->getId(), 'script' => 'true'))))   ?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo ((($page == $total)&&( $i == $t-1))? '&nbsp;' : (link_to_remote('&#8595;', array('update' => 'list_profiles', 'url' => 'profiles/down?id='.$profile->getId(), 'script' => 'true'))).(link_to_remote('&#8659;', array('update' => 'list_profiles', 'url' => 'profiles/bottom?id='.$profile->getId(), 'script' => 'true')))) ?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->getId() ?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->getName(); ?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->getDisplay()?"x":""?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->getWizard()?"x":""?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->getMaster()?"x":""?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <div>
          <span style="font-weight:bold">4:3</span>
          <?php foreach($profile->getPubChannelPerfilsRelatedByPerfil43Id() as $relObj): ?>
            <?php echo $relObj->getPubChannel()->getName();?>
          <?php endforeach?>
        </div>
        <div>
          <span style="font-weight:bold">16:9</span>
          <?php foreach($profile->getPubChannelPerfilsRelatedByPerfil169Id() as $relObj): ?>
            <?php echo $relObj->getPubChannel()->getName();?>
          <?php endforeach?>
        </div>
          <span style="font-weight:bold"><?php echo __('Audio')?></span>
          <?php foreach($profile->getPubChannelPerfilsRelatedByPerfilAudioId() as $relObj): ?>
            <?php echo $relObj->getPubChannel()->getName();?>
          <?php endforeach?>
        </div>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->getExtension() ?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->getMimeType() ?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->getStreamserver()->getName() ?>
      </td>
      <td onclick="click_fila('profile', this, <?php echo $profile->getId() ?>);">
        <?php echo $profile->countFiles() ?>
      </td>
    </tr>
  <?php endfor; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="15">
        <div class="float-right">
          <?php include_partial('global/pager_ajax', array('name' => 'profile', 'page' => $page, 'total' => $total)) ?> 
        </div>
        <?php echo $total_profile ?>/<?php echo $total_profile_all ?> <?php echo __('perfiles')?>
      </th>
    </tr>
  </tfoot>
</table>


<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>