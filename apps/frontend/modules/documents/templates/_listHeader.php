<table class="documents_tbl <?php if (empty($short) || !$short): ?>full<?php endif ?>">
<tr>
        <th><div><?php echo __('Document'); ?></div></th>
        <th><div><?php echo __('Type'); ?></div></th>
        <th><div><?php echo __('Size'); ?></div></th>
        <?php if (empty($short) || !$short): ?>
        <th><div><?php echo __('Uploaded on'); ?></div></th>
        <th><div><?php echo __('Updated on'); ?></div></th>
        <th><div>&nbsp;</div></th>
        <?php endif ?>
</tr>