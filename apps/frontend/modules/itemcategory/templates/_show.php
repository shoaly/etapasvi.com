<div class="category_wrapper">
    <?php echo __("Category") ?>:
    <select onchange="gotoItemcategory(this.value)">
        <option value="">&nbsp;</option>
        <?php foreach($itemcategory_tree as $element): ?>
            <?php include_partial('itemcategory/tree_element', array('element'=>$element) ); ?>
        <?php endforeach ?>
    <select>
</div>