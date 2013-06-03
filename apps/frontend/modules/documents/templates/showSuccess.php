<?php slot('body_id') ?>body_documents<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Documents') ?><?php end_slot() ?>

<?php if ($documents->getNewsId()): ?>
    <?php slot('noindex') ?>true<?php end_slot() ?>
<?php endif ?>

<p class="bread_crumbs">
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@documents_index'); ?>"><?php echo __('Documents') ?></a>
</p>

<?php include_component('documents', 'show', array('id'=>$id, 'title'=>$title, 'documents'=>$documents)); ?>

<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_DOCUMENTS), 'id'=>$id));*/ ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_DOCUMENTS), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>

<?php include_partial('global/go_to_top'); ?>