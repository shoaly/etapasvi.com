<?php slot('body_id') ?>body_<?php echo $type ?><?php end_slot() ?>
<h1><?php echo __('News') ?></h1>

<?php include_component('itemcategory', 'show', array('item_type_list'=>array(ItemtypesPeer::ITEM_TYPE_NEWS))); ?>

<?php 
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'news/index') ); 
echo $navigation_html;

$news_list = $pager->getResults();
?>

<?php if (count($news_list)): ?>
	<?php include_partial('news/list', array('news_list'=>$news_list)); ?>
<?php else: ?>
	<p class="center error_list p2">
		<?php echo __('No News') ?>.
	</p>
<?php endif ?>

<?php echo $navigation_html; ?>

<?php include_partial('comments/count'); ?>

<?php if ($type == NewstypesPeer::$type_names[NewstypesPeer::NEWS_TYPE_TEACHINGS]): ?>
<br/>
<a href="https://docs.google.com/document/d/10igx0jLsoVeemdKxEasxJG5xbrqI2cfRWh3pJnn28iQ/edit"><?php echo __("Dictionary") ?></a> (<?php echo __("by Andy Good/LTJ") ?>)
<?php endif ?>