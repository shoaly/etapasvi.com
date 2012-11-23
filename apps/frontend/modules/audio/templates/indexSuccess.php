<?php slot('body_id') ?>body_audio<?php end_slot() ?>
<h1><?php echo __('Audio') ?></h1>

<?php include_component('itemcategory', 'show', array('module_action'=>'audio/index', 'item_type_list'=>array(ItemtypesPeer::ITEM_TYPE_AUDIO))); ?>

<?php 
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'audio/index') );
echo $navigation_html;

$audio_list = $pager->getResults();
?>

<?php if (count($audio_list)): ?>
    <?php include_partial( 'audio/list', array('audio_list' => $audio_list)); ?>
<?php else: ?>
	<br/><p class="center_text light"><?php echo __('Category is empty') ?></p>
<?php endif ?>

<?php echo $navigation_html; ?>