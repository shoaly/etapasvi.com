<?php if ($element['object']): ?>
    <?php $items_count = $element['object']->getItemsCountByItemType($item_type_list); ?>
    <option value="<?php echo $element['object']->getUrl($module_action); ?>" <?php if ($sf_params->get('itemcategory') == $element['object']->getCode()): ?>selected="selected"<? endif ?>>&nbsp;<?php if ($element['level'] > 1): ?><?php for($padding=1; $padding<$element['level']; $padding++): ?>--<?php endfor?> <?php endif ?><?php echo $element['object']->getTitle(); ?><?php if ($items_count): ?> (<?php echo (int)$items_count; ?>)<?php endif ?>&nbsp;</option>
<?endif ?>
<?php foreach($element['children'] as $children): ?>
    <?php include_partial('itemcategory/tree_element', array('module_action'=>$module_action, 'element'=>$children, 'item_type_list'=>$item_type_list) ); ?>
<?php endforeach ?>