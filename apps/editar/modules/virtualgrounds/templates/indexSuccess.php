<?php use_helper('Object') ?>

<h3 class="cab_body_div"><img src="/images/admin/cab/widget_ico.png"/> 
    <a href="<?php echo url_for('widgets/index')?>" style="color: #666E73; font-size: 75%">[ WebTV Layout ]</a> Categorias de navegación
</h3>

<div class="container" id="page:container">
  <div class="main">


   <!-- UNO -->
    <div class="content-container">
      <div class="content" id="content" style="margin: 0px">

        <!-- FORMULARIOS -->
        <div class="entry-edit" id="entry-edit" style="float:left; position: relative; padding:30px 10px 0px 20px;"> <!-- cambiar border-top color-->
                
            <?php foreach($vgrounds as $vground): ?>
              <div id="poll_tabs_<?php echo $vground->getId()?>_section_content" style="display: none;">
	        <?php include_partial('virtualgrounds/edit', array('vground' => $vground)) ?>
                <?php //echo $vground->getCod() ?>
              </div>
            <?php endforeach ?>
        </div>


      </div>
    </div>


    <!-- DOS -->
    <div class="section-menu" id="page:left">
      <h3>Categorias:</h3>
        <ul id="poll_tabs" class="tabs" 
	    onmouseover="$$('.order_groundtype').invoke('show');" 
	    onmouseout="$$('.order_groundtype').invoke('hide');"
	>

          <!-- DOS A -->
          <?php if(count($vgrounds) == 0):?>
            <li> No existen categorias, cree una nueva.</li>
          <?php else:?>
          <?php foreach($vgrounds as $vground): ?>
            <li>
              <a href="#" id="poll_tabs_<?php echo $vground->getId()?>_section" 
                 name="<?php echo $vground->getId()?>_section" class="tab-item-link" 
                 idElement="<?php echo $vground->getId()?>">
                <span>
                  <img src="/images/admin/mbuttons/delete_inline.gif" class="button" title="borrar" alt="borrar" 
	              onclick="if (confirm('Seguro')) {window.location.href='<?php echo url_for('virtualgrounds/delete?id='.$vground->getId())?>'};" />
                  <div class="order_groundtype" style="float:right; padding-right: 10px; display:none" >
                    <span onclick="window.location.href='<?php echo url_for('virtualgrounds/up?id='.$vground->getId()) ?>'">&#8593;</span>&nbsp;
                    <span onclick="window.location.href='<?php echo url_for('virtualgrounds/down?id='.$vground->getId()) ?>'">&#8595;</span>
                  </div>
                  <div class="tooltip">
                    <?php echo $vground->getCod()?>
                  </div>

                </span>
              </a>
            </li>
          <?php endforeach?>
          <?php endif?>

        </ul>

        <?php echo javascript_tag("
        poll_tabsJsTabs = new varienTabs('virtualgrounds/previewtype',
                                         'poll_tabs', 
					 'entry-edit', 
					 'poll_tabs_".$sf_user->getAttribute('id', 1, 'tv_admin/groundtype')."_section'
					 );
        ");?>
 
      <div class="bottom">
        <?php include_partial('virtualgrounds/create') ?>
      </div>
    </div>
  </div>
</div>




<div id="hidden_div" style="display:none" />
