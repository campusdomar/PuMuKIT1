<?php include_partial('list_categories_ajax', array('mm_id' => $mm_id, 
						    'parent'=> $c->getId(), 
						    'block_cat' => $block_cat,
						    'nodes' => $c->getChildren())) ?>