<?php slot('alternate') ?>
<link rel="alternate" type="application/rss+xml" title="<?php echo __('Feed') ?>" href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" />
<?php end_slot() ?>

<?php slot('page_header') ?><?php echo __('Maha Sambodhi Dharma Sangha Guru') ?><br/><?php echo __('A message of peace, an appeal to the world') ?><?php end_slot() ?>
<?php slot('body_id') ?>body_main<?php end_slot() ?>

<?php $live_html = get_component( 'video', 'live' ); ?>

<?php if (trim($live_html)): ?>
    <h2><?php echo __('Live Video') ?></h2>
    <?php echo $live_html; ?>
    <p class="goto_section">
        <a href="<?php echo url_for('video_live'); ?>" class="no_decor"><?php echo __('Live Video') ?> »</a>
    </p>
    <br/><br/>
<?php else: ?>
    <?php include_partial('photo/carousel'); ?>
<?php endif ?>

<?php include_component('news', 'latest'); ?>
<p class="goto_section">
	<a href="<?php echo url_for('news_index'); ?>" class="no_decor"><?php echo __('News') ?> »</a>
</p>

<h2><?php echo __('Announcements') ?></h2>
<?php include_component('announcements', 'latest'); ?>
<p class="goto_section">
	<a href="<?php echo url_for('announcements_index'); ?>" class="no_decor"><?php echo __('Announcements') ?> »</a>
</p>

<h2><?php echo __('Photo') ?></h2>
<?php include_component('photo', 'latest'); ?>
<p class="goto_section">
	<a href="<?php echo url_for('photoalbum_index'); ?>" class="no_decor"><?php echo __('Photo') ?> »</a>
</p>

<h2><?php echo __('Video') ?></h2>
<?php include_component('video', 'latest'); ?>
<p class="goto_section">
	<a href="<?php echo url_for('video_index'); ?>" class="no_decor"><?php echo __('Video') ?> »</a>
</p>

<h2><?php echo __('Audio') ?></h2>
<?php include_component('audio', 'latest'); ?>
<p class="goto_section">
	<a href="<?php echo url_for('audio_index'); ?>" class="no_decor"><?php echo __('Audio') ?> »</a>
</p>

<h2><?php echo __('Documents') ?></h2>
<?php include_component('documents', 'latest'); ?>
<p class="goto_section">
	<a href="<?php echo url_for('documents_index'); ?>" class="no_decor"><?php echo __('Documents') ?> »</a>
</p>

<h2><?php echo __('Teachings') ?></h2>
<?php include_component('documents', 'showTeachings'); ?>
<p class="goto_section">
	<a href="<?php echo url_for('news/index?itemcategory=messages', true); ?>" class="no_decor"><?php echo __('Teachings') ?> »</a>
</p>

<h2><?php echo __('Subscribe to News') ?></h2>
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sf_user->getCulture(); ?>/etapasvi', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
<a href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" class="right"><img src="http://www.feedburner.com/fb/images/pub/feed-icon16x16.png" alt="" class="rss_img"/><img src="http://feeds.feedburner.com/~fc/<?php echo $sf_user->getCulture(); ?>/etapasvi?bg=d4d0c8&amp;fg=444444&amp;anim=0" height="26" width="88" alt="RSS" /></a>
Email: <input type="text" style="width:140px" name="email"/> &nbsp;<input type="hidden" value="<?php echo $sf_user->getCulture(); ?>/etapasvi" name="uri"/><input type="hidden" name="loc" value="<?php echo UserPeer::getCultureFeedburderLoc(); ?>"/><input type="submit" class="input_button" value="<?php echo __('Subscribe') ?>" />
</form>
<br/>
<hr class="dashed"/>
<h2><?php echo __('Social Tools') ?></h2>
<div class="st_container">
<?php include_partial('social_tools/show'); ?>
</div>
<h2><?php echo __('Visitor Map') ?></h2>
<script id="_wauk0a">var _wau = _wau || [];
_wau.push(["map", "ppc9yoe3440f", "k0a", "566", "283", "classic", "heart-red"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/map.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script>
<h2><?php echo __('Recent Comments') ?></h2>
<div class="dsq-widget"><script type="text/javascript" src="http://etapasvi.disqus.com/recent_comments_widget.js?num_items=5&amp;hide_avatars=0&amp;avatar_size=32&amp;excerpt_length=200"></script></div><?php /* <a href="http://disqus.com/">Powered by Disqus</a> */ ?>
<p class="p1_no_top">
    <a href="http://feeds.feedburner.com/etapasvi/comments" class="right" target="_blank"><?php echo __('Comments') ?> »</a><br/>
</p>
<hr class="dashed"/>
<h2><?php echo __('Subscribe to Comments') ?></h2>
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=etapasvi/comments', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
Email: <input type="text" style="width:140px" name="email"/> &nbsp;<input type="hidden" value="etapasvi/comments" name="uri"/><input type="hidden" name="loc" value="<?php echo UserPeer::getCultureFeedburderLoc(); ?>"/><input type="submit" class="input_button" value="<?php echo __('Subscribe') ?>" />
</form>
<br/>

<?php /*include_component('comments', 'show') */ ?>

<?php include_partial('comments/count'); ?>