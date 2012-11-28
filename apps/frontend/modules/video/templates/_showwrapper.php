<?php /*slot('meta') ?>
<?php 
if (!empty($back_to_video)) {
	$back_to_video = preg_replace('/.com\/([a-z]{2})\//', '.com/' . $sf_user->getCulture() . '/', $back_to_video);
} else {
	$back_to_video = url_for('@video_index');
}
?>
<link rel="canonical" href="<?php echo url_for('video/show?id='.$video->getId() . '&title=' . TextPeer::urlTranslit($video->getTitle())); ?>" />
<?php end_slot()*/ ?>
<?php slot('body_id') ?>body_video<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Video') ?><?php end_slot() ?>

<p class="bread_crumbs">	
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@video_index'); ?>"><?php echo __('Video') ?></a>
</p>

<?php include_partial('show', array('video'=>$video, 'autoplay'=>true) ); ?>