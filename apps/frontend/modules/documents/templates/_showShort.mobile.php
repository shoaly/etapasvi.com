<?php if (!empty($documents)): ?>
    <?php 
    // если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
    $title  = $documents->getTitle($sf_user->getCulture(), true);
    ?>
    <div class="doc_short <?php if ($last): ?>last<?php endif ?>">
    <a href="<?php echo $documents->getUrl(); ?>"><?php echo $title; ?></a> (<?php echo $documents->getType(); ?>, <?php echo $documents->getSizePrepared(); ?>)
    </div>
<?php endif ?>