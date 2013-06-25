<?php if (!empty($announcements)): ?>
    <?php
    // если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
    $body = $announcements->getBody($sf_user->getCulture(), true);
    ?>
    <div class="announcements_container">
        <h1 class="announcements_container_inner title">
            <?php if ($announcements->getCreatedAt()): ?>
                <span class="date">[<?php echo format_datetime($announcements->getCreatedAt(), 'd MMMM yyyy'); ?>]</span>
            <?php endif ?>
            <?php echo $body; ?>
        </h1>
    </div>
    <?php
    include_component('itemcategory', 'showitemcategories', array(
        'item_type' => ItemtypesPeer::ITEM_TYPE_ANNOUNCEMENTS,
        'item_id' => $announcements->getId(),
        'module_action' => 'announcements/index'));
    ?><br/>

    <?php include_component('item2item', 'show', array('item_type' => ItemtypesPeer::ITEM_TYPE_ANNOUNCEMENTS, 'item_id' => $announcements->getId())) ?>

    <?php
 endif ?>