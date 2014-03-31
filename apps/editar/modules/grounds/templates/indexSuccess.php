<h3 class="cab_body_div"><img src="/images/admin/cab/config_ico.png"/> &Aacute;reas de conocimiento</h3>

<div class="container" id="page:container">
  <div class="main">


   <!-- UNO -->
    <div class="content-container">
      <div class="content" id="content">

        <div class="entry-edit" id="entry-edit">
                
            <!-- UNO A -->
            <?php foreach($types as $type): ?>
              <div id="poll_tabs_<?php echo $type->getId()?>_section_content" style="display: none;">
                <?php include_partial('grounds/index', array('type' => $type)) ?>
              </div>
            <?php endforeach ?>
        </div>
      </div>
    </div>

    <!-- DOS -->
    <div class="section-menu" id="page:left">
      <h3><?php echo __('Seleccione tipo:') ?></h3>
        <ul id="poll_tabs" class="tabs" 
	    onmouseover="$$('.order_groundtype').invoke('show');" 
	    onmouseout="$$('.order_groundtype').invoke('hide');"
	>

          <!-- DOS A -->
          <?php foreach($types as $type): ?>
            <li>
              <a href="#" id="poll_tabs_<?php echo $type->getId()?>_section" name="<?php echo $type->getId()?>_section" class="tab-item-link" idElement="<?php echo $type->getId()?>">
                <span>
                  <img src="/images/admin/mbuttons/delete_inline.gif" class="button" title="borrar" alt="borrar" 
	              onclick="if (confirm('Seguro')) {window.location.href='<?php echo url_for('grounds/deletetype?id='.$type->getId())?>'};" />
                  <div class="order_groundtype" style="float:right; padding-right: 10px; display:none" >
                    <span onclick="window.location.href='<?php echo url_for('grounds/uptype?id='.$type->getId()) ?>'">&#8593;</span>&nbsp;
                    <span onclick="window.location.href='<?php echo url_for('grounds/downtype?id='.$type->getId()) ?>'">&#8595;</span>
                  </div>
                  <div class="tooltip">
                    <?php echo $type->getName()?>
                  </div>

                </span>
              </a>
            </li>
          <?php endforeach?>

        </ul>

        <?php echo javascript_tag("
        poll_tabsJsTabs = new varienTabs('grounds/previewtype',
                                         'poll_tabs', 
					 'entry-edit', 
					 'poll_tabs_".$sf_user->getAttribute('id', 1, 'tv_admin/groundtype')."_section'
					 );
        ");?>
 
      <div class="bottom">
        <?php include_partial('grounds/create') ?>
      </div>
    </div>
  </div>
</div>


