<?php echo form_tag('photoalbum/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($photoalbum, 'getId') ?>

<fieldset id="sf_fieldset_none" class="" style="display:<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>block<?php else: ?>none<?php endif?>">

<div class="form-row">
  <?php echo label_for('photoalbum[show]', __($labels['photoalbum{show}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{show}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{show}')): ?>
    <?php echo form_error('photoalbum{show}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($photoalbum, 'getShow', array (
  'control_name' => 'photoalbum[show]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[order]', __($labels['photoalbum{order}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{order}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{order}')): ?>
    <?php echo form_error('photoalbum{order}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getOrder', array (
  'size' => 7,
  'control_name' => 'photoalbum[order]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[created_at]', __($labels['photoalbum{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{created_at}')): ?>
    <?php echo form_error('photoalbum{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($photoalbum, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'photoalbum[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_en" class="">
<h2><?php echo __('EN') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_en]', __($labels['photoalbum{title_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_en}')): ?>
    <?php echo form_error('photoalbum{title_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nEn', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_en]', __($labels['photoalbum{body_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_en}')): ?>
    <?php echo form_error('photoalbum{body_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nEn', array (
  'control_name' => 'photoalbum[body_i18n_en]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_en]', __($labels['photoalbum{author_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_en}')): ?>
    <?php echo form_error('photoalbum{author_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nEn', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ru" class="">
<h2><?php echo __('RU') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_ru]', __($labels['photoalbum{title_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_ru}')): ?>
    <?php echo form_error('photoalbum{title_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nRu', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_ru]', __($labels['photoalbum{body_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_ru}')): ?>
    <?php echo form_error('photoalbum{body_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nRu', array (
  'control_name' => 'photoalbum[body_i18n_ru]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_ru]', __($labels['photoalbum{author_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_ru}')): ?>
    <?php echo form_error('photoalbum{author_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nRu', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_cs" class="">
<h2><?php echo __('CS') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_cs]', __($labels['photoalbum{title_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_cs}')): ?>
    <?php echo form_error('photoalbum{title_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nCs', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_cs]', __($labels['photoalbum{body_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_cs}')): ?>
    <?php echo form_error('photoalbum{body_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nCs', array (
  'control_name' => 'photoalbum[body_i18n_cs]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_cs]', __($labels['photoalbum{author_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_cs}')): ?>
    <?php echo form_error('photoalbum{author_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nCs', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_hu" class="">
<h2><?php echo __('HU') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_hu]', __($labels['photoalbum{title_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_hu}')): ?>
    <?php echo form_error('photoalbum{title_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nHu', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_hu]', __($labels['photoalbum{body_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_hu}')): ?>
    <?php echo form_error('photoalbum{body_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nHu', array (
  'control_name' => 'photoalbum[body_i18n_hu]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_hu]', __($labels['photoalbum{author_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_hu}')): ?>
    <?php echo form_error('photoalbum{author_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nHu', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_pl" class="">
<h2><?php echo __('PL') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_pl]', __($labels['photoalbum{title_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_pl}')): ?>
    <?php echo form_error('photoalbum{title_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nPl', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_pl]', __($labels['photoalbum{body_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_pl}')): ?>
    <?php echo form_error('photoalbum{body_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nPl', array (
  'control_name' => 'photoalbum[body_i18n_pl]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_pl]', __($labels['photoalbum{author_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_pl}')): ?>
    <?php echo form_error('photoalbum{author_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nPl', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_fr" class="">
<h2><?php echo __('FR') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_fr]', __($labels['photoalbum{title_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_fr}')): ?>
    <?php echo form_error('photoalbum{title_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nFr', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_fr]', __($labels['photoalbum{body_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_fr}')): ?>
    <?php echo form_error('photoalbum{body_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nFr', array (
  'control_name' => 'photoalbum[body_i18n_fr]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_fr]', __($labels['photoalbum{author_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_fr}')): ?>
    <?php echo form_error('photoalbum{author_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nFr', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_cn" class="">
<h2><?php echo __('ZH_CN') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_zh_cn]', __($labels['photoalbum{title_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_zh_cn}')): ?>
    <?php echo form_error('photoalbum{title_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_zh_cn]', __($labels['photoalbum{body_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_zh_cn}')): ?>
    <?php echo form_error('photoalbum{body_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nZhCN', array (
  'control_name' => 'photoalbum[body_i18n_zh_cn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_zh_cn]', __($labels['photoalbum{author_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_zh_cn}')): ?>
    <?php echo form_error('photoalbum{author_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_vi" class="">
<h2><?php echo __('VI') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_vi]', __($labels['photoalbum{title_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_vi}')): ?>
    <?php echo form_error('photoalbum{title_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nVi', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_vi]', __($labels['photoalbum{body_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_vi}')): ?>
    <?php echo form_error('photoalbum{body_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nVi', array (
  'control_name' => 'photoalbum[body_i18n_vi]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_vi]', __($labels['photoalbum{author_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_vi}')): ?>
    <?php echo form_error('photoalbum{author_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nVi', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ja" class="">
<h2><?php echo __('JA') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_ja]', __($labels['photoalbum{title_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_ja}')): ?>
    <?php echo form_error('photoalbum{title_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nJa', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_ja]', __($labels['photoalbum{body_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_ja}')): ?>
    <?php echo form_error('photoalbum{body_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nJa', array (
  'control_name' => 'photoalbum[body_i18n_ja]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_ja]', __($labels['photoalbum{author_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_ja}')): ?>
    <?php echo form_error('photoalbum{author_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nJa', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_es" class="">
<h2><?php echo __('ES') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_es]', __($labels['photoalbum{title_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_es}')): ?>
    <?php echo form_error('photoalbum{title_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nEs', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_es]', __($labels['photoalbum{body_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_es}')): ?>
    <?php echo form_error('photoalbum{body_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nEs', array (
  'control_name' => 'photoalbum[body_i18n_es]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_es]', __($labels['photoalbum{author_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_es}')): ?>
    <?php echo form_error('photoalbum{author_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nEs', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_it" class="">
<h2><?php echo __('IT') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_it]', __($labels['photoalbum{title_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_it}')): ?>
    <?php echo form_error('photoalbum{title_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nIt', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_it]', __($labels['photoalbum{body_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_it}')): ?>
    <?php echo form_error('photoalbum{body_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nIt', array (
  'control_name' => 'photoalbum[body_i18n_it]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_it]', __($labels['photoalbum{author_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_it}')): ?>
    <?php echo form_error('photoalbum{author_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nIt', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_et" class="">
<h2><?php echo __('ET') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_et]', __($labels['photoalbum{title_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_et}')): ?>
    <?php echo form_error('photoalbum{title_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nEt', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_et]', __($labels['photoalbum{body_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_et}')): ?>
    <?php echo form_error('photoalbum{body_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nEt', array (
  'control_name' => 'photoalbum[body_i18n_et]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_et]', __($labels['photoalbum{author_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_et}')): ?>
    <?php echo form_error('photoalbum{author_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nEt', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ne" class="">
<h2><?php echo __('NE') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_ne]', __($labels['photoalbum{title_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_ne}')): ?>
    <?php echo form_error('photoalbum{title_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nNe', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_ne]', __($labels['photoalbum{body_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_ne}')): ?>
    <?php echo form_error('photoalbum{body_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nNe', array (
  'control_name' => 'photoalbum[body_i18n_ne]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_ne]', __($labels['photoalbum{author_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_ne}')): ?>
    <?php echo form_error('photoalbum{author_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nNe', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_bn" class="">
<h2><?php echo __('BN') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_bn]', __($labels['photoalbum{title_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_bn}')): ?>
    <?php echo form_error('photoalbum{title_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nBn', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_bn]', __($labels['photoalbum{body_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_bn}')): ?>
    <?php echo form_error('photoalbum{body_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nBn', array (
  'control_name' => 'photoalbum[body_i18n_bn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_bn]', __($labels['photoalbum{author_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_bn}')): ?>
    <?php echo form_error('photoalbum{author_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nBn', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_he" class="">
<h2><?php echo __('HE') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_he]', __($labels['photoalbum{title_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_he}')): ?>
    <?php echo form_error('photoalbum{title_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nHe', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_he]', __($labels['photoalbum{body_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_he}')): ?>
    <?php echo form_error('photoalbum{body_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nHe', array (
  'control_name' => 'photoalbum[body_i18n_he]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_he]', __($labels['photoalbum{author_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_he}')): ?>
    <?php echo form_error('photoalbum{author_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nHe', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_tw" class="">
<h2><?php echo __('ZH_TW') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_zh_tw]', __($labels['photoalbum{title_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_zh_tw}')): ?>
    <?php echo form_error('photoalbum{title_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nZhTw', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_zh_tw]', __($labels['photoalbum{body_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_zh_tw}')): ?>
    <?php echo form_error('photoalbum{body_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nZhTw', array (
  'control_name' => 'photoalbum[body_i18n_zh_tw]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_zh_tw]', __($labels['photoalbum{author_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_zh_tw}')): ?>
    <?php echo form_error('photoalbum{author_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nZhTw', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_de" class="">
<h2><?php echo __('DE') ?></h2>


<div class="form-row">
  <?php echo label_for('photoalbum[title_i18n_de]', __($labels['photoalbum{title_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{title_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{title_i18n_de}')): ?>
    <?php echo form_error('photoalbum{title_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getTitleI18nDe', array (
  'disabled' => false,
  'control_name' => 'photoalbum[title_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[body_i18n_de]', __($labels['photoalbum{body_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{body_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{body_i18n_de}')): ?>
    <?php echo form_error('photoalbum{body_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($photoalbum, 'getBodyI18nDe', array (
  'control_name' => 'photoalbum[body_i18n_de]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('photoalbum[author_i18n_de]', __($labels['photoalbum{author_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('photoalbum{author_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('photoalbum{author_i18n_de}')): ?>
    <?php echo form_error('photoalbum{author_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($photoalbum, 'getAuthorI18nDe', array (
  'disabled' => false,
  'control_name' => 'photoalbum[author_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('photoalbum' => $photoalbum)) ?>

</form>

<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>
<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($photoalbum->getId()): ?>
<?php echo button_to(__('delete'), 'photoalbum/delete?id='.$photoalbum->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
<?php endif ?>