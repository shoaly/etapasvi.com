<div class="category_wrapper">
    <?php echo __("Category") ?>:
    <select onchange="gotoItemcategory(this.value)">
        <option value="<?php echo ItemcategoryPeer::getUrl($module_action, 'index')?>">&nbsp;<?php echo __("All categories") ?> (<?php echo (int)$total_items_count ?>)</option>
        <?php foreach($itemcategory_tree as $element): ?>
            <?php include_partial('itemcategory/tree_element', array('module_action'=>$module_action, 'element'=>$element, 'item_type_list'=>$item_type_list) ); ?>
        <?php endforeach ?>
    <select>
</div>