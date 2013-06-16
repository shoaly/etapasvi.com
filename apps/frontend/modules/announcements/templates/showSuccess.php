<?php slot('body_id') ?>body_announcements<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Announcements') ?><?php end_slot() ?>

<?php if (($announcements->getAllCultures() && $sf_user->getCulture() != sfConfig::get('sf_default_culture') && $announcements->getTitle($sf_user->getCulture(), true) == $announcements->getTitle(sfConfig::get('sf_default_culture')))): ?>
    <?php slot('robots') ?>noindex,nofollow<?php end_slot() ?>
<?php endif ?>

<p class="bread_crumbs">
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@announcements_index'); ?>"><?php echo __('Announcements') ?></a>
</p>

<?php include_component('announcements', 'show', array('id'=>$id, 'title'=>$title, 'announcements'=>$announcements)); ?>

<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_DOCUMENTS), 'id'=>$id));*/ ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_ANNOUNCEMENTS), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>

<?php include_partial('global/go_to_top'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        track_updated_mark_read('<?php echo strtotime($announcements->getCreatedAt()); ?>', '<?php echo ItemtypesPeer::ITEM_TYPE_ANNOUNCEMENTS; ?>', '<?php echo $announcements->getId() ?>');
    });
</script>