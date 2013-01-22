OBJETOS MULTIMEDIA DE LA SERIE:
<hr />
<div id="list_mm_detail">
<?php foreach($mms as $mm):?>
<div>

<?php include_partial('new_serial/mm_detail', array('mm' => $mm, 'roles' => $roles)) ?>

</div>
<?php endforeach?>
</div>