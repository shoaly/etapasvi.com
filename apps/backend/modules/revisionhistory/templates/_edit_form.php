<?php echo form_tag('revisionhistory/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($revisionhistory, 'getId') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('revisionhistory[created_at]', __($labels['revisionhistory{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('revisionhistory{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('revisionhistory{created_at}')): ?>
    <?php echo form_error('revisionhistory{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($revisionhistory, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'revisionhistory[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('revisionhistory[show]', __($labels['revisionhistory{show}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('revisionhistory{show}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('revisionhistory{show}')): ?>
    <?php echo form_error('revisionhistory{show}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($revisionhistory, 'getShow', array (
  'control_name' => 'revisionhistory[show]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('revisionhistory[page_mnemonic]', __($labels['revisionhistory{page_mnemonic}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('revisionhistory{page_mnemonic}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('revisionhistory{page_mnemonic}')): ?>
    <?php echo form_error('revisionhistory{page_mnemonic}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($revisionhistory, 'getPageMnemonic', array (
  'size' => 80,
  'control_name' => 'revisionhistory[page_mnemonic]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('revisionhistory[item_id]', __($labels['revisionhistory{item_id}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('revisionhistory{item_id}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('revisionhistory{item_id}')): ?>
    <?php echo form_error('revisionhistory{item_id}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($revisionhistory, 'getItemId', array (
  'size' => 7,
  'control_name' => 'revisionhistory[item_id]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('revisionhistory[itemtypes_id]', __($labels['revisionhistory{itemtypes_id}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('revisionhistory{itemtypes_id}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('revisionhistory{itemtypes_id}')): ?>
    <?php echo form_error('revisionhistory{itemtypes_id}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($revisionhistory, 'getItemtypesId', array (
  'related_class' => 'Itemtypes',
  'control_name' => 'revisionhistory[itemtypes_id]',
  'include_blank' => true,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('revisionhistory[item_culture]', __($labels['revisionhistory{item_culture}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('revisionhistory{item_culture}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('revisionhistory{item_culture}')): ?>
    <?php echo form_error('revisionhistory{item_culture}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($revisionhistory, 'getItemCulture', array (
  'size' => 20,
  'control_name' => 'revisionhistory[item_culture]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('revisionhistory[body]', __($labels['revisionhistory{body}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('revisionhistory{body}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('revisionhistory{body}')): ?>
    <?php echo form_error('revisionhistory{body}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($revisionhistory, 'getBody', array (
  'control_name' => 'revisionhistory[body]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('revisionhistory' => $revisionhistory)) ?>

</form>
<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>
<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($revisionhistory->getId()): ?>
<?php echo button_to(__('delete'), 'revisionhistory/delete?id='.$revisionhistory->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
<?php endif ?>