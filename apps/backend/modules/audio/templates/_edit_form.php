<?php echo form_tag('audio/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($audio, 'getId') ?>

<fieldset id="sf_fieldset_none" class="" style="display:<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>block<?php else: ?>none<?php endif?>">

<div class="form-row">
  <?php echo label_for('audio[created_at]', __($labels['audio{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{created_at}')): ?>
    <?php echo form_error('audio{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($audio, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'audio[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[show]', __($labels['audio{show}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{show}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{show}')): ?>
    <?php echo form_error('audio{show}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($audio, 'getShow', array (
  'control_name' => 'audio[show]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[file]', __($labels['audio{file}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('audio{file}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{file}')): ?>
    <?php echo form_error('audio{file}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getFile', array (
  'size' => 80,
  'control_name' => 'audio[file]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[remote]', __($labels['audio{remote}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{remote}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{remote}')): ?>
    <?php echo form_error('audio{remote}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getRemote', array (
  'size' => 80,
  'control_name' => 'audio[remote]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[size]', __($labels['audio{size}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{size}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{size}')): ?>
    <?php echo form_error('audio{size}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getSize', array (
  'size' => 7,
  'control_name' => 'audio[size]',
)); echo $value ? $value : '&nbsp;' ?> bytes
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[duration]', __($labels['audio{duration}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{duration}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{duration}')): ?>
    <?php echo form_error('audio{duration}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getDuration', array (
  'size' => 7,
  'control_name' => 'audio[duration]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[order]', __($labels['audio{order}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('audio{order}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{order}')): ?>
    <?php echo form_error('audio{order}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getOrder', array (
  'size' => 7,
  'control_name' => 'audio[order]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <label for="audio_change_updated_at">Change Updated At:</label>  <div class="content">
  
  <input type="checkbox" checked="checked" value="1" id="audio_change_updated_at" name="audio[change_updated_at]">    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_en" class="">
<h2><?php echo __('EN') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_en]', __($labels['audio{title_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_en}')): ?>
    <?php echo form_error('audio{title_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nEn', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_en]', __($labels['audio{body_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_en}')): ?>
    <?php echo form_error('audio{body_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nEn', array (
  'control_name' => 'audio[body_i18n_en]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_en]', __($labels['audio{author_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_en}')): ?>
    <?php echo form_error('audio{author_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nEn', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ru" class="">
<h2><?php echo __('RU') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_ru]', __($labels['audio{title_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_ru}')): ?>
    <?php echo form_error('audio{title_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nRu', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_ru]', __($labels['audio{body_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_ru}')): ?>
    <?php echo form_error('audio{body_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nRu', array (
  'control_name' => 'audio[body_i18n_ru]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_ru]', __($labels['audio{author_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_ru}')): ?>
    <?php echo form_error('audio{author_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nRu', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_cs" class="">
<h2><?php echo __('CS') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_cs]', __($labels['audio{title_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_cs}')): ?>
    <?php echo form_error('audio{title_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nCs', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_cs]', __($labels['audio{body_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_cs}')): ?>
    <?php echo form_error('audio{body_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nCs', array (
  'control_name' => 'audio[body_i18n_cs]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_cs]', __($labels['audio{author_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_cs}')): ?>
    <?php echo form_error('audio{author_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nCs', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_hu" class="">
<h2><?php echo __('HU') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_hu]', __($labels['audio{title_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_hu}')): ?>
    <?php echo form_error('audio{title_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nHu', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_hu]', __($labels['audio{body_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_hu}')): ?>
    <?php echo form_error('audio{body_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nHu', array (
  'control_name' => 'audio[body_i18n_hu]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_hu]', __($labels['audio{author_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_hu}')): ?>
    <?php echo form_error('audio{author_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nHu', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_pl" class="">
<h2><?php echo __('PL') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_pl]', __($labels['audio{title_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_pl}')): ?>
    <?php echo form_error('audio{title_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nPl', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_pl]', __($labels['audio{body_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_pl}')): ?>
    <?php echo form_error('audio{body_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nPl', array (
  'control_name' => 'audio[body_i18n_pl]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_pl]', __($labels['audio{author_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_pl}')): ?>
    <?php echo form_error('audio{author_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nPl', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_fr" class="">
<h2><?php echo __('FR') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_fr]', __($labels['audio{title_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_fr}')): ?>
    <?php echo form_error('audio{title_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nFr', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_fr]', __($labels['audio{body_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_fr}')): ?>
    <?php echo form_error('audio{body_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nFr', array (
  'control_name' => 'audio[body_i18n_fr]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_fr]', __($labels['audio{author_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_fr}')): ?>
    <?php echo form_error('audio{author_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nFr', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_cn" class="">
<h2><?php echo __('ZH_CN') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_zh_cn]', __($labels['audio{title_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_zh_cn}')): ?>
    <?php echo form_error('audio{title_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_zh_cn]', __($labels['audio{body_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_zh_cn}')): ?>
    <?php echo form_error('audio{body_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nZhCN', array (
  'control_name' => 'audio[body_i18n_zh_cn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_zh_cn]', __($labels['audio{author_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_zh_cn}')): ?>
    <?php echo form_error('audio{author_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_vi" class="">
<h2><?php echo __('VI') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_vi]', __($labels['audio{title_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_vi}')): ?>
    <?php echo form_error('audio{title_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nVi', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_vi]', __($labels['audio{body_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_vi}')): ?>
    <?php echo form_error('audio{body_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nVi', array (
  'control_name' => 'audio[body_i18n_vi]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_vi]', __($labels['audio{author_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_vi}')): ?>
    <?php echo form_error('audio{author_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nVi', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ja" class="">
<h2><?php echo __('JA') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_ja]', __($labels['audio{title_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_ja}')): ?>
    <?php echo form_error('audio{title_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nJa', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_ja]', __($labels['audio{body_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_ja}')): ?>
    <?php echo form_error('audio{body_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nJa', array (
  'control_name' => 'audio[body_i18n_ja]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_ja]', __($labels['audio{author_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_ja}')): ?>
    <?php echo form_error('audio{author_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nJa', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_es" class="">
<h2><?php echo __('ES') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_es]', __($labels['audio{title_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_es}')): ?>
    <?php echo form_error('audio{title_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nEs', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_es]', __($labels['audio{body_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_es}')): ?>
    <?php echo form_error('audio{body_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nEs', array (
  'control_name' => 'audio[body_i18n_es]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_es]', __($labels['audio{author_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_es}')): ?>
    <?php echo form_error('audio{author_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nEs', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_it" class="">
<h2><?php echo __('IT') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_it]', __($labels['audio{title_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_it}')): ?>
    <?php echo form_error('audio{title_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nIt', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_it]', __($labels['audio{body_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_it}')): ?>
    <?php echo form_error('audio{body_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nIt', array (
  'control_name' => 'audio[body_i18n_it]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_it]', __($labels['audio{author_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_it}')): ?>
    <?php echo form_error('audio{author_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nIt', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_et" class="">
<h2><?php echo __('ET') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_et]', __($labels['audio{title_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_et}')): ?>
    <?php echo form_error('audio{title_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nEt', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_et]', __($labels['audio{body_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_et}')): ?>
    <?php echo form_error('audio{body_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nEt', array (
  'control_name' => 'audio[body_i18n_et]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_et]', __($labels['audio{author_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_et}')): ?>
    <?php echo form_error('audio{author_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nEt', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ne" class="">
<h2><?php echo __('NE') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_ne]', __($labels['audio{title_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_ne}')): ?>
    <?php echo form_error('audio{title_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nNe', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_ne]', __($labels['audio{body_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_ne}')): ?>
    <?php echo form_error('audio{body_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nNe', array (
  'control_name' => 'audio[body_i18n_ne]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_ne]', __($labels['audio{author_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_ne}')): ?>
    <?php echo form_error('audio{author_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nNe', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_bn" class="">
<h2><?php echo __('BN') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_bn]', __($labels['audio{title_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_bn}')): ?>
    <?php echo form_error('audio{title_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nBn', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_bn]', __($labels['audio{body_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_bn}')): ?>
    <?php echo form_error('audio{body_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nBn', array (
  'control_name' => 'audio[body_i18n_bn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_bn]', __($labels['audio{author_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_bn}')): ?>
    <?php echo form_error('audio{author_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nBn', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_he" class="">
<h2><?php echo __('HE') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_he]', __($labels['audio{title_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_he}')): ?>
    <?php echo form_error('audio{title_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nHe', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_he]', __($labels['audio{body_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_he}')): ?>
    <?php echo form_error('audio{body_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nHe', array (
  'control_name' => 'audio[body_i18n_he]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_he]', __($labels['audio{author_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_he}')): ?>
    <?php echo form_error('audio{author_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nHe', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_tw" class="">
<h2><?php echo __('ZH_TW') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_zh_tw]', __($labels['audio{title_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_zh_tw}')): ?>
    <?php echo form_error('audio{title_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nZhTW', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_zh_tw]', __($labels['audio{body_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_zh_tw}')): ?>
    <?php echo form_error('audio{body_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nZhTW', array (
  'control_name' => 'audio[body_i18n_zh_tw]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_zh_tw]', __($labels['audio{author_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_zh_tw}')): ?>
    <?php echo form_error('audio{author_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nZhTW', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_de" class="">
<h2><?php echo __('DE') ?></h2>


<div class="form-row">
  <?php echo label_for('audio[title_i18n_de]', __($labels['audio{title_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{title_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{title_i18n_de}')): ?>
    <?php echo form_error('audio{title_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getTitleI18nDe', array (
  'disabled' => false,
  'control_name' => 'audio[title_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[body_i18n_de]', __($labels['audio{body_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{body_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{body_i18n_de}')): ?>
    <?php echo form_error('audio{body_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($audio, 'getBodyI18nDe', array (
  'control_name' => 'audio[body_i18n_de]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('audio[author_i18n_de]', __($labels['audio{author_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('audio{author_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('audio{author_i18n_de}')): ?>
    <?php echo form_error('audio{author_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($audio, 'getAuthorI18nDe', array (
  'disabled' => false,
  'control_name' => 'audio[author_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('audio' => $audio)) ?>

</form>

<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>
<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($audio->getId()): ?>
<?php echo button_to(__('delete'), 'audio/delete?id='.$audio->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
<?php endif ?>