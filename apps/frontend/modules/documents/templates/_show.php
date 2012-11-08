<?php if (!empty($documents)): ?>
    <?php 
    // если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
    $title  = $documents->getTitle($sf_user->getCulture(), true);
    ?>
    <?php include_partial('documents/listHeader'); ?>	
    <tr>
        <td class="main_col"><?php echo $title; ?></td>
        <td><span class="files <?php echo $documents->getType(); ?>"><?php echo $documents->getType(); ?></span></td>
        <td><?php echo $documents->getSizePrepared(); ?></td>
        <td><?php echo format_datetime( $documents->getCreatedAt(), 'd MMMM yyyy'); ?></td>
        <td><?php echo format_datetime( $documents->getUpdatedAt(), 'd MMMM yyyy'); ?></td>
        <td><a href="<?php echo $documents->getDirectUrl(); ?>" target="_blank" class="save" title="<?php echo __('Download'); ?>"></a></td>
    </tr>
   <?php if (!$hide_wrapper): ?>
    </table>
    <?php endif ?>
<?php endif ?>