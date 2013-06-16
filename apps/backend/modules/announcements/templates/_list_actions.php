<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>
<ul class="sf_admin_actions">
  <li><?php echo button_to(__('create'), 'announcements/create', array (
  'class' => 'sf_admin_action_create',
)) ?></li>
</ul>
<?php endif ?>