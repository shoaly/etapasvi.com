<?php if ($video): ?>
	<?php
    $title          = $video->getTitle($sf_user->getCulture(), true);
    $code           = $video->getCode($sf_user->getCulture(), true);
    $href           = $video->getUrl();
	?>
    <div>
    <?php include_partial('video/code', array('code'=>$code, 'autoplay'=>false, 'wide'=>true)); ?>
    <br/>
    <a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
    </div>
<?php endif ?>