         <table style="float: left; width: 340px; margin-top: 10px" class="unedtv_mmobj">
            <tr colspan="3">
               <td width="1%" valign="top"  style="background-color:transparent"> <!-- hack-->
                  <?php $pics = $mm->getUrlPics(false, 3) ?>
                  <div id="serial_mm_pics" style="margin-top: 10px;"> 
                     <?php foreach ($pics as $value): ?>
                     <div class="picture" style="margin: 0px 10px">
                        <div class="img">
                           <span class="video-duration"><?php echo $mm->getDurationMin()?>:<?php echo $mm->getDurationSeg()?></span>
                           <img src="<?php echo $value ?>" />
                        </div>
                     </div>
                     <?php break; ?>
                     <?php endforeach; ?>
                     <td style="background-color:transparent; vertical-align: middle;">
                        <div id="serial_mm_info" style="background-color:transparent; padding-left:2%; padding-right:2%; text-align:left; width:95%; ">
  
                        <!-- TITLE & SUBTITLE -->
  
                       <?php if ($mm->getTitle() !== ''):?>
                          <div id="title" style="font-size:13px; font-weight:bold">
                            <abbr title="<?php echo $mm->getTitle()?>">
                              <?php echo str_abbr($mm->getTitle(), 67, "...") ?>
                            </abbr>
                          </div>
                       <?php endif ?>
                       <?php if ($mm->getSubtitle() !== ''):?>
                          <div id="subtitle"><?php echo $mm->getSubtitle()?></div>	
                       <?php endif ?>
  
                       <div id="objects" style="margin-top: 10px;">
                       <!-- FILES -->
                       <?php $files = $mm->getFiles() ?> 
                       <?php foreach ($files as $file): if(!$file->getPerfil()->getDisplay()) continue;?>  
                          <div id="file" class="<?php echo ($file->getAudio()?'audio':'mm')?>">
                             <?php if ($file->getDescription() !== ""): ?>
                                <strong>&nbsp;<?php echo ( $file->getDescription() ) ?>&nbsp;|&nbsp;</strong>
                             <?php endif ?>
                             <span id="language"><?php echo $file->getLanguage()->getName() ?></span>
                             &nbsp;|&nbsp;Visto: <span id="numView"><?php echo $file->getNumView()?></span><?php echo (($file->getNumView() == 1)?' vez':' veces')?>
                          </div>

                       <?php endforeach; ?>         

  
                       <!-- MATERIAL -->
                       <?php $materials = $mm->getMaterials() ?> 
                       <?php foreach ($materials as $material): ?>  
                          <div id="material" class="<?php echo $material->getMatType()->getType() ?>">
                             <a href="<?php echo $material->getUrl() ?>"><?php echo $material->getName() ?></a>
                          </div>
                       <?php endforeach; ?>
  
                       <!-- LINK -->
                       <?php $links = $mm->getLinks() ?> 
                       <?php foreach ($links as $link): ?>  
                          <div id="link" class="link">
                             <?php echo link_to($link->getName(), $link->getUrl(), array('target' => '_blank') ) ?>
                          </div>
                       <?php endforeach; ?>
                    </div>
                    <br />
        
                    <!-- PERSONS PRESENT -->
                    <?php foreach($roles as $role): if($role->getDisplay() == true): ?>
                       <?php $acts = $mm->getPersons($role->getId()) ?>
                       <?php foreach ($acts as $act): ?>
                          <div>
                             <div class="person" font-weight:bold;">
                                <?php echo $role->getText()?>
                                <?php if ($act->getWeb() != ''): ?>
                                   <a href="<?php echo $act->getWeb()?>"><?php echo $act->getHName()?> </a>
                                <?php else: ?>
                                   <?php echo $act->getHName()?>
                                <?php endif ?>
                             </div>
                             <?php echo $act->getInfo()?>
                          </div>
                       <?php endforeach; ?>
                    <?php endif; endforeach; ?>
                 </div>
              </td>
           </div>
        </td>
     </tr>
  </table>