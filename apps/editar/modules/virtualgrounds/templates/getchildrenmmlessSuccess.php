<?php include_partial('list_categories_ajax', array( 
						    'parent'=> $c->getId(), 
						    'block_cat' => $block_cat,
						    'nodes' => $c->getChildren())) ?>