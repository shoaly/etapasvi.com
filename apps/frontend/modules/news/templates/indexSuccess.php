<?php slot('body_id') ?>body_news<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('News') ?><?php end_slot() ?>

<?php slot('robots') ?>noindex<?php end_slot() ?>

<?php include_component('itemcategory', 'show', array('module_action'=>'news/index', 'item_type_list'=>array(ItemtypesPeer::ITEM_TYPE_NEWS), 'items_count_total'=>$pager->getNbResults())); ?>

<?php
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'news/index') );
echo $navigation_html;

$news_list = $pager->getResults();
?>

<?php if (count($news_list)): ?>
	<?php include_partial('news/list', array('news_list'=>$news_list)); ?>
<?php else: ?>
    <?php slot('robots') ?>noindex,nofollow<?php end_slot() ?>
	<br/><p class="center_text light"><?php echo __('Category is empty') ?></p>
<?php endif ?>

<?php echo $navigation_html; ?>

<?php include_partial('comments/count'); ?>
<?php /*
<?php if (in_array($sf_request->getParameter('itemcategory'), array('teachings', 'messages', 'prayers'))): ?>
<br/>
<a href="https://docs.google.com/document/d/10igx0jLsoVeemdKxEasxJG5xbrqI2cfRWh3pJnn28iQ/edit"><?php echo __("Dictionary") ?></a> (<?php echo __("by Andy Good/LTJ") ?>)
<?php endif ?>
 */ ?>


<?php if (in_array($sf_request->getParameter('itemcategory'), array('teachings', 'messages'))): ?>
    <br/><br/>
    <?php include_component('documents', 'showTeachings'); ?>
<?php endif; ?>
