<?php slot('body_id') ?>body_video<?php end_slot() ?>
<h1><?php echo __('Video') ?></h1>

<?php include_component('itemcategory', 'show', array('module_action'=>'video/index', 'item_type_list'=>array(ItemtypesPeer::ITEM_TYPE_VIDEO))); ?>

<?php 
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'video/index') ); 
echo $navigation_html;

$video_list = $pager->getResults();
?>

<?php if (count($video_list)): ?>
    <?php include_partial( 'video/list', array('video_list' => $video_list)); ?>
<?php else: ?>
	<br/><p class="center_text light"><?php echo __('Category is empty') ?></p>
<?php endif ?>

<?php echo $navigation_html; ?>