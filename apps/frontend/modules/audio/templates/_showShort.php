<?php if (!empty($audio)): ?>
<?php
// если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
$title  = $audio->getTitle($sf_user->getCulture(), true);
$author = $audio->getAuthor($sf_user->getCulture(), true);
?>
<div id="audio_<?php echo $audio->getId(); ?>" class="audio_item">
<a href="<?php echo $audio->getUrl(); ?>" class="left"><strong><?php echo $author; ?></strong> - <?php echo $title; ?></a> <i class="right"><?php echo $audio->getDurationFormatted(); ?></i>
<br />
<?php /*
<object type="application/x-shockwave-flash" data="http://kiwi6.com/swf/player.swf" class="audioplayer" height="22" width="290" allowscriptaccess="always">
<param name="movie" value="http://kiwi6.com/swf/player.swf" /><param name="FlashVars" value="playerID=audioplayer&amp;soundFile=<?php echo $audio->getDirectUrl(); ?>" />
<param name="quality" value="high" /><param name="menu" value="false" /><param name="allowscriptaccess" value="always" /><param name="wmode" value="transparent" /></object>*/ ?>
<?php /*<audio class="mejs-ted" src="<?php echo $audio->getDirectUrl(false); ?>" type="audio/mp3" controls="controls">*/ ?>
<a class="audio" href="<?php echo $audio->getDirectUrl(false); ?>"><?php echo $title; ?></a>
</div>
<?php endif ?>