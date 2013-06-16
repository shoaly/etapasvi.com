<?php if (!empty($announcements)): ?>
    <?php
    // если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
    $title = $announcements->getTitle($sf_user->getCulture(), true);
    ?>

    <div class="announcements_container">
        <div class="announcements_container_inner track_updated" data-track_updated_date="<?php echo strtotime($announcements->getCreatedAt()); ?>" data-track_updated_item="<?php echo ItemtypesPeer::ITEM_TYPE_ANNOUNCEMENTS; ?>" data-track_updated_id="<?php echo $announcements->getId() ?>">
            <?php if ($announcements->getCreatedAt()): ?>
                <span class="date">[<?php echo format_datetime($announcements->getCreatedAt(), 'd MMMM yyyy'); ?>]</span>
            <?php endif ?>
            <a href="<?php echo $announcements->getUrl(); ?>"><?php echo $title; ?>...</a>
        </div>
    </div>
    <?php if (!get_slot('track_updated_announcements')): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                track_updated_announcements();
            });
        </script>
    <?php endif ?>
    <?php slot('track_updated_announcements'); ?>1<?php end_slot() ?>
    <?php
 endif ?>