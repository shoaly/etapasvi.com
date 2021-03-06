<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Photo Album') ?><?php end_slot() ?>

<?php if ($sf_user->getCulture() != sfConfig::get('sf_default_culture') && $photoalbum->getTitle($sf_user->getCulture(), true) == $photoalbum->getTitle(sfConfig::get('sf_default_culture'))): ?>
    <?php slot('robots') ?>noindex<?php end_slot() ?>
<?php endif ?>

<?php
/*
$navigation_html = get_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'photo/album?id=' . $sf_request->getParameter('id') ) );
echo $navigation_html;*/

$photo_list = $pager->getResults();

$author = $photoalbum->getAllAuthors($sf_user->getCulture(), $photo_list);
?>

<p class="bread_crumbs">
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('photoalbum_index'); ?>"><?php echo __('Photo Albums') ?></a>
</p>
<div class="photoalbum_wrapper">
    <div class="box photoalbum_container">
    <h1 class="title"><?php echo $photoalbum->getTitle($sf_user->getCulture(), true);?></h1>
    <p class="light center_text small">
        <strong><?php echo __('Date') ?>:</strong> <?php echo format_datetime( $photoalbum->getCreatedAt(), 'd MMMM yyyy'); ?> |
        <strong><?php echo __('Photo') ?>:</strong> <?php echo $photoalbum->countPhotos(); ?>
        <?php if ($author): ?>
            | <strong><?php echo __('Author') ?>:</strong> <?php echo $author ?>
        <?php endif ?>
    </p>
    <?php include_component('itemcategory', 'showitemcategories', array(
                            'item_type'     => ItemtypesPeer::ITEM_TYPE_PHOTOALBUM,
                            'item_id'       => $photoalbum->getId(),
                            'module_action' => 'photoalbums/index'));
    ?>
    <?php $body = $photoalbum->getBody($sf_user->getCulture(), true); ?>
    <?php if($body): ?>
        <p><?php echo $body;?></p>
    <?php endif ?>
    </div>

    <?php if (count($photo_list )): ?>
        <?php include_partial('photo/list', array('photo_list'=>$photo_list)); ?>
    <?php else: ?>
        <p class="center error_list p2">
            <?php echo __('No Photos') ?>
        </p>
    <?php endif ?>
</div>

<?php /*echo $navigation_html;*/ ?>

<?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, 'item_id'=>$photoalbum->getId())) ?>


<?php include_component('comments', 'show'); ?>