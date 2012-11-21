<?php 
if ($itemcategory) {
	//echo image_tag('/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$photo->getImg());
	echo $itemcategory->getItemcategory()->getTitle();
}

?>
