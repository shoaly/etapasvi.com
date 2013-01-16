<div id="photo_content">

<?php include_component('photo', 'showwrapper', array('id'=>$id, 'title'=>$title, 'photo'=>$photo, 'no_check_title'=>$no_check_title, 'next_photo'=>$next_photo, 'prev_photo'=>$prev_photo, 'item2item_html'=>$item2item_html)); ?>
<?php /* include_partial('comments/tools', array('empty'=>true));*/ ?>

<?php 
// http://tasks.etapasvi.com/issues/389#note-6
// http://www.electrictoolbox.com/running-javascript-functions-after-disqus-loaded/
?>
<script type="text/javascript">
    preparePhotoContent();
    <?php /*
    // изменение размера всплывающего окна после загрузки комментариев
    function disqus_config() {
    alert(1):
        this.callbacks.afterRender = [function() {
        alert(2):
            if (page_mode == "enlarge_photo") {
                cbResize();
            }
        }];
    }
    */ ?>
</script>

<?php if (!empty($photo)): ?>
    <?php $comments_identifier = CommentsPeer::getCommentsIdentifier('', '', '', array('id'=>$photo->getId())); ?>
<?php else: ?>
    <?php $comments_identifier = CommentsPeer::getCommentsIdentifier('', '', '', array('id'=>$id)); ?>
<?php endif ?>
<div class="like-toolbar"><?php include_partial('global/like', array('identifier'=>$comments_identifier, 'init'=>true));  ?></div>

<div id="photo_comments">    
    <?php if (!empty($photo)): ?>
        <?php include_partial('comments/count'); ?>
        <a href="#" onclick="showPhotoComments(this)"><?php echo __('Comments') ?></a>: <a href="#disqus_thread" onclick="showPhotoComments(this)" data-disqus-identifier="<?php echo $comments_identifier; ?>" class="no_decor">0</a>
        <div id="photo_comments_code" style="display:none"><?php echo base64_encode( get_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_PHOTO), 'id'=>$photo->getId(), 'culture'=>$sf_user->getCulture(), 'comments_page_url'=>$photo->getUrl(), 'no_toolbar'=>true) )); ?></div>
    <?php else : ?>
        <?php echo get_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_PHOTO), 'id'=>$id, 'culture'=>$sf_user->getCulture(), 'comments_page_url'=>PhotoPeer::getUrl($id, $sf_user->getCulture()), 'no_toolbar'=>true) ); ?>
<?php endif ?>
</div>

</div>