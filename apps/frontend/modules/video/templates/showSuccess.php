<?php include_component('video', 'showwrapper', array('id'=>$id, 'title'=>$title)); ?>
<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_VIDEO), 'id'=>$id));*/ ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_VIDEO), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>	

<?php include_partial('global/go_to_top'); ?>