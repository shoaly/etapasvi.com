<?php if (!empty($documents)): ?>
    <?php 
    // если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
    $title  = $documents->getTitle($sf_user->getCulture(), true);
    ?>
    <strong><?php echo __('Title'); ?>:</strong> <?php echo $title; ?><br/>
    <strong><?php echo __('Type'); ?>:</strong> <?php echo $documents->getType(); ?><br/>
    <strong><?php echo __('Size'); ?>:</strong> <?php echo $documents->getSizePrepared(); ?><br/>
    <strong><?php echo __('Uploaded on'); ?>:</strong> <?php echo format_datetime( $documents->getCreatedAt(), 'd MMMM yyyy'); ?><br/>
    <strong><?php echo __('Updated on'); ?>:</strong> <?php echo format_datetime( $documents->getUpdatedAt(), 'd MMMM yyyy'); ?><br/>
    <a href="<?php echo $documents->getDirectUrl(); ?>" target="_blank" class="save" title="<?php echo __('Download'); ?>"><?php echo __('Download'); ?></a><br/><br/>

    <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_DOCUMENTS, 'item_id'=>$documents->getId())) ?> 
<?php endif ?>