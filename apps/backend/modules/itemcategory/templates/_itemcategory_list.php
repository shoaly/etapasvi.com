<?php 
if ($item) {
    $itemcategory_list = Item2itemcategoryPeer::getItemCategories($item_type_id, $item->getId());
}
?>
<?php if (!empty($itemcategory_list) && count($itemcategory_list)): ?>
    <?php foreach($itemcategory_list as $i=>$itemcategory): ?>
        <?php $title = $itemcategory->getTitle($sf_user->getCulture(), true); ?>
        <a href="<?php echo '/'.$sf_user->getCulture().'/'.ItemtypesPeer::getItemTypeIndex($item_type_id).'/'.$itemcategory->getCode(); ?>"><?php echo $title; ?></a><?php if (count($itemcategory_list)>1 && $i!=(count($itemcategory_list)-1)): ?>, <?php endif ?>
    <?php endforeach; ?>
<? endif ?>
