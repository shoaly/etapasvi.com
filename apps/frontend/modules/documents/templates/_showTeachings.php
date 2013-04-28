<?php if ($document): ?>
    <?php include_partial('documents/showShort', array('documents'=>$document, 'short'=>true, 'last'=>true)); ?>
<?php endif; ?>