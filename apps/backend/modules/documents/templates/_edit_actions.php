<ul class="sf_admin_actions">
<li><input type="button" onclick="javascript:$('#sf_admin_content fieldset div.form-row').show()" value="expand cultures" class="sf_admin_action_list"></li>
  <li><?php echo button_to(__('list'), 'documents/list?id='.$documents->getId(), array (
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
<?php endif?>
</ul>
