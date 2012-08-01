<?php slot('body_id') ?>body_photo<?php end_slot() ?>
<h1 id="top"><?php echo __('Photo') ?></h1>
<div id="photo_content">
<script type="text/javascript">
    $(document).ready(function() {
        loadPhotoContentByPhotoId(document.location + '');
    });
</script>
<div class="box photofull">
<div class="center_text prev_next" style="width:100%;"><img src='/uploads/photo/preview/<!--#if expr="$REQUEST_URI = /^\/[^\/]+\/photo\/([0-9]+).*/" --><!--#set var="PHOTO_ID" value="$1" --><!--#endif --><!--#echo var="PHOTO_ID" -->.jpg' /></div>
</div>
</div>