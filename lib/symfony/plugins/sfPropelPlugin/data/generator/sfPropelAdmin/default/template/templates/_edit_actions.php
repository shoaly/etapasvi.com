<ul class="sf_admin_actions">
<li><input type="button" onclick="javascript:$('#sf_admin_content fieldset div.form-row').show()" value="expand cultures" class="sf_admin_action_list"></li>
<?php $editActions = $this->getParameterValue('edit.actions') ?>
<?php if (null !== $editActions): ?>
<?php foreach ((array) $editActions as $actionName => $params): ?>
  <?php if ($actionName == '_delete') continue ?>
  <?php echo $this->addCredentialCondition($this->getButtonToAction($actionName, $params, true), $params) ?>
<?php endforeach; ?>
<?php else: ?>
  <?php echo $this->getButtonToAction('_list', array(), true) ?>
  <?php echo $this->getButtonToAction('_save', array(), true) ?>
  <?php echo $this->getButtonToAction('_save_and_add', array(), true) ?>
<?php endif; ?>
</ul>
