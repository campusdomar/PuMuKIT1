<h3 class="cab_body_div"> Templates</h3>

<div class="container" id="page:container">
  <div class="main">


   <!-- UNO -->
    <div class="content-container">
      <div class="content" id="content">

        <div class="entry-edit" id="entry-edit">
                
            <!-- UNO A -->
            <?php foreach($templates as $template): ?>
              <div id="poll_tabs_<?php echo $template->getId()?>_section_content" style="display: none;">
	        <?php 
	    if ($template->getType() == 1) include_partial('templates/edit_css', array('template' => $template));
            else include_partial('templates/edit_lang', array('template' => $template));
                ?>
              </div>
            <?php endforeach ?>

        </div>
      </div>
    </div>

    <!-- DOS -->
    <div class="section-menu" id="page:left">
      <h3>Seleccione template:</h3>
        <ul id="poll_tabs" class="tabs">

          <!-- DOS A -->
          <?php foreach($templates as $template): ?>
            <li>
              <a href="#" id="poll_tabs_<?php echo $template->getId()?>_section" name="<?php echo $template->getId()?>_section" class="tab-item-link" idElement="<?php echo $template->getId()?>">
                <span>
                  <div class="changed" title="The information in this tab has been changed."></div>
                  <div class="error" title="This tab contains invalid data. Please solve the problem before saving."></div>
                  <?php if ($template->getUser()): ?>
                    <img src="/images/admin/mbuttons/delete_inline.gif" class="button" title="borrar" alt="borrar" 
	              onclick="if (confirm('Seguro')) {window.location.href='<?php echo url_for('templates/delete?id='.$template->getId())?>'};"/> 
                  <?php endif ?>
                  <img class="button" id="save_<?php echo $template->getId()?>" src="/images/admin/load/spinner.gif" alt="Loading..." height="15" style="display:none;"/>
                  <div class="tooltip">
                    <?php echo $template->getName()?>
                    <div>(<?php echo $template->getTypeName()?>)<?php echo $template->getDescription()?></div>
                  </div>


                </span>
              </a>
            </li>
          <?php endforeach ?>

        </ul>

        <?php echo javascript_tag("
        poll_tabsJsTabs = new varienTabs('templates/preview',
                                         'poll_tabs', 
					 'entry-edit', 
					 'poll_tabs_".$sf_user->getAttribute('id', 1, 'tv_admin/templates')."_section'
					 );
        ");?>
 
      <div class="bottom">
        <?php include_partial('templates/create') ?>
      </div>
    </div>
  </div>
</div>