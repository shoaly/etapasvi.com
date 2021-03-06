<?php if (!empty($documents)): ?>
    <div class="documents_full">
    <?php
    // если Заголовок или Автор не указан на текущем языке берём из языка по умолчанию
    $title  = $documents->getTitle($sf_user->getCulture(), true);
    ?>
    <?php include_partial('documents/listHeader'); ?>
    <tr>
        <td class="main_col"><h1 class="simple_title"><strong><?php echo $title; ?></strong></h1></td>
        <td><div class="files <?php echo $documents->getType(); ?>"><?php echo $documents->getType(); ?></div></td>
        <td><?php echo $documents->getSizePrepared(); ?></td>
        <td><?php echo format_datetime( $documents->getCreatedAt(), 'd MMMM yyyy'); ?></td>
        <td><?php echo format_datetime( $documents->getUpdatedAt(), 'd MMMM yyyy'); ?></td>
        <td><a href="<?php echo $documents->getDirectUrl(); ?>" <?php if ($documents->getNewsId()): ?>rel="nofollow"<?php endif ?> target="_blank" class="save" title="<?php echo __('Download'); ?>"></a>
            <a href="http://docs.google.com/viewer?url=<?php echo urlencode($documents->getDirectUrl()); ?>" rel="nofollow" target="_blank" title="Google Docs"><img src="/i/google_doc.gif" /></a>
        </td>
    </tr>
   <?php if (!$hide_wrapper): ?>
    </table>
    <?php include_component('itemcategory', 'showitemcategories', array(
            'item_type'     => ItemtypesPeer::ITEM_TYPE_DOCUMENTS,
            'item_id'       => $documents->getId(),
            'module_action' => 'documents/index'));
    ?><br/>
    <?php endif ?>
    <?php include_component('item2item', 'show', array('item_type'=>ItemtypesPeer::ITEM_TYPE_DOCUMENTS, 'item_id'=>$documents->getId())) ?>
    </div>
<?php endif ?>