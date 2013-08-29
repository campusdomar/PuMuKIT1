<?php use_helper('Object', 'JSRegExp') ?>

<div class="tv_admin_filters">
  <?php echo form_remote_tag(array('update' => 'list_serials', 'url' => 'serials/list', 'script' => 'true' ), 'id=filter_serials') ?>
    <fieldset>
      <div id="bottom_container" >
    	
        <h2 class="accordion_toggle">Buscar</h2>
        <div class="accordion_content" style="overflow: hidden; display: none;">
          <div class="form-row">
            <label for="title">Titulo:</label>
            <div class="content">
              <?php echo input_tag('filters[title]', $sf_user->getAttribute('title', null, 'tv_admin/serial/filters')) ?>
            </div>
            <br />
            <label for="person">Persona:</label>
            <div class="content">
              <?php echo input_tag('filters[person]', $sf_user->getAttribute('person', null, 'tv_admin/serial/filters')) ?>
            </div>
          </div>
        </div>
    
        <h2 class="accordion_toggle">Fechas</h2>
        <div class="accordion_content" style="overflow: hidden; display: none;">  

          <div class="form-row">
	    <label for="publicdate"><?php echo 'Desde:' ?></label>
            <div class="content">

	    <?php 

$from = '';
$to = '';
$filters_date = $sf_user->getAttribute('date', null, 'tv_admin/serial/filters');
if(isset($filters_date['from']) && $filters_date['from'] != '') {
  list($d, $m, $y) = sfI18N::getDateForCulture($filters_date['from'], $sf_user->getCulture()); 
  $from = $y."-".$m."-" . $d;
}
if(isset($filters_date['to']) && $filters_date['to'] != '') {
  list($d, $m, $y) = sfI18N::getDateForCulture($filters_date['to'], $sf_user->getCulture()); 
  $to = $y."-".$m."-" . $d;
}

        echo input_date_tag('filters[date][from]', $from, array('rich' => true, 'calendar_button_img' => '/images/admin/buttons/date.png' )) ?>
            </div>
           
            <br />
	    <label for="publicdate"><?php echo 'Hasta:' ?></label>
            <div class="content">
	    <?php echo input_date_tag('filters[date][to]', $to, array ('rich' => true, 'calendar_button_img' => '/images/admin/buttons/date.png' )) ?>
            </div>
          </div>



        </div>

        <h2 class="accordion_toggle">Otros</h2>
        <div class="accordion_content" style="overflow: hidden; display: none;">

          <div class="form-row">
 	    <label for="announce">Anunciado:</label>
            <div class="content">
              <?php $options_filters_announce = array('diff' => 'Indiferente',
                                                      'true' => 'Sí',
                                                      'false' => 'No');
              echo select_tag('filters[announce]',
                options_for_select( $options_filters_announce,
                  $sf_user->getAttribute('announce', 'diff', 'tv_admin/serial/filters')));?>
            </div>
            <br /> 
 
 	    <label for="status">Oculto:</label>
            <div class="content">
		<?php $options_filters_status = array('all'=>'Todos',
                                                      'false' => 'No',
                                                      'true' => 'Si');
              echo select_tag('filters[status]',
                options_for_select( $options_filters_status,
                  $sf_user->getAttribute('status', 'all', 'tv_admin/serial/filters')));?>
            </div>
          </div>

        </div>

      </div>
    </fieldset>

    <ul class="tv_admin_actions">
      <li><?php echo button_to_remote('reset', array(
      // 'before' => '$("filter_serials").reset()', 
        'before' => 'resetSearchForm()',
      'update' => 'list_serials', 'url' => 'serials/list?filter=filter', 'script' => 'true'), 'class=tv_admin_action_reset_filter') ?></li>
      <li><?php echo submit_tag('filter', 'name=filter class=tv_admin_action_filter onclick=return testDates($("filters_date_from").value, $("filters_date_to").value, '. get_js_regexp_date($sf_user->getCulture()) . ')') ?></li>
    </ul>
  </form>
</div>


<?php echo javascript_tag("
  Event.observe(window, 'load', loadAccordions, false);
  //
  //      Set up all accordions
  //
  function loadAccordions() {
    var bottomAccordion = new accordion('bottom_container');
    //bottomAccordion.activate($$('#bottom_container .accordion_toggle')[0]);
  } 
  function resetSearchForm() {
    $('filters_title').value = '';
    $('filters_person').value = '';
    $('filters_date_from').value = '';
    $('filters_date_to').value = '';
    $('filters_announce').value = 'diff';
    $('filters_status').value = 'all';
  }
") ?>
<?php //!-- FALTA VER OCULTOS Y ANUNCIADOS ?>