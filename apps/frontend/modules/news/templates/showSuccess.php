<?php /*include_component('news', 'showwrapper', array('id'=>$id, 'title'=>$title))*/; ?>

<?php if ($from_revision): ?>
    <?php slot('robots') ?>noindex,nofollow<?php end_slot() ?>
<?php endif ?>

<?php include_partial('news/showwrapper', array('newsitem'=>$newsitem)); ?>
<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_NEWS), 'id'=>$id));*/ ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_NEWS), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>

<?php include_partial('global/go_to_top'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        track_updated_mark_read('<?php echo strtotime($newsitem->getUpdatedAtMax()); ?>', '<?php echo ItemtypesPeer::ITEM_TYPE_NEWS; ?>', '<?php echo $newsitem->getId() ?>');
    });
</script>