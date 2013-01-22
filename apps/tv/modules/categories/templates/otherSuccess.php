<div>
<h1><?php echo __("Otros")?> </h1>
</div>

  <div style="margin: 5px 0px 15px">
    <!--<div style="color:  #fff; background-color: #039; font-weight: bold; font-size: 130%; padding: 10px">
      <?php echo __("Otros")  ?>
    </div>-->
    <h2 class="nada">
      <?php echo __("Otros")  ?>
    </h2>
    <div style="overflow: hidden">
    <?php foreach($serials as $a_id => $a): ?>
      <div style="width:49%; padding: 2px; float: left">

        <!--- PARTIAL --->
        <?php include_partial('categories/block', array('announce' => $a))?>
        <!--- END PARTIAL --->
      </div>

      <?php if(($a_id%2) != 0):?>
        <div style="width:100%; float:left">&nbsp;</div>
      <?php endif ?>

    <?php endforeach ?> 
    </div>

    </div>