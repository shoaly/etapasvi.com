<?php 
if ($item) {
    $itemcategory_list = Item2itemcategoryPeer::getItemCategories($item_type_id, $item->getId());
}
?>
<?php if (!empty($itemcategory_list) && count($itemcategory_list)): ?>
    <ul>
    <?php foreach($itemcategory_list as $i=>$itemcategory): ?>
        <?php $title = $itemcategory->getTitle($sf_user->getCulture(), true); ?>
        <li><a href="<?php echo '/'.$sf_user->getCulture().'/'.ItemtypesPeer::getItemTypeIndex($item_type_id).'/'.$itemcategory->getCode(); ?>"><?php echo $title; ?></a></li>
    <?php endforeach; ?>
    </ul>
<? endif ?>
