<div class="serial_mm_info">
  <?php // Etiquetas para categorías, número de vistas y fecha ?>
  <div style="margin-bottom: 10px; overflow: hidden;">
    <div style="width: 440px;">
      <ul>
        <?php foreach ($mm->getCategories(CategoryPeer::retrieveByCode("UNESCO")) as $category) :?>
          <li style="list-style:none; float: left; margin: 5px;">
            <div title="<?php echo $category->getName()?>" class="label-categories label-info">
              <a style="text-decoration: none" href="<?php echo url_for('educa/allMmsByDate') . '?id='.$category->getId()?>"><?php echo $category->getName()?></a>
            </div>
          </li>
        <?php endforeach; ?> 
      </ul>
    </div>
    <div class="num_view" style="margin-left: 440px;">
      <div style="font-weight: normal;">
        <?php echo $mm->getRecordDate('d/m/Y') ?>
      </div>
      <div style="margin-top: 5px;">
        <?php echo __('Visto')?>
        <span class="num_view_number"><?php echo $file->getNumView()?></span>
        <?php echo (($file->getNumView() == 1)?__('vez'):__('veces'))?>
      </div>
    </div>
  </div>

  <?php // Subtítulo ?>
  <?php if (strlen($mm->getSubtitle()) != 0) :?>
    <div class="title" style="clear: left;">
     <?php echo $mm->getSubtitle(); ?>
    </div>
  <?php endif;?>

<table style="margin-bottom: 10px;">
    <tr style="vertical-align: top;">
      <td style="width: 65%; border-right: 1px solid #ddd; padding-right: 10px;">
        <p>
          <?php echo nl2br($mm->getDescription()) ?>
        </p>
      </td>
      <td style="padding: 5px 0 0 10px; width:217px;">
        <?php // el nº mágico width: 217px es para solucionar el descuadre del span del tamaño en mmobj con descripciones cortas. Viene de medir una objeto con layout correcto (cuando tiene descripción de varias líneas). ?>
        <?php foreach ($mm->getFilesToDownload() as $fileD) : if (!$fileD->getDisplay()) continue; $fileD->setCulture($sf_user->getCulture())?>
          <div class="download" style="height: 30px; margin-left: 5px;">
            <a href="<?php echo url_for('mmobj/download') . '?id='.$fileD->getId()?>">
              Descargar este <?php echo ($fileD->getAudio()) ? 'audio' : 'vídeo';?>
            </a>
            <span class="size"><?php echo number_format($fileD->getSize()/1048576, 2)?>MB</span>
          </div>
        <?php endforeach; ?>
        <!-- MATERIAL -->
        <?php $materials = $mm->getMaterialsWithI18n() ?>
        <?php foreach ($materials as $material): if(!$material->getDisplay()) continue;$material->setCulture( $sf_user->getCulture() ) ?>
          <div style="height: 30px; margin-left: 5px;" class="material <?php echo $material->getMatType()->getType() ?>">
            <a style="margin-left: 20px;" title="<?php echo $material->getName()?>" target="_blank" href="<?php echo $material->getUrl() ?>">
              <?php echo str_abbr($material->getName(), 20, "...") ?>
            </a>
            <span class="size"><?php echo number_format($material->getSize()/1024, 2)?>kB</span>
          </div>
        <?php endforeach; ?>
        <!-- LINKS -->
        <?php $links = $mm->getLinks() ?>
        <?php foreach ($links as $link):?>
          <div style="width: 201px; height: 30px; margin-left: 5px;" class="url">
            <a style="margin-left: 20px;" title="<?php echo $link->getName()?>" target="_blank" href="<?php echo $link->getUrl() ?>">
              <?php echo str_abbr($link->getName(), 25, "...") ?>
            </a>
          </div>
        <?php endforeach; ?>
        <div style="clear:both;"></div>
<?php include_partial('share', array('mmobj' => $mm))?>
      </td>
    </tr>
  </table>

  <?php // Enlace a la serie, ojo, estilo propio pumukit ?>
  <?php if ($mm->getSerialWithI18n()->getDisplay()) :?>
    <div style="clear: left;">
       <span style="font-weight: bolder">Serie:</span> <a style="font-size: 0.85em" href="<?php echo $mm->getSerialWithI18n()->getUrl()?>"><?php echo $mm->getSerialWithI18n()->getTitle() ?></a>
    </div>
  <?php endif;?>

  <div class="serial_mm_info">
    <!-- PERSONS ACT -->
    <div class="" style="overflow: hidden;">
      <?php foreach($roles as $role): if($role->getDisplay() == true): ?>
        <?php $acts = $mm->getPersons($role->getId()) ?> 
        <?php foreach ($acts as $act): ?>
          <div>
            <?php echo $role->getText()?>
            <?php // Enlace a la web de la persona: completar <a href="<?php echo $act->getWeb()...>?>
            <span style="font-weight: bolder"><?php echo $act->getHName()?> </span>
            <span style="font-size:85%; color:#666"><?php echo $act->getInfo()?></span>
          </div>
        <?php endforeach; ?>
      <?php endif; endforeach; ?>
    </div>
  </div>
</div>