<?php if (!empty($itemcategory_list) && count($itemcategory_list)): ?>
    <div class="itemcategories_list">
    <img src="http://<?php echo sfConfig::get('app_domain_name'); ?>/i/tag.png" width="16" height="16"/> 
    <?php foreach($itemcategory_list as $i=>$itemcategory): ?>
        <?php $title = $itemcategory->getTitle($sf_user->getCulture(), true); ?>
        <a href="<?php echo $itemcategory->getUrl($module_action); ?>"><?php echo $title; ?></a><?php if (count($itemcategory_list)>1 && $i!=(count($itemcategory_list)-1)): ?> | <?php endif ?>
    <?php endforeach; ?>
    </div>
<? endif ?>