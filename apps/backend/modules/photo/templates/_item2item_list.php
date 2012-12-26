<?php 
$item_type_id = ItemtypesPeer::ITEM_TYPE_PHOTOALBUM;
$item = $photo->getPhotoalbum();
require(__DIR__.'/../../item2item/templates/_item2item_list.php');