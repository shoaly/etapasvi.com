<?php if ($photo): ?>

	<?php
    // если есть Заголовок на языке пользователя, выводим, его
    // если есть Заголовок на английском, выводим его
    $title = $photo->getTitle($sf_user->getCulture(), true);
    ?>
    <?php
        $photoalbum = $photo->getPhotoalbum();
        if ($photoalbum) {
            $photoalbum_id = $photoalbum->getId();
        }
    ?>

	<?php if ($photo->getImg()): ?>
		<?php if (!empty($short) && $short): ?>
			<?php if (!empty($embed)): ?>
                <?php if (empty($align)): ?>
                    <?php // $embed_photo_align поочерёдно выравнивает фото по левому и правому краю ?>
                    <?php if (PhotoPeer::$embed_photo_align != 'left') : ?>
                        <?php $align = 'left'; ?>
                    <?php else: ?>
                        <?php $align = 'right'; ?>
                    <?php endif ?>
                <?php endif ?>
                <?php PhotoPeer::$embed_photo_align = $align; ?>
                <div class="embed_photo embed_photo_<?php echo $align; ?><?php if ($in_list): ?> extra_space_<?php echo $align; ?><?php endif ?>">
                <?php endif ?>
                <a href="<?php echo $photo->getUrl(); ?>" title="<?php echo $title; ?>" onclick="enlargePhoto('<?php echo $photo->getUrl(); ?>', false, '<?php echo $photoalbum_id; ?>', this);return false;">
                    <img src="<?php echo $photo->getThumbUrl(); ?>" alt=""/></a>
                <?php /* <script type="text/javascript"> phLinks(); </script>*/ ?>
                <?php if ($title): ?>
                    <br/><span class="light"><?php echo $title; ?></span>
                <?php endif ?>
                <?php if ($show_body && $photo->getBody($sf_user->getCulture(), true)): ?>
                    <br/><br/><?php echo html_entity_decode($photo->getBodyPrepared()); ?>
                <?php endif ?>
                <?php if (!empty($embed)): ?>
                </div>
			<?php endif ?>
		<?php else: ?>

			<div class="center_text prev_next" style="<?php if (!$prev_photo):?>padding-left:16px;<?php endif ?> <?php if (!$next_photo):?>padding-right:16px;<?php endif ?>">

				<?php
				if ($next_photo && $photo->getShow()):
                    $next_url = $next_photo->getUrl();
				?>
					<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>" onclick="loadPhotoContent('<?php echo $next_url; ?>', '<?php echo $photoalbum_id; ?>');return false;" rel="nofollow">
                        <?php /* attention: img is used in replace in JS */ ?>
						<img src="<?php echo $photo->getFullUrl(); ?>" class="full_photo_img"
						alt="<?php echo $title; ?>"  /></a>
				<?php else: ?>
					<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>" onclick="loadPhotoContent('<?php echo $prev_url; ?>', '<?php echo $photoalbum_id; ?>');return false;" rel="nofollow"><img src="<?php echo $photo->getFullUrl(); ?>" class="full_photo_img" alt="<?php echo $title; ?>" /></a>
				<?php endif ?>
				<?php/*
				if ($next_photo && $photo->getShow()):
				?>
					<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>" class="next_icon" onclick="loadPhotoContent('<?php echo $next_url; ?>', '<?php echo $photoalbum_id; ?>');return false;" rel="nofollow"></a>
				<?php endif*/ ?>
                <?php
				if ($prev_photo && $photo->getShow()):
                    $prev_url = $prev_photo->getUrl();
				?>
					<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>" class="prev_icon" onclick="loadPhotoContent('<?php echo $prev_url; ?>', '<?php echo $photoalbum_id; ?>');return false;" rel="nofollow"></a>
				<?php endif ?>
                <input type="hidden" id="photo_full_info" value="{'url':'<?php echo $photo->getFullUrl(); ?>', 'width':'<?php echo $photo->getWidth(); ?>', 'height':'<?php echo $photo->getHeight(); ?>'}"/>
                <input type="hidden" id="photo_preview_info" value="{'url':'<?php echo $photo->getPreviewUrl(); ?>','prev_url':'<?php echo ($prev_photo && $prev_photo->getShow() ? $prev_photo->getPreviewUrl() : ''); ?>','next_url':'<?php echo ($next_photo && $next_photo->getShow() ? $next_photo->getPreviewUrl() : ''); ?>'}" />
			</div>
            <?php /*<img src="http://<?php echo sfConfig::get('app_domain_name'); ?>/i/jquery/colorbox/loading.gif" id="photo_loader" class="hidden center_text" />*/ ?>
		<?php endif ?>
	<?php endif ?>


	<?php if (empty($short) || !$short): ?>

        <div class="photo_info">
            <?php if ($title): ?>
                <div class="center_text p1">
                    <h1 class="simple_title"><?php echo $title; ?></h1>
                </div>
            <?php endif ?>
            <p class="center_text small light p1_no_bottom">
                <span class="date"><?php echo format_datetime( $photo->getCreatedAt('Y-m-d H:i:s', true), 'd MMMM yyyy'); ?></span>
                <?php
                    $photoalbum = $photo->getPhotoalbum();
                    if ($photoalbum) {
                        $photoalbum_id = $photoalbum->getId();
                    }
                    $author     = $photo->getAuthor($sf_user->getCulture(), true);

                    if ($author == '?') {
                        $author = __('If this photo has been made by you, please, let us know');
                    }
                    if ($author == '-') {
                        $author = '';
                    }
                ?>

                <?php if ($author): ?>
                     | <?php echo __('Author') ?>: <?php echo $author ?>
                <?php endif ?>
                 | <a href="<?php echo $photo->getFullUrl(); ?>"
                    title="<?php echo __('Download') ?>" target="_blank" ><?php echo __('Download') ?></a>
                 <?php if ($photoalbum_id): ?>
                    <span class="ph_enlarge_lnk">| <a href="javascript:enlargePhoto('<?php echo $photo->getUrl(); ?>', true, '<?php echo $photoalbum_id; ?>');void(0);" title="<?php echo __('Enlarge') ?>" rel="nofollow"><?php echo __('Enlarge') ?></a></span>
                 <?php endif ?>
            </p>
            <?php if ($photo->getBody($sf_user->getCulture(), true)): ?>
                <br/>
            <?php echo html_entity_decode($photo->getBodyPrepared()); ?><br/>
            <?php endif ?>
            <?php if ($photo->getLink()): ?>
                <p class="p1_no_bottom source">
                    <strong><?php echo __('Source') ?>:</strong> <a href="<?php echo $photo->getLink(); ?>"><?php echo TextPeer::cropLink($photo->getLink()); ?></a>
                </p>
            <?php endif ?>
        </div>
        <?php /*
		<hr class="light"/>

		<p class="center_text prev_next">
			<?php
			if ($prev_photo && $photo->getShow()):
			?>
				<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$prev_photo->getImg(); ?>" style="display:none;"/>

				<a href="<?php echo $prev_url; ?>" title="<?php echo __('Prev') ?>"><img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$prev_photo->getImg(); ?>" alt="<?php echo __('Prev') ?>"/></a>
				&nbsp;&nbsp;&nbsp;&nbsp;
			<?php endif ?>


			<?php if ($next_photo && $photo->getShow()): ?>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo $next_url; ?>" title="<?php echo __('Next') ?>">
					<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$next_photo->getImg(); ?>" alt="<?php echo __('Next') ?>"/></a>


				<img src="<?php echo '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$next_photo->getImg(); ?>" style="display:none;"/>
			<?php endif ?>
		</p>
 */ ?>

 			<?php if ($prev_photo && $prev_photo->getShow()): ?>
				<?php /*<img src="<?php echo $prev_photo->getPreviewUrl(); ?>" style="display:none;"/>*/ ?>
				<img src="<?php echo $prev_photo->getFullUrl(); ?>" id="prev_photo_preview" style="display:none;"/>
 			<?php endif ?>
            <?php if ($next_photo && $next_photo->getShow()): ?>
				<?php /*<img src="<?php echo $next_photo->getPreviewUrl(); ?>" style="display:none;"/> */ ?>
				<img src="<?php echo $next_photo->getFullUrl(); ?>" id="next_photo_preview" style="display:none;"/>
			<?php endif ?>
 <?php /*
	<table class="photo_list">
		<tr>
            <td>
			<?php if ($prev_photo && $prev_photo->getShow()): ?>
				<img src="<?php echo $prev_photo->getPreviewUrl(); ?>" style="display:none;"/>
                <?php
                    $prev_title = $prev_photo->getTitle($sf_user->getCulture(), true);
                    if (!$prev_title) {
                        $prev_title = __('Prev');
                    }
                ?>
				<a href="<?php echo $prev_url; ?>" title="<?php echo $prev_title ?>" class="photo_content_link"><img src="<?php echo $prev_photo->getThumbUrl(); ?>" alt="<?php echo $prev_title ?>"/></a>
			<?php endif ?>
            </td>
            <td>
				<img src="<?php echo $photo->getThumbUrl(); ?>" class="current_photo"/>
            </td>
            <td>
			<?php if ($next_photo && $next_photo->getShow()): ?>
                <?php
                    $next_title = $next_photo->getTitle($sf_user->getCulture(), true);
                    if (!$next_title) {
                        $next_title = __('Next');
                    }
                ?>
				<a href="<?php echo $next_url; ?>" title="<?php echo $next_title ?>" class="photo_content_link">
					<img src="<?php echo $next_photo->getThumbUrl(); ?>" alt="<?php echo $next_title ?>"/></a>
				<img src="<?php echo $next_photo->getPreviewUrl(); ?>" style="display:none;"/>
			<?php endif ?>
            </td>
		</tr>
	</table>
    */ ?>
    <div id="photo_content_title" class="hidden"><?php if ($title): ?><?php echo $title; ?> <?php else: echo __('Photo')?><?php endif ?> - <?php echo sfConfig::get('app_site_name'); ?></div>
    <?php if ($photoalbum_id): ?>
        <?php include_component('itemcategory', 'showitemcategories', array(
                                'item_type'     => ItemtypesPeer::ITEM_TYPE_PHOTOALBUM,
                                'item_id'       => $photoalbum_id,
                                'module_action' => 'photoalbums/index'));
        ?>
    <?php endif ?>
    <div class="photo_info">
        <?php if (!$item2item_html): ?>
            <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, 'item_id'=>$photo->getPhotoalbumId())) ?>
        <?php else: ?>
            <?php echo html_entity_decode($item2item_html); ?>
        <?php endif ?>
    </div>
	<?php endif ?>
<?php endif ?>