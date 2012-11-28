<?php /*slot('meta') ?>
<link rel="canonical" href="<?php echo url_for('news/show?id='.$newsitem->getId() . '&title=' . TextPeer::urlTranslit($newsitem->getTitle()))?>" /><?php end_slot() */ ?>

<?php slot('body_id') ?>body_news<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('News') ?><?php end_slot() ?>

<p class="bread_crumbs">	
	<a href="<?php echo url_for('@main'); ?>"><?php echo __('Home') ?></a> » <a href="<?php echo url_for('@news_index'); ?>"><?php echo __('News') ?></a>
</p>

<div class="box newsitem newsfull">
    <?php include_partial('show', array('newsitem'=>$newsitem) ); ?>
</div>