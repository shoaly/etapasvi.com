<?php slot('body_id') ?>body_feed<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Feed') ?><?php end_slot() ?>

<?php slot('noindex') ?>true<?php end_slot() ?>

<?php
include_component(
    'itemcategory',
    'show',
    array('module_action'=>'news/feed',
    'item_type_list'=>array(ItemtypesPeer::ITEM_TYPE_NEWS, ItemtypesPeer::ITEM_TYPE_PHOTOALBUM,
                            ItemtypesPeer::ITEM_TYPE_VIDEO, ItemtypesPeer::ITEM_TYPE_AUDIO, ItemtypesPeer::ITEM_TYPE_DOCUMENTS),
    'items_count_total'=>$count_items
));
?>

<a href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" rel="alternate" type="application/rss+xml" class="rss_link"><img src="http://www.feedburner.com/fb/images/pub/feed-icon16x16.png" alt="" /></a>

<?php
$navigation_html = get_partial(
    'global/navigation',
    array(
        'module_action'      => 'news/feed',
        'have_to_paginate'   => true,
        'first_page'         => 1,
        'last_page'          => $last_page,
        'page'               => $page,
        'page_numbers_list'  => $page_numbers_list
    )
);
echo $navigation_html;
?>
<?php if (count($feed_list)): ?>
    <?php foreach($feed_list as $feed_item): ?>
        <?php if (empty($feed_item['type']) || empty($feed_item['list'])): ?>
            <?php continue; ?>
        <?php endif ?>
        <?php include_partial( strtolower($feed_item['type']) . '/list', array(strtolower($feed_item['type']) . '_list' => $feed_item['list'])); ?>
        <br/>
    <?php endforeach ?>
<?php else: ?>
	<br/><p class="center_text light"><?php echo __('Category is empty') ?></p>
<?php endif ?>

<?php echo $navigation_html; ?>