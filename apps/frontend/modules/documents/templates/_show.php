<?php if (!empty($documents)): ?>
    <div class="documents_full">
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
    <?php include_component('itemcategory', 'showitemcategories', array(
            'item_type'     => ItemtypesPeer::ITEM_TYPE_DOCUMENTS, 
            'item_id'       => $documents->getId(),
            'module_action' => 'documents/index')); 
    ?>
    <?php endif ?>
    <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_DOCUMENTS, 'item_id'=>$documents->getId())) ?> 
    </div>
<?php endif ?>