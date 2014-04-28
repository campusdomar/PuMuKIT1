<?php if ($sf_user->getAttribute('sort', null, 'tv_admin/person') == 'id'): ?>
  <th width="1%">
    <?php echo link_to_remote(__('Id') . ($sf_user->getAttribute('type', 'asc', 'tv_admin/person') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_persons', 'url' => 'persons/list?sort=id&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/person') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th width="1%">
    <?php echo link_to_remote(__('Id'), array('update' => 'list_persons', 'url' => 'persons/list?sort=id&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>


<?php if ($sf_user->getAttribute('sort', null, 'tv_admin/person') == 'name'): ?>
  <th>
    <?php echo link_to_remote(__('Nombre') . ($sf_user->getAttribute('type', 'asc', 'tv_admin/person') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_persons', 'url' => 'persons/list?sort=name&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/person') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th>
    <?php echo link_to_remote(__('Nombre'), array('update' => 'list_persons', 'url' => 'persons/list?sort=name&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>



<?php if ($sf_user->getAttribute('sort', null, 'tv_admin/person') == 'email'): ?>
  <th>
    <?php echo link_to_remote(__('Email') . ($sf_user->getAttribute('type', 'asc', 'tv_admin/person') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_persons', 'url' => 'persons/list?sort=email&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/person') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th>
    <?php echo link_to_remote(__('Email'), array('update' => 'list_persons', 'url' => 'persons/list?sort=email&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>



<?php if ($sf_user->getAttribute('sort', null, 'tv_admin/person') == 'phone'): ?>
  <th>
    <?php echo link_to_remote(__('Tel&eacute;fono') . ($sf_user->getAttribute('type', 'asc', 'tv_admin/person') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_persons', 'url' => 'persons/list?sort=phone&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/person') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
  <?php else: ?>
  <th>
    <?php echo link_to_remote(__('Tel&eacute;fono'), array('update' => 'list_persons', 'url' => 'persons/list?sort=phone&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>


