<!-- cabezera -->
<div id="editar_cab">  
  <div id="ah_img">
    <img style="width:280px; padding-left:5%" src="/images/admin/cab/pumukitDer.png" />
  </div>
  <div id="ah_status" style="">
    <b><?php echo $sf_user->getAttribute('login')?> </b>
    (<?php $aux = array(0 => "Administrador",1 => "Publicador",2 => "FTP"); echo $aux[$sf_user->getAttribute('user_type_id')] ?>) | 
    <?php echo date('d-m-y')?> | 
    <?php echo link_to('logout', 'index/logout') ?> |

<?php if($sf_user->getCulture() == 'es'):?>
<?php echo __('Espa&ntildeol')?>
<?php else:?>
<a href="<?php echo url_for('utils/culture?culture=es') ?>"><?php echo __('Espa&ntildeol')?>
</a>
<?php endif?>

<?php if($sf_user->getCulture() == 'en'):?>
<?php echo __('Ingl&eacutes')?>
<?php else:?>
<a href="<?php echo url_for('utils/culture?culture=en') ?>"><?php echo __('Ingl&eacutes')?></a>
<?php endif?>


  </div>  
  <div style="position:absolute; right: 10px; top : 25px; color: #fff; font-weight: bold">
    <?php echo sfConfig::get('app_metas_title')?>
  </div>
</div>



<!-- menu -->
<div id="editar_menu">

  <div class="cab_up_down" style="float:right; font-weight:bolder; font-size: 22px; max-width:1100px;">
    <div style="" 
       href="#" onclick="this.toggleClassName('inv'); Effect.toggle('editar_cab', 'blind'); return false">&nbsp;&nbsp;</div>
  </div>

  <ul id="nav">
    <li class="level0 <?php echo sfConfig::get('dashboard_menu') ?>">
      <a href="<?php echo url_for('dashboard/index')?>" title="Dashboard" class="<?php echo sfConfig::get('dashboard_menu') ?>">
        <span>Dashboard</span>
      </a>
    </li>

    <li class="level0 <?php echo sfConfig::get('serial_menu') ?>">
      <a href="<?php echo url_for('serials/index?page=' . $sf_user->getAttribute('page', 1, 'tv_admin/serial'))?>" title="Series Multimedia" class="<?php echo sfConfig::get('serial_menu') ?>">
        <span><?php echo __('Series Multimedia')?></span>
      </a>
    </li>
    
    <li class="level0 <?php echo sfConfig::get('virtual_serial_menu') ?>">
      <a href="<?php echo url_for('virtualserial/index?page=' . $sf_user->getAttribute('page', 1, 'tv_admin/virtualserial'))?>" class="<?php echo sfConfig::get('virtual_serial_menu') ?>">
        <span><?php echo __('Catalogador Unesco')?></span>
      </a>
    </li>
  
    <li onmouseover="Element.addClassName(this,'over')" onmouseout="Element.removeClassName(this,'over')" class="parent level0 <?php echo sfConfig::get('template_menu') ?>">
      <a href="#" title="Dise&ntilde;o" onclick="return false" class="<?php echo sfConfig::get('template_menu') ?>">
        <span><?php echo __('Dise&ntilde;o Portal WebTV')?></span>
      </a>
      <ul>
        <li class="level1">
          <a href="<?php echo url_for('widgets/index')?>" title="Widgets" class="">
            <span><?php echo __('Diseño')?></span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('templates/index')?>" title="Templates" class="">
            <span><?php echo __('Plantillas')?></span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('navigator/index')?>" title="Navegator" class="">
            <span>FileManager</span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('virtualgrounds/index')?>" title="Categorias" class="">
            <span><?php echo __('Categorias')?></span>
          </a>
        </li>
        <li class="last level1">
          <a href="<?php echo url_for('notices/index')?>" title="Notices" class="">
            <span><?php echo __('Noticias')?></span>
          </a>
        </li>
      </ul>
    </li>
  
    <li onmouseover="Element.addClassName(this,'over')" onmouseout="Element.removeClassName(this,'over')" class="parent level0 <?php echo sfConfig::get('tv_menu') ?>">
      <a href="#" title="TV" onclick="return false" class="<?php echo sfConfig::get('tv_menu') ?>">
        <span><?php echo __('Directos')?></span>
      </a>
      <ul>
        <li class="level1">
          <a href="<?php echo url_for('directs/index')?>" title="Direct" class="">
            <span><?php echo __('Canales en Directo')?></span>
          </a>
        </li>
        <li class="last level1">
          <a href="<?php echo url_for('events/index')?>" title="Direct" class="">
            <span><?php echo __('Anuncios de Directos')?></span>
          </a>
        </li>
      </ul>
    </li>
  

    <?php if(sfConfig::get('app_transcoder_use')):?>
    <li onmouseover="Element.addClassName(this,'over')" onmouseout="Element.removeClassName(this,'over')" class="parent level0 <?php echo sfConfig::get('transcoder_menu') ?>">
      <a href="#" title="Transcodificador" onclick="return false" class="<?php echo sfConfig::get('transcoder_menu') ?>">
        <span><?php echo __('Transcodificacion')?></span>
      </a>
      <ul>
        <li class="level1">
          <a href="<?php echo url_for('profiles/index')?>" title="Profiles" class="">
            <span><?php echo __('Perfil de Transcodificación')?></span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('transcoders/index')?>" title="List" class="">
            <span><?php echo __('Lista de tareas')?></span>
          </a>
        </li>
        <li class="last level1">
          <a href="<?php echo url_for('cpus/index')?>" title="Cpus" class="">
            <span><?php echo __('Trascodificadores')?></span>
          </a>
        </li>  
      </ul>
    </li>

   <?php endif ?>

    <li class="level0 <?php echo sfConfig::get('timeframes_menu') ?>">
      <a href="<?php echo url_for('timeframes/indexDash')?>" 
         class="<?php echo sfConfig::get('timeframes_menu') ?>">
        <span><?php echo __('Editoriales Temporizadas')?></span>
      </a>
    </li>

    <li onmouseover="Element.addClassName(this,'over')" onmouseout="Element.removeClassName(this,'over')" class="parent level0 <?php echo sfConfig::get('library_menu') ?>">
      <a href="#" title="Tablas" onclick="return false" class="<?php echo sfConfig::get('library_menu') ?>">
        <span><?php echo __('Tablas')?></span>
      </a>
                                       
      <ul>
        <li class="level1 last">
          <a href="<?php echo url_for('persons/index')?>" title="Persons" class="">
            <span><?php echo __('Personas')?></span>
          </a>
        </li>
      </ul>    
    </li>

