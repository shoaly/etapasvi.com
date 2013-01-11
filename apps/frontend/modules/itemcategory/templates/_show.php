<div class="category_wrapper">
    <?php echo __("Category") ?>:
    <select onchange="gotoItemcategory(this.value)">
        <option value="<?php echo ItemcategoryPeer::getUrl($module_action, 'index')?>">&nbsp;<?php echo __("All") ?><?php if (!$sf_params->get('itemcategory')): ?> (<?php echo (int)$items_count_total ?>)<?php endif ?></option>
        <?php foreach($itemcategory_tree as $element): ?>
            <?php include_partial('itemcategory/tree_element', array('module_action'=>$module_action, 'element'=>$element, 'item_type_list'=>$item_type_list) ); ?>
        <?php endforeach ?>
    </select>
</div>