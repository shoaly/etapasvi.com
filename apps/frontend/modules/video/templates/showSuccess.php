<?php /*include_component('video', 'showwrapper', array('id'=>$id, 'title'=>$title, 'autoplay'=>true));*/ ?>

<?php if ($video->getAllCultures() && $sf_user->getCulture() != sfConfig::get('sf_default_culture') && $video->getTitle($sf_user->getCulture(), true) == $video->getTitle(sfConfig::get('sf_default_culture'))): ?>
    <?php slot('noindex') ?>true<?php end_slot() ?>
<?php endif ?>

<?php include_partial('video/showwrapper', array('video'=>$video)); ?>
<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_VIDEO), 'id'=>$id));*/ ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_VIDEO), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>

<?php include_partial('global/go_to_top'); ?>