<?php if($sf_user->getAttribute('user_type_id', 1) == 0) /* A los publicadores no les aparece el menú de administración de usuarios.*/:?>
    <li onmouseover="Element.addClassName(this,'over')" onmouseout="Element.removeClassName(this,'over')" class="parent level0 <?php echo sfConfig::get('config_menu') ?>">
      <a href="#" title="Administraci&oacute;n" onclick="return false" class="<?php echo sfConfig::get('config_menu') ?>">
        <span><?php echo __('Administraci&oacute;n')?></span>
      </a>
      <ul>
        <li class="level1">
          <a href="<?php echo url_for('users/index')?>" title="Users" class="">
            <span><?php echo __('Usuarios admin')?></span>
          </a>
        </li>
        <!-- <li class="level1">
          <a href="#" title="Export" class="">
            <span>Export</span>
          </a>
        </li> 
        <li class="last level1">
          <a href="#" title="Backup" class="">
            <span>Backup</span>
          </a>
        </li> -->

        <!--        <li class="level1">
          <a href="<?php echo url_for('places/index')?>" title="Places" class="">
            <span><?php echo __('Lugares y recintos')?></span>
          </a>
        </li>-->
        <!-- <li class="level1">
          <a href="#" title="Channels" class="">
            <span>Channels</span>
          </a>
        </li> -->
        <li class="level1">
          <a href="<?php echo url_for('categories/index')?>"  class="">
            <span><?php echo __('Categorias')?></span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('genres/index')?>" class="">
            <span><?php echo __('G&eacute;neros')?></span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('mattypes/index')?>" title="matType" class="">
            <span><?php echo __('Tipos de materiales')?></span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('serialtypes/index')?>" title="Serial Type" class="">
            <span><?php echo __('Tipos de series')?></span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('languages/index')?>" title="Language" class="">
            <span><?php echo __('Idiomas')?></span>
          </a>
        </li>
        <!-- depricated
        <li class="level1">
          <a href="<?php echo url_for('resolutions/index')?>" title="Resolution" class="">
            <span>Resolution</span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('codecs/index')?>" title="Codec" class="">
            <span>Codec</span>
          </a>
        </li>
        <li class="level1">
          <a href="<?php echo url_for('formats/index')?>" title="Format" class="">
            <span>Format</span>
          </a>
        </li>
       
        <li class="level1">
          <a href="<?php echo url_for('profiles/index')?>" title="Profile" class="">
            <span><?php echo __('Perfiles')?></span>
          </a>
        </li>
        -->
        <li class="level1">
          <a href="<?php echo url_for('roles/index')?>" title="Rol" class="">
            <span>Roles</span>
          </a>
        </li>
       <li class="level1">
         <a href="<?php echo url_for('broadcasts/index')?>"  class="">
           <span><?php echo __('Perfiles Acceso')?></span>
          </a>
        </li>


        <li class="level1">
          <a href="<?php echo url_for('streamservs/index')?>"  class="">
            <span><?php echo __('Servidores de Distribución')?></span>
          </a>
        </li>   
      </ul>
    </li>  
<?php endif ?>
    
  <?php if (sfConfig::get('app_matterhorn_use')):?>
    <li onmouseover="Element.addClassName(this,'over')" onmouseout="Element.removeClassName(this,'over')" class="parent level0 <?php echo sfConfig::get('ingest_menu') ?>">
      <a href="#" title="Ingestador" onclick="return false" class="<?php echo sfConfig::get('ingest_menu') ?>">
        <span><?php echo __('Ingestador')?></span>
      </a>
      <ul>
        <li class="level1" last>
          <a href="<?php echo url_for('matterhorn/index')?>" title="Matterhorn" class="">
            <span><?php echo __('Ingestador Matterhorn')?></span>
          </a>
        </li>
      </ul>
    </li>
  <?php endif ?>
  </ul>
</div>