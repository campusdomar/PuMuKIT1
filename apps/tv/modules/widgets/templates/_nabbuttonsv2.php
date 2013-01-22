<h2><?php echo __('Categor&iacute;as')?></h2>

<table class="pumukit_index">
 <tbody>
   <tr>
     <td rowspan="2" width="31%">
       <div class="img_category">
         <a href="<?php echo url_for('categories/index?id=' . $categories[0]->getId())?>">
           <img alt="<?php echo $categories[0]->getName()?>" src="<?php echo $categories[0]->getImg()?>" 
                style="height: 349px; width: 216px"/>
           <div class="cover"><div><?php echo $categories[0]->getName()?></div></div>
         </a>
       </div>
     </td>
     <td width="31%">
       <div class="img_category">
         <a href="<?php echo url_for('categories/index?id=' . $categories[1]->getId())?>">
           <img alt="<?php echo $categories[1]->getName()?>" src="<?php echo $categories[1]->getImg()?>" />
           <div class="cover"><div><?php echo $categories[1]->getName()?></div></div>
         </a>
       </div>
     </td>
     <td width="31%">
       <div class="img_category">
         <a href="<?php echo url_for('categories/index?id=' . $categories[2]->getId())?>">
           <img alt="<?php echo $categories[2]->getName()?>" src="<?php echo $categories[2]->getImg()?>" />
           <div class="cover"><div><?php echo $categories[2]->getName()?></div></div>
         </a>
       </div>
     </td>
   </tr>
   <tr>
     <td width="31%">
       <div class="img_category">
         <a href="<?php echo url_for('categories/index?id=' . $categories[3]->getId())?>">
           <img alt="<?php echo $categories[3]->getName()?>" src="<?php echo $categories[3]->getImg()?>" />
           <div class="cover"><div><?php echo $categories[3]->getName()?></div></div>
         </a>
       </div>
     </td>
     <td width="31%">
       <div class="img_category">
         <a href="<?php echo url_for('categories/index?id=' . $categories[4]->getId())?>">
           <img alt="<?php echo $categories[4]->getName()?>" src="<?php echo $categories[4]->getImg()?>" />
           <div class="cover"><div><?php echo $categories[4]->getName()?></div></div>
         </a>
       </div>
     </td>
   </tr>
 </tbody>
</table>



