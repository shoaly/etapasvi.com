<?php 
if ($item) {
    $item2item_list = Item2itemPeer::getAllRelatedObjects($item_type_id, $item->getId());
}
?>
<?php if (!empty($item2item_list) && count($item2item_list)): ?>
    <ul>
    <?php foreach($item2item_list as $i=>$tem2item): ?>
        <li><a href="<?php echo '/'.$sf_user->getCulture().'/'.strtolower($tem2item->getItemTypeName()).'/'.$tem2item->getId(); ?>"><?php echo $tem2item->getItemTypeName(); ?> | <?php echo $tem2item->getId(); ?> | <?php echo $tem2item->getTitle($sf_user->getCulture(), true); ?></a></li>
    <?php endforeach; ?>
    </ul>
<? endif ?>
