<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<h1><?php echo __('Photo') ?></h1>

<?php 
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'photo/index') ); 
echo $navigation_html;
?>

<?php if (count($pager->getResults())): ?>
	<table id="photo_list">
		<?php $i = 1; ?>
		<?php foreach ($pager->getResults() as $photo): ?>
			<?php if ($i == 1): ?>
				<tr>
			<?php endif ?>
			<td><?php include_partial('show', array('photo'=>$photo, 'short'=>true) ); ?></td>
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
	<p class="center error_list p2">
		<?php echo __('No Photos') ?>
	</p>
<?php endif ?>

<?php echo $navigation_html; ?>