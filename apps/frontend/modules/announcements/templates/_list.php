<?php foreach ($announcements_list as $i=>$announcements): ?>
        <?php include_partial('announcements/showShort', array('announcements'=>$announcements, 'hide_wrapper'=>true, 'last'=>($i==(count($announcements_list)-1))) ); ?><?php if ($i != count($announcements_list)-1): ?><br/><?php endif ?>
<?php endforeach; ?>