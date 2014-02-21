<?php if ($sf_user->getAttribute('sort', 'id', 'tv_admin/virtualserial') == 'id'): ?>
  <th width="1%">
    <?php echo link_to_remote('Id'.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=id&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th width="1%">
    <?php echo link_to_remote('Id', array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=id&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>

<?php if ($sf_user->getAttribute('sort', 'serial', 'tv_admin/virtualserial') == 'serial_id'): ?>
  <th width="1%">
    <?php echo link_to_remote('Serie'.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=serial_id&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th width="1%">
    <?php echo link_to_remote('Serie', array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=serial_id&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>

<?php if ($sf_user->getAttribute('sort', 'id', 'tv_admin/virtualserial') == 'title'): ?>
  <th>
  <?php echo link_to_remote( __('Titulo').($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=title&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th>
    <?php echo link_to_remote( __('Titulo'), array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=title&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>

<!--<th width="1%">UNESCO</th>-->

<?php if ($sf_user->getAttribute('sort', 'id', 'tv_admin/virtualserial') == 'duration'): ?>
<th width="1%">
    <?php echo link_to_remote( __('Duración').($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=duration&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
</th>
<?php else: ?>
  <th width="1%">
    <?php echo link_to_remote('Duración', array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=duration&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>
<?php if ($sf_user->getAttribute('sort', 'id', 'tv_admin/virtualserial') == 'publicDate'): ?>
  <th width="1%">
    <?php echo link_to_remote('FechaPub'.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=publicDate&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th width="1%">
    <?php echo link_to_remote('FechaPub', array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=publicDate&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>

<?php if ($sf_user->getAttribute('sort', 'id', 'tv_admin/virtualserial') == 'recordDate'): ?>
  <th width="1%">
    <?php echo link_to_remote('FechaRec'.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? '&nbsp;&#x25BE;' : '&nbsp;&#x25B4;'), array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=recordDate&type='.($sf_user->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc' ? 'desc' : 'asc'), 'script' => 'true')) ?>
  </th>
<?php else: ?>
  <th width="1%">
    <?php echo link_to_remote('FechaRec', array('update' => 'list_mms', 'url' => 'virtualserial/list?sort=recordDate&type=asc', 'script' => 'true')) ?>
  </th>
<?php endif; ?>