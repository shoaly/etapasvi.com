<?php slot('body_id') ?>body_documents<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Documents') ?><?php end_slot() ?>

<?php include_component('itemcategory', 'show', array('module_action'=>'documents/index', 'item_type_list'=>array(ItemtypesPeer::ITEM_TYPE_DOCUMENTS), 'items_count_total'=>$pager->getNbResults())); ?>

<?php 
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'documents/index') ); 
echo $navigation_html;

$documents_list = $pager->getResults();
?>

<?php if (count($documents_list)): ?>
    <?php include_partial( 'documents/list', array('documents_list' => $documents_list)); ?>
<?php else: ?>
	<br/><p class="center_text light"><?php echo __('Category is empty') ?></p>
<?php endif ?>

<?php echo $navigation_html; ?>