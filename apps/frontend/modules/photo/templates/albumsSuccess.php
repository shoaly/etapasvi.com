<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Photo Albums') ?><?php end_slot() ?>

<?php slot('robots') ?>noindex<?php end_slot() ?>

<?php include_component('itemcategory', 'show', array('module_action'=>'photoalbums/index', 'item_type_list'=>array(ItemtypesPeer::ITEM_TYPE_PHOTOALBUM), 'items_count_total'=>$pager->getNbResults())); ?>

<?php
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'photoalbums/index') );
echo $navigation_html;
?>

<?php if (count($pager->getResults())): ?>
	<table class="album_list">
		<?php $i = 1; ?>
		<?php foreach ($pager->getResults() as $photoalbum): ?>
			<?php if ($i == 1): ?>
				<tr>
			<?php endif ?>
			<td>
                <?php include_partial('photoalbum/show', array('photoalbum'=>$photoalbum) ); ?>
            </td>
			<?php if ($i == 3): ?>
				</tr>
			<?php endif ?>
			<?php if ($i < 3): ?>
				<?php $i++; ?>
			<?php else: ?>
				<?php $i = 1; ?>
			<?php endif ?>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<br/><p class="center_text light"><?php echo __('Category is empty') ?></p>
<?php endif ?>

<?php echo $navigation_html; ?>