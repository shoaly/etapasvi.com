<ul class="sf_admin_actions">
<li><input type="button" onclick="expandCultures()" value="expand cultures" class="sf_admin_action_list"></li>
  <li><?php echo button_to(__('list'), 'photo/list?id='.$photo->getId(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
  <li><?php echo submit_tag(__('save'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>
  <li><?php echo submit_tag(__('save and add'), array (
  'name' => 'save_and_add',
  'class' => 'sf_admin_action_save_and_add',
)) ?></li>
<?php endif ?>
</ul>
