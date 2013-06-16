<?php slot('body_id') ?>body_announcements<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Announcements') ?><?php end_slot() ?>

<?php slot('robots') ?>noindex<?php end_slot() ?>

<?php include_component('itemcategory', 'show', array('module_action'=>'announcements/index', 'item_type_list'=>array(ItemtypesPeer::ITEM_TYPE_ANNOUNCEMENTS), 'items_count_total'=>$pager->getNbResults())); ?>

<?php
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'announcements/index') );
echo $navigation_html;

$announcements_list = $pager->getResults();
?>

<?php if (count($announcements_list)): ?>
    <?php include_partial( 'announcements/list', array('announcements_list' => $announcements_list)); ?>
<?php else: ?>
	<br/><p class="center_text light"><?php echo __('Category is empty') ?></p>
<?php endif ?>

<?php echo $navigation_html; ?>