<option value="<?php echo $element['object']->getUrl(); ?>">&nbsp;<?php if ($element['level'] > 1): ?><?php for($padding=1; $padding<$element['level']; $padding++): ?>--<?php endfor?> <?php endif ?><?php echo $element['object']->getTitle(); ?><?php if ($element['object']->getItemsCount()): ?> (<?php echo (int)$element['object']->getItemsCount(); ?>)<?php endif ?></option>
<?php foreach($element['children'] as $children): ?>
    <?php include_partial('itemcategory/tree_element', array('element'=>$children) ); ?>
<?php endforeach ?>