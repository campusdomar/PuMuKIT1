<h2><?php echo __('Menú') ?></h2>

<div id="menu">
  <ul>

<!-- INDEX -->
    <li>
      <?php echo link_to((($value == 'index')? '<strong>'.__('Principal').'</strong>' : __('Principal')), 'index/index')?>
    </li>

<!-- Servizio -->
    <li>
      <?php echo link_to(( ($value == 'Info')? '<strong>'.__('Servicio').'</strong>' : __('Servicio')), 'templates/index?temp=Info')?>
    </li>

<!-- FAQ -->
    <li>
      <?php echo link_to(( ($value == 'FAQ')? '<strong>F.A.Q</strong>' : 'F.A.Q.'), 'templates/index?temp=FAQ')?>
    </li>

<!-- Announces -->
    <li>
      <?php echo link_to((($value == 'announces')? '<strong>'.__('Novedades').'</strong>' : __('Novedades')), 'announces/index')?>
    </li>

<!-- News -->
    <li>
      <?php echo link_to((($value == 'news')? '<strong>'.__('Noticias').'</strong>' : __('Noticias')), 'news/index')?>
    </li>

<!-- Foro -->
    <li>
      <?php echo link_to('Foro', 'http://foros.uvigo.es/forumdisplay.php?s=ee706959bb911e9f853812052e7abd3d&f=6')?>
    </li>

<!-- iTunes -->
    <li>
      <img src="/images/tv/iconos/itunes.jpeg" width="13"> <?php echo link_to('iTunes U', 'http://itunes.uvigo.es')?> 
    </li>

<!-- Directos -->
    <li>
      <?php echo link_to((($value == 'directo')? '<strong>'.__('Directo').'</strong>' : __('Directo')), 'directo/index?canal=1')?>
      <ul>
        <li>
          - <?php echo link_to((($sf_params->get('canal', 0) == 1)? '<strong>'.__('Directo 1') . '</strong>' : __('Directo 1')), 'directo/index?canal=1')?>
        </li>
        <li>
          - <?php echo link_to((($sf_params->get('canal', 0) == 2)? '<strong>'.__('Directo 2') . '</strong>' : __('Directo 2')), 'directo/index?canal=2')?>
        </li>
      </ul>

    </li>


<!-- Mediateca -->
    <li>
      <?php echo link_to((($value == 'library')? '<strong>'.__('Mediateca').'</strong>' : __('Mediateca')), 'library/channel')?>
      <ul>
        <li>
          - <?php echo link_to((($sf_params->get('broadcast') == 'pub')? '<strong>'.__('Mediateca Pública') . '</strong>' : __('Mediateca Pública')), 'library/index?broadcast=pub')?>
        </li>
        <li>
          - <?php echo link_to((($sf_params->get('broadcast') == 'cor')? '<strong>'.__('Mediateca Privada') . '</strong>' : __('Mediateca Privada')), 'library/index?broadcast=cor')?>
        </li>
        <li>
          - <?php echo link_to((($value == 'pildoras')? '<strong>'.__('Canal Pildoras') . '</strong>' : __('Canal Pildoras')), 'pildoras/index')?>
        </li>
      </ul>

    </li>


  </ul>
</div>
