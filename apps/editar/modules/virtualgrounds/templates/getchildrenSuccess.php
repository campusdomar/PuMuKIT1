<?php include_partial('list_categories_ajax', array(
                            'vg_id'     => $vg_id,
                            'parent'    => $c->getId(), 
                            'block_cat' => $block_cat,
                            'nodes'     => $c->getChildren())) ?>