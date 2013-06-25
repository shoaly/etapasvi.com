<?php if (!empty($audio)): ?>
<?php
// если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
$title  = $audio->getTitle($sf_user->getCulture(), true);
$body   = $audio->getBodyPrepared($sf_user->getCulture(), true);
$author = $audio->getAuthor($sf_user->getCulture(), true);

/*
<script type="text/javascript">
    $(document).ready(function(){
        $("#audio_<?php echo $audio->getId(); ?>").jmp3({
            width: 22
        });
    });
</script>
 */ ?>
<div id="audio_<?php echo $audio->getId(); ?>" class="audio_item">
<h1 class="title"><?php echo $author; ?> - <?php echo $title; ?></h1>

<div class="light small audio_descr">
    <strong><?php echo __('Uploaded on') ?>:</strong> <?php echo format_datetime( $audio->getCreatedAt(), 'd MMMM yyyy'); ?> |
    <strong><?php echo __('Duration') ?>:</strong>  <?php echo $audio->getDurationFormatted(); ?> |
    <strong><?php echo __('Size') ?>:</strong>  <?php echo $audio->getSizePrepared(); ?> |
    <a href="<?php echo $audio->getDirectUrl(); ?>" target="_blank" title="<?php echo __('Download'); ?>"><?php echo __('Download'); ?></a>
    <?php if (!empty($body)): ?>
         |  <a href="javascript:showAudioBody('<?php echo $audio->getId(); ?>')"><?php echo __('Lyrics'); ?></a>
    <?php else: ?>
    <?php endif ?>
</div>

<?php/*
<object type="application/x-shockwave-flash" data="http://kiwi6.com/swf/player.swf" class="audioplayer" height="22" width="290" allowscriptaccess="always">
<param name="movie" value="http://kiwi6.com/swf/player.swf" /><param name="FlashVars" value="playerID=audioplayer&amp;soundFile=<?php echo $audio->getDirectUrl(); ?>" />
<param name="quality" value="high" /><param name="menu" value="false" /><param name="allowscriptaccess" value="always" /><param name="wmode" value="transparent" /></object>
 * */ ?>
<a class="audio" href="<?php echo $audio->getDirectUrl(false); ?>"><?php echo $title; ?></a>
<br/><br/>
<?php if ($body): ?>
<p id="elAudioBody<?php echo $audio->getId(); ?>" class="hidden">
    <?php echo html_entity_decode($body); ?>
</p>
<?php endif ?>
<?php include_component('itemcategory', 'showitemcategories', array(
            'item_type'     => ItemtypesPeer::ITEM_TYPE_AUDIO,
            'item_id'       => $audio->getId(),
            'module_action' => 'audio/index'));
?>
<?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_AUDIO, 'item_id'=>$audio->getId())) ?>
</div>
<?php endif ?>