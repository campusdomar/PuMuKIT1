<?php // padding-bottom:90px para curarme en salud si el navegador alarga el textbox y usa dos filas para los selects?>
  <div style="float:left;">
    <div>&nbsp;Palabras clave</div>
      <div >
        <?php /* <label accesskey="t" for="busca" class="salto"><?php echo __("Busca")?>:</label> */?>
        <input class="box_lupa" style="height:18px; width:100px; padding-right: 20px;" placeholder="<?php echo __("Busca")?>..." 
               name="search" value="<?php echo $sf_request->getParameter('search', '')?>" maxlength="100" type="text" />
        <input type="image" src="/images/1.8/lupa_buscador.png" alt="Enviar parámetros de búsqueda" style="position: relative; top: 1px; right: 22px;" name="startsearch" />
      </div>
      <noscript><?php echo submit_tag('go'); ?></noscript>
  </div>
   <?php if ( isset($unescos) ) :?>
     <div style="width:92px; float:left">
      <div>&nbsp;Categorías</div>
       <?php $opciones_form_unesco = array('all' => 'Todas') + $sf_data->getRaw('unescos');
             echo select_tag('unesco', 
                                     options_for_select($opciones_form_unesco,
                                                        $sf_request->getParameter('unesco', 'all')), //valor por defecto
                                                        array('style' => 'width:85px;',
                                                        'onChange' => 'Javascript:this.form.submit();')) ?>
      
     </div>
  <?php else :?>
     <input name="unesco" id="unesco" type="hidden" value="<?php echo $unesco ?>"/>
  <?php endif;?>
  <div style="width:82px; float:left; ">
    <div>&nbsp;Vídeo / Audio</div>
    <?php echo select_tag('only',
      options_for_select(
        array('all'   => 'Todos',
              'video' => 'Vídeo',
              'audio' => 'Audio'),
              $sf_request->getParameter('only', 'all')),
      array('style' => 'width:75px;',
            'onchange' => 'Javascript:this.form.submit();')); ?>
  </div>
  <div style="width:85px; float:left">
    <div>&nbsp;Duración</div>
    <?php echo select_tag('duration',
      options_for_select(
        array('all' => 'Todas',
              '-5'   => 'Hasta&nbsp;&nbsp;&nbsp;5 minutos',
              '-10'  => 'Hasta 10 minutos',
              '-30'  => 'Hasta 30 minutos',
              '-60'  => 'Hasta 60 minutos',
              '+60'  => 'Más de 60 minutos',),
              $sf_request->getParameter('duration', 'all')),
      array('style' => 'width:78px;',
            'onchange' => 'Javascript:this.form.submit();')); ?>
  </div>
   <div style="width:54px; float:left">
         <div>&nbsp;Dia</div>
	 <?php $opciones_form_years = array('all' => 'Todos') +  array_combine(range(1, 31), range(1, 31));
                    echo select_tag('day',
                                     options_for_select($opciones_form_years,
                                                              $sf_request->getParameter('day', 'all')),
                                                              array('style' => 'width:52px;',
                                                                    'onchange' => 'Javascript:this.form.submit();')); ?>
   </div>
   <div style="width:54px; float:left">
         <div>&nbsp;Mes</div>
	 <?php $opciones_form_years = array('all' => 'Todos') + array_combine(range(1, 12), range(1, 12));
                    echo select_tag('month',
                                           options_for_select($opciones_form_years,
                                                              $sf_request->getParameter('month', 'all')),
                                                              array('style' => 'width:52px;',
                                                                    'onchange' => 'Javascript:this.form.submit();')); ?>
   </div>
  <div style="width:69px; float:left">
    <div>&nbsp;Año</div>
    <?php $opciones_form_years = array('all' => 'Todos') + $sf_data->getRaw('years');
      echo select_tag('year',
      options_for_select( $opciones_form_years,
        $sf_request->getParameter('year', 'all')),
      array('style' => 'width:62px;',
            'onchange' => 'Javascript:this.form.submit();')); ?>
  </div>
  <?php if ($module != 'noticias') :?>
     <div style="width:70px; float:left">
       <div >&nbsp;Género</div>
       <?php $opciones_form_genres = array('all' => 'Todos') + $sf_data->getRaw('genres');
         echo select_tag('genre',
         options_for_select( $opciones_form_genres,
           $sf_request->getParameter('genre', 'all')),
         array('style' => 'width:65px;',
               'onchange' => 'Javascript:this.form.submit();')); ?>
     </div>
  <?php endif;?>
  <div style="width:90px; float:left">
    <div>Eliminar filtros</div>
      <input type="button" onclick="window.location.href=window.location.pathname" name="filter" value="reset" class="btn" />
  </div>