<?php if ($video): ?>
	<?php
    $title          = $video->getTitle($sf_user->getCulture(), true);
    $code           = $video->getCode($sf_user->getCulture(), true);
    $href           = $video->getUrl();
	?>
    <div class="frame video_teaser">
        <div class="center_text">
            <?php include_partial('video/code', array('code'=>$code, 'autoplay'=>false)); ?>
		</div>
        <div class="video_info">
            <a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
        </div>
	</div>
<?php endif ?>