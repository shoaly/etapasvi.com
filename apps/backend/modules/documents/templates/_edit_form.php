<?php echo form_tag('documents/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($documents, 'getId') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('documents[created_at]', __($labels['documents{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{created_at}')): ?>
    <?php echo form_error('documents{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($documents, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'documents[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[news_id]', __($labels['documents{news_id}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{news_id}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{news_id}')): ?>
    <?php echo form_error('documents{news_id}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($documents, 'getNewsId', array (
  'related_class' => 'News',
  'control_name' => 'documents[news_id]',
  'include_blank' => true,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[show]', __($labels['documents{show}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{show}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{show}')): ?>
    <?php echo form_error('documents{show}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($documents, 'getShow', array (
  'control_name' => 'documents[show]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[file]', __($labels['documents{file}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('documents{file}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{file}')): ?>
    <?php echo form_error('documents{file}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getFile', array (
  'size' => 80,
  'control_name' => 'documents[file]',
)); echo $value ? $value : '&nbsp;' ?>
  <br/><br/>
  <?php $value = object_admin_input_file_tag($documents, 'getFile', array (
  'control_name' => 'documents[file]',
  'include_link' => 'documents',
  'include_remove' => true,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[size]', __($labels['documents{size}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{size}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{size}')): ?>
    <?php echo form_error('documents{size}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getSize', array (
  'size' => 7,
  'control_name' => 'documents[size]',
)); echo $value ? $value : '&nbsp;' ?> bytes
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[order]', __($labels['documents{order}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('documents{order}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{order}')): ?>
    <?php echo form_error('documents{order}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getOrder', array (
  'size' => 7,
  'control_name' => 'documents[order]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[all_cultures]', __($labels['documents{all_cultures}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{all_cultures}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{all_cultures}')): ?>
    <?php echo form_error('documents{all_cultures}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($documents, 'getAllCultures', array (
  'control_name' => 'documents[all_cultures]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <label for="documents_change_updated_at">Change Updated At:</label>  <div class="content">
  
  <input type="checkbox" checked="checked" value="1" id="documents_change_updated_at" name="documents[change_updated_at]">    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_en" class="">
<h2><?php echo __('EN') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_en]', __($labels['documents{title_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_en}')): ?>
    <?php echo form_error('documents{title_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nEn', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_en]', __($labels['documents{body_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_en}')): ?>
    <?php echo form_error('documents{body_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nEn', array (
  'control_name' => 'documents[body_i18n_en]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ru" class="">
<h2><?php echo __('RU') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_ru]', __($labels['documents{title_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_ru}')): ?>
    <?php echo form_error('documents{title_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nRu', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_ru]', __($labels['documents{body_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_ru}')): ?>
    <?php echo form_error('documents{body_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nRu', array (
  'control_name' => 'documents[body_i18n_ru]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_cs" class="">
<h2><?php echo __('CS') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_cs]', __($labels['documents{title_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_cs}')): ?>
    <?php echo form_error('documents{title_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nCs', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_cs]', __($labels['documents{body_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_cs}')): ?>
    <?php echo form_error('documents{body_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nCs', array (
  'control_name' => 'documents[body_i18n_cs]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_hu" class="">
<h2><?php echo __('HU') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_hu]', __($labels['documents{title_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_hu}')): ?>
    <?php echo form_error('documents{title_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nHu', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_hu]', __($labels['documents{body_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_hu}')): ?>
    <?php echo form_error('documents{body_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nHu', array (
  'control_name' => 'documents[body_i18n_hu]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_pl" class="">
<h2><?php echo __('PL') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_pl]', __($labels['documents{title_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_pl}')): ?>
    <?php echo form_error('documents{title_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nPl', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_pl]', __($labels['documents{body_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_pl}')): ?>
    <?php echo form_error('documents{body_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nPl', array (
  'control_name' => 'documents[body_i18n_pl]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_fr" class="">
<h2><?php echo __('FR') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_fr]', __($labels['documents{title_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_fr}')): ?>
    <?php echo form_error('documents{title_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nFr', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_fr]', __($labels['documents{body_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_fr}')): ?>
    <?php echo form_error('documents{body_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nFr', array (
  'control_name' => 'documents[body_i18n_fr]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_cn" class="">
<h2><?php echo __('ZH_CN') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_zh_cn]', __($labels['documents{title_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_zh_cn}')): ?>
    <?php echo form_error('documents{title_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_zh_cn]', __($labels['documents{body_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_zh_cn}')): ?>
    <?php echo form_error('documents{body_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nZhCN', array (
  'control_name' => 'documents[body_i18n_zh_cn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_vi" class="">
<h2><?php echo __('VI') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_vi]', __($labels['documents{title_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_vi}')): ?>
    <?php echo form_error('documents{title_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nVi', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_vi]', __($labels['documents{body_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_vi}')): ?>
    <?php echo form_error('documents{body_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nVi', array (
  'control_name' => 'documents[body_i18n_vi]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_it" class="">
<h2><?php echo __('IT') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_it]', __($labels['documents{title_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_it}')): ?>
    <?php echo form_error('documents{title_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nIt', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_it]', __($labels['documents{body_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_it}')): ?>
    <?php echo form_error('documents{body_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nIt', array (
  'control_name' => 'documents[body_i18n_it]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ja" class="">
<h2><?php echo __('JA') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_ja]', __($labels['documents{title_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_ja}')): ?>
    <?php echo form_error('documents{title_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nJa', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_ja]', __($labels['documents{body_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_ja}')): ?>
    <?php echo form_error('documents{body_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nJa', array (
  'control_name' => 'documents[body_i18n_ja]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_es" class="">
<h2><?php echo __('ES') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_es]', __($labels['documents{title_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_es}')): ?>
    <?php echo form_error('documents{title_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nEs', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_es]', __($labels['documents{body_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_es}')): ?>
    <?php echo form_error('documents{body_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nEs', array (
  'control_name' => 'documents[body_i18n_es]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_et" class="">
<h2><?php echo __('ET') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_et]', __($labels['documents{title_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_et}')): ?>
    <?php echo form_error('documents{title_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nEt', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_et]', __($labels['documents{body_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_et}')): ?>
    <?php echo form_error('documents{body_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nEt', array (
  'control_name' => 'documents[body_i18n_et]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ne" class="">
<h2><?php echo __('NE') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_ne]', __($labels['documents{title_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_ne}')): ?>
    <?php echo form_error('documents{title_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nNe', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_ne]', __($labels['documents{body_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_ne}')): ?>
    <?php echo form_error('documents{body_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nNe', array (
  'control_name' => 'documents[body_i18n_ne]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_bn" class="">
<h2><?php echo __('BN') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_bn]', __($labels['documents{title_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_bn}')): ?>
    <?php echo form_error('documents{title_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nBn', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_bn]', __($labels['documents{body_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_bn}')): ?>
    <?php echo form_error('documents{body_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nBn', array (
  'control_name' => 'documents[body_i18n_bn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_he" class="">
<h2><?php echo __('HE') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_he]', __($labels['documents{title_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_he}')): ?>
    <?php echo form_error('documents{title_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nHe', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_he]', __($labels['documents{body_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_he}')): ?>
    <?php echo form_error('documents{body_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nHe', array (
  'control_name' => 'documents[body_i18n_he]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_tw" class="">
<h2><?php echo __('ZH_TW') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_zh_tw]', __($labels['documents{title_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_zh_tw}')): ?>
    <?php echo form_error('documents{title_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nZhTW', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_zh_tw]', __($labels['documents{body_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_zh_tw}')): ?>
    <?php echo form_error('documents{body_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nZhTW', array (
  'control_name' => 'documents[body_i18n_zh_tw]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_de" class="">
<h2><?php echo __('DE') ?></h2>


<div class="form-row">
  <?php echo label_for('documents[title_i18n_de]', __($labels['documents{title_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{title_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{title_i18n_de}')): ?>
    <?php echo form_error('documents{title_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($documents, 'getTitleI18nDe', array (
  'disabled' => false,
  'control_name' => 'documents[title_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('documents[body_i18n_de]', __($labels['documents{body_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('documents{body_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('documents{body_i18n_de}')): ?>
    <?php echo form_error('documents{body_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($documents, 'getBodyI18nDe', array (
  'control_name' => 'documents[body_i18n_de]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('documents' => $documents)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($documents->getId()): ?>
<?php echo button_to(__('delete'), 'documents/delete?id='.$documents->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
