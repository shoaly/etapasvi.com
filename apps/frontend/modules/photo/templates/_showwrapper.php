<?php /*slot('meta') ?>
<link rel="canonical" href="<?php echo url_for('photo/show?id='.$photo->getId() . '&title=' . TextPeer::urlTranslit($photo->getTitle())); ?>" />
<?php end_slot()*/ ?>

<?php if ( !$photo->getTitle(sfConfig::get('sf_default_culture')) || ($sf_user->getCulture() != sfConfig::get('sf_default_culture') && $photo->getTitle($sf_user->getCulture(), true) == $photo->getTitle(sfConfig::get('sf_default_culture')))): ?>
    <?php slot('noindex') ?>true<?php end_slot() ?>
<?php endif ?>

<p class="bread_crumbs">
<?php
    $photoalbum       = $photo->getPhotoalbum();
    if (!empty($photoalbum)) {
      $photoalbum_title = $photoalbum->getTitle($sf_user->getCulture(), true);
    }
?>
    <a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('photoalbum_index'); ?>"><?php echo __('Photo Albums') ?></a>
    <?php if (!empty($photoalbum)):?> » <a href="<?php echo $photoalbum->getUrl(); ?>"><?php echo ($photoalbum_title ? $photoalbum_title : __('Photo Album')); ?></a><?php endif ?>
</p>

<div class="box photofull">
    <?php include_partial('show', array('photo'=>$photo, 'next_photo'=>$next_photo, 'prev_photo'=>$prev_photo, 'item2item_html'=>$item2item_html) ); ?>
</div>