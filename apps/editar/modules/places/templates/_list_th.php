<?php if ($sf_user->getAttribute('sort', null, 'tv_admin/place') == 'id'): ?>
  <th width="1%">
    <?php echo link_to_remote(__('Id').($sf_user->getAttribute('type', 'asc', 'tv_admin/place') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_places', 'url' => 'places/list?sort=id&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/place') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th width="1%">
    <?php echo link_to_remote(__('Id'), array('update' => 'list_places', 'url' => 'places/list?sort=id&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>


<?php if ($sf_user->getAttribute('sort', null, 'tv_admin/place') == 'name'): ?>
  <th>
    <?php echo link_to_remote(__('Nombre').($sf_user->getAttribute('type', 'asc', 'tv_admin/place') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_places', 'url' => 'places/list?sort=name&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/place') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th>
    <?php echo link_to_remote(__('Nombre'), array('update' => 'list_places', 'url' => 'places/list?sort=name&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>


<?php if ($sf_user->getAttribute('sort', null, 'tv_admin/place') == 'address'): ?>
  <th>
    <?php echo link_to_remote(__('Dir.').($sf_user->getAttribute('type', 'asc', 'tv_admin/place') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_places', 'url' => 'places/list?sort=address&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/place') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th>
    <?php echo link_to_remote(__('Dir.'), array('update' => 'list_places', 'url' => 'places/list?sort=address&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>


