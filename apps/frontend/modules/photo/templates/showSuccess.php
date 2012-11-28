<?php /*
<script type="text/javascript">
$(document).ready(function(){
    loadPhotoContentFromHash( '<?php echo $_SERVER['HTTP_HOST']; ?>' );
});
</script>
*/ ?>

<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Photo') ?><?php end_slot() ?>

<?php include_partial('photo/content', array('id'=>$id, 'title'=>$title)) ?>