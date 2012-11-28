<?php slot('body_id') ?>body_audio<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Audio') ?><?php end_slot() ?>

<p class="bread_crumbs">	
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@audio_index'); ?>"><?php echo __('Audio') ?></a>
</p>
<div class="box">
<?php include_component('audio', 'show', array('id'=>$id, 'title'=>$title, 'audio'=>$audio)); ?>
<br/>
</div>
<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_AUDIO), 'id'=>$id));*/ ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_AUDIO), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>	
<?php include_partial('global/go_to_top'); ?>