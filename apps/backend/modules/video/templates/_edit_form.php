<?php echo form_tag('video/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($video, 'getId') ?>

<fieldset id="sf_fieldset_none" class="" style="display:<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>block<?php else: ?>none<?php endif?>">

<div class="form-row">
  <?php echo label_for('video[show]', __($labels['video{show}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{show}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{show}')): ?>
    <?php echo form_error('video{show}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($video, 'getShow', array (
  'control_name' => 'video[show]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[order]', __($labels['video{order}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('video{order}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{order}')): ?>
    <?php echo form_error('video{order}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getOrder', array (
  'size' => 7,
  'control_name' => 'video[order]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[created_at]', __($labels['video{created_at}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{created_at}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{created_at}')): ?>
    <?php echo form_error('video{created_at}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($video, 'getCreatedAt', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf_data_lsdfkr/sf_admin/images/date.png',
  'control_name' => 'video[created_at]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[link]', __($labels['video{link}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{link}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{link}')): ?>
    <?php echo form_error('video{link}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getLink', array (
  'size' => 80,
  'control_name' => 'video[link]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[all_cultures]', __($labels['video{all_cultures}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{all_cultures}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{all_cultures}')): ?>
    <?php echo form_error('video{all_cultures}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($video, 'getAllCultures', array (
  'control_name' => 'video[all_cultures]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <label for="video_change_updated_at">Change Updated At:</label>  <div class="content">
  
  <input type="checkbox" checked="checked" value="1" id="video_change_updated_at" name="video[change_updated_at]">    </div>
</div>

<div class="form-row">
  <label for="video_itemcategory">Item Categories:</label>  <div class="content">
  <?php      
    echo object_select_tag($video, 'getItemcategoryIdList', array (
      'include_blank' => true,
      'related_class' => 'Itemcategory',
      'peer_method' => 'getAll',
      'text_method' => '__toString',
      'control_name' => 'video[itemcategory]',
      'multiple' => true
  ), 1);
  ?>
</div>
</div>

<div class="form-row">
  <?php echo label_for('video[item2item_list]', __($labels['video{item2item_list}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{item2item_list}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{item2item_list}')): ?>
    <?php echo form_error('video{item2item_list}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('item2item_list', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_en" class="">
<h2><?php echo __('EN') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_en]', __($labels['video{title_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_en}')): ?>
    <?php echo form_error('video{title_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nEn', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_en]', __($labels['video{body_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_en}')): ?>
    <?php echo form_error('video{body_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nEn', array (
  'control_name' => 'video[body_i18n_en]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_en]', __($labels['video{code_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_en}')): ?>
    <?php echo form_error('video{code_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nEn', array (
  'control_name' => 'video[code_i18n_en]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_en]', __($labels['video{img_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_en}')): ?>
    <?php echo form_error('video{img_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nEn', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_en]', __($labels['video{img_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_en}')): ?>
    <?php echo form_error('video{img_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_en', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_en]', __($labels['video{author_i18n_en}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_en}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_en}')): ?>
    <?php echo form_error('video{author_i18n_en}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nEn', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_en]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ru" class="">
<h2><?php echo __('RU') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_ru]', __($labels['video{title_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_ru}')): ?>
    <?php echo form_error('video{title_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nRu', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_ru]', __($labels['video{body_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_ru}')): ?>
    <?php echo form_error('video{body_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nRu', array (
  'control_name' => 'video[body_i18n_ru]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_ru]', __($labels['video{code_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_ru}')): ?>
    <?php echo form_error('video{code_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nRu', array (
  'control_name' => 'video[code_i18n_ru]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_ru]', __($labels['video{img_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_ru}')): ?>
    <?php echo form_error('video{img_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nRu', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_ru]', __($labels['video{img_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_ru}')): ?>
    <?php echo form_error('video{img_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_ru', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_ru]', __($labels['video{author_i18n_ru}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_ru}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_ru}')): ?>
    <?php echo form_error('video{author_i18n_ru}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nRu', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_ru]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_cs" class="">
<h2><?php echo __('CS') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_cs]', __($labels['video{title_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_cs}')): ?>
    <?php echo form_error('video{title_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nCs', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_cs]', __($labels['video{body_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_cs}')): ?>
    <?php echo form_error('video{body_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nCs', array (
  'control_name' => 'video[body_i18n_cs]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_cs]', __($labels['video{code_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_cs}')): ?>
    <?php echo form_error('video{code_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nCs', array (
  'control_name' => 'video[code_i18n_cs]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_cs]', __($labels['video{img_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_cs}')): ?>
    <?php echo form_error('video{img_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nCs', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_cs]', __($labels['video{img_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_cs}')): ?>
    <?php echo form_error('video{img_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_cs', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_cs]', __($labels['video{author_i18n_cs}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_cs}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_cs}')): ?>
    <?php echo form_error('video{author_i18n_cs}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nCs', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_cs]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_hu" class="">
<h2><?php echo __('HU') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_hu]', __($labels['video{title_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_hu}')): ?>
    <?php echo form_error('video{title_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nHu', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_hu]', __($labels['video{body_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_hu}')): ?>
    <?php echo form_error('video{body_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nHu', array (
  'control_name' => 'video[body_i18n_hu]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_hu]', __($labels['video{code_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_hu}')): ?>
    <?php echo form_error('video{code_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nHu', array (
  'control_name' => 'video[code_i18n_hu]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_hu]', __($labels['video{img_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_hu}')): ?>
    <?php echo form_error('video{img_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nHu', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_hu]', __($labels['video{img_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_hu}')): ?>
    <?php echo form_error('video{img_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_hu', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_hu]', __($labels['video{author_i18n_hu}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_hu}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_hu}')): ?>
    <?php echo form_error('video{author_i18n_hu}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nHu', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_hu]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_pl" class="">
<h2><?php echo __('PL') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_pl]', __($labels['video{title_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_pl}')): ?>
    <?php echo form_error('video{title_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nPl', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_pl]', __($labels['video{body_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_pl}')): ?>
    <?php echo form_error('video{body_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nPl', array (
  'control_name' => 'video[body_i18n_pl]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_pl]', __($labels['video{code_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_pl}')): ?>
    <?php echo form_error('video{code_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nPl', array (
  'control_name' => 'video[code_i18n_pl]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_pl]', __($labels['video{img_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_pl}')): ?>
    <?php echo form_error('video{img_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nPl', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_pl]', __($labels['video{img_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_pl}')): ?>
    <?php echo form_error('video{img_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_pl', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_pl]', __($labels['video{author_i18n_pl}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_pl}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_pl}')): ?>
    <?php echo form_error('video{author_i18n_pl}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nPl', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_pl]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_fr" class="">
<h2><?php echo __('FR') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_fr]', __($labels['video{title_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_fr}')): ?>
    <?php echo form_error('video{title_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nFr', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_fr]', __($labels['video{body_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_fr}')): ?>
    <?php echo form_error('video{body_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nFr', array (
  'control_name' => 'video[body_i18n_fr]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_fr]', __($labels['video{code_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_fr}')): ?>
    <?php echo form_error('video{code_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nFr', array (
  'control_name' => 'video[code_i18n_fr]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_fr]', __($labels['video{img_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_fr}')): ?>
    <?php echo form_error('video{img_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nFr', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_fr]', __($labels['video{img_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_fr}')): ?>
    <?php echo form_error('video{img_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_fr', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_fr]', __($labels['video{author_i18n_fr}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_fr}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_fr}')): ?>
    <?php echo form_error('video{author_i18n_fr}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nFr', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_fr]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_cn" class="">
<h2><?php echo __('ZH_CN') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_zh_cn]', __($labels['video{title_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_zh_cn}')): ?>
    <?php echo form_error('video{title_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_zh_cn]', __($labels['video{body_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_zh_cn}')): ?>
    <?php echo form_error('video{body_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nZhCN', array (
  'control_name' => 'video[body_i18n_zh_cn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_zh_cn]', __($labels['video{code_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_zh_cn}')): ?>
    <?php echo form_error('video{code_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nZhCN', array (
  'control_name' => 'video[code_i18n_zh_cn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_zh_cn]', __($labels['video{img_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_zh_cn}')): ?>
    <?php echo form_error('video{img_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_zh_cn]', __($labels['video{img_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_zh_cn}')): ?>
    <?php echo form_error('video{img_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_zh_cn', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_zh_cn]', __($labels['video{author_i18n_zh_cn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_zh_cn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_zh_cn}')): ?>
    <?php echo form_error('video{author_i18n_zh_cn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nZhCN', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_zh_cn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_vi" class="">
<h2><?php echo __('VI') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_vi]', __($labels['video{title_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_vi}')): ?>
    <?php echo form_error('video{title_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nVi', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_vi]', __($labels['video{body_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_vi}')): ?>
    <?php echo form_error('video{body_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nVi', array (
  'control_name' => 'video[body_i18n_vi]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_vi]', __($labels['video{code_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_vi}')): ?>
    <?php echo form_error('video{code_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nVi', array (
  'control_name' => 'video[code_i18n_vi]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_vi]', __($labels['video{img_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_vi}')): ?>
    <?php echo form_error('video{img_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nVi', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_vi]', __($labels['video{img_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_vi}')): ?>
    <?php echo form_error('video{img_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_vi', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_vi]', __($labels['video{author_i18n_vi}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_vi}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_vi}')): ?>
    <?php echo form_error('video{author_i18n_vi}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nVi', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_vi]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ja" class="">
<h2><?php echo __('JA') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_ja]', __($labels['video{title_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_ja}')): ?>
    <?php echo form_error('video{title_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nJa', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_ja]', __($labels['video{body_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_ja}')): ?>
    <?php echo form_error('video{body_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nJa', array (
  'control_name' => 'video[body_i18n_ja]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_ja]', __($labels['video{code_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_ja}')): ?>
    <?php echo form_error('video{code_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nJa', array (
  'control_name' => 'video[code_i18n_ja]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_ja]', __($labels['video{img_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_ja}')): ?>
    <?php echo form_error('video{img_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nJa', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_ja]', __($labels['video{img_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_ja}')): ?>
    <?php echo form_error('video{img_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_ja', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_ja]', __($labels['video{author_i18n_ja}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_ja}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_ja}')): ?>
    <?php echo form_error('video{author_i18n_ja}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nJa', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_ja]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_es" class="">
<h2><?php echo __('ES') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_es]', __($labels['video{title_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_es}')): ?>
    <?php echo form_error('video{title_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nEs', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_es]', __($labels['video{body_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_es}')): ?>
    <?php echo form_error('video{body_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nEs', array (
  'control_name' => 'video[body_i18n_es]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_es]', __($labels['video{code_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_es}')): ?>
    <?php echo form_error('video{code_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nEs', array (
  'control_name' => 'video[code_i18n_es]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_es]', __($labels['video{img_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_es}')): ?>
    <?php echo form_error('video{img_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nEs', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_es]', __($labels['video{img_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_es}')): ?>
    <?php echo form_error('video{img_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_es', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_es]', __($labels['video{author_i18n_es}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_es}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_es}')): ?>
    <?php echo form_error('video{author_i18n_es}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nEs', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_es]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_it" class="">
<h2><?php echo __('IT') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_it]', __($labels['video{title_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_it}')): ?>
    <?php echo form_error('video{title_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nIt', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_it]', __($labels['video{body_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_it}')): ?>
    <?php echo form_error('video{body_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nIt', array (
  'control_name' => 'video[body_i18n_it]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_it]', __($labels['video{code_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_it}')): ?>
    <?php echo form_error('video{code_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nIt', array (
  'control_name' => 'video[code_i18n_it]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_it]', __($labels['video{img_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_it}')): ?>
    <?php echo form_error('video{img_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nIt', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_it]', __($labels['video{img_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_it}')): ?>
    <?php echo form_error('video{img_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_it', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_it]', __($labels['video{author_i18n_it}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_it}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_it}')): ?>
    <?php echo form_error('video{author_i18n_it}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nIt', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_it]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_et" class="">
<h2><?php echo __('ET') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_et]', __($labels['video{title_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_et}')): ?>
    <?php echo form_error('video{title_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nEt', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_et]', __($labels['video{body_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_et}')): ?>
    <?php echo form_error('video{body_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nEt', array (
  'control_name' => 'video[body_i18n_et]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_et]', __($labels['video{code_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_et}')): ?>
    <?php echo form_error('video{code_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nEt', array (
  'control_name' => 'video[code_i18n_et]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_et]', __($labels['video{img_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_et}')): ?>
    <?php echo form_error('video{img_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nEt', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_et]', __($labels['video{img_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_et}')): ?>
    <?php echo form_error('video{img_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_et', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_et]', __($labels['video{author_i18n_et}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_et}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_et}')): ?>
    <?php echo form_error('video{author_i18n_et}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nEt', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_et]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_ne" class="">
<h2><?php echo __('NE') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_ne]', __($labels['video{title_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_ne}')): ?>
    <?php echo form_error('video{title_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nNe', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_ne]', __($labels['video{body_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_ne}')): ?>
    <?php echo form_error('video{body_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nNe', array (
  'control_name' => 'video[body_i18n_ne]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_ne]', __($labels['video{code_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_ne}')): ?>
    <?php echo form_error('video{code_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nNe', array (
  'control_name' => 'video[code_i18n_ne]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_ne]', __($labels['video{img_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_ne}')): ?>
    <?php echo form_error('video{img_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nNe', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_ne]', __($labels['video{img_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_ne}')): ?>
    <?php echo form_error('video{img_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_ne', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_ne]', __($labels['video{author_i18n_ne}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_ne}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_ne}')): ?>
    <?php echo form_error('video{author_i18n_ne}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nNe', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_ne]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_bn" class="">
<h2><?php echo __('BN') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_bn]', __($labels['video{title_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_bn}')): ?>
    <?php echo form_error('video{title_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nBn', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_bn]', __($labels['video{body_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_bn}')): ?>
    <?php echo form_error('video{body_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nBn', array (
  'control_name' => 'video[body_i18n_bn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_bn]', __($labels['video{code_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_bn}')): ?>
    <?php echo form_error('video{code_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nBn', array (
  'control_name' => 'video[code_i18n_bn]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_bn]', __($labels['video{img_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_bn}')): ?>
    <?php echo form_error('video{img_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nBn', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_bn]', __($labels['video{img_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_bn}')): ?>
    <?php echo form_error('video{img_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_bn', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_bn]', __($labels['video{author_i18n_bn}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_bn}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_bn}')): ?>
    <?php echo form_error('video{author_i18n_bn}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nBn', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_bn]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_he" class="">
<h2><?php echo __('HE') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_he]', __($labels['video{title_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_he}')): ?>
    <?php echo form_error('video{title_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nHe', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_he]', __($labels['video{body_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_he}')): ?>
    <?php echo form_error('video{body_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nHe', array (
  'control_name' => 'video[body_i18n_he]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_he]', __($labels['video{code_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_he}')): ?>
    <?php echo form_error('video{code_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nHe', array (
  'control_name' => 'video[code_i18n_he]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_he]', __($labels['video{img_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_he}')): ?>
    <?php echo form_error('video{img_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nHe', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_he]', __($labels['video{img_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_he}')): ?>
    <?php echo form_error('video{img_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_he', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_he]', __($labels['video{author_i18n_he}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_he}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_he}')): ?>
    <?php echo form_error('video{author_i18n_he}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nHe', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_he]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_zh_tw" class="">
<h2><?php echo __('ZH_TW') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_zh_tw]', __($labels['video{title_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_zh_tw}')): ?>
    <?php echo form_error('video{title_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nZhTw', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_zh_tw]', __($labels['video{body_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_zh_tw}')): ?>
    <?php echo form_error('video{body_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nZhTw', array (
  'control_name' => 'video[body_i18n_zh_tw]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_zh_tw]', __($labels['video{code_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_zh_tw}')): ?>
    <?php echo form_error('video{code_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nZhTw', array (
  'control_name' => 'video[code_i18n_zh_tw]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_zh_tw]', __($labels['video{img_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_zh_tw}')): ?>
    <?php echo form_error('video{img_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nZhTw', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_zh_tw]', __($labels['video{img_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_zh_tw}')): ?>
    <?php echo form_error('video{img_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_zh_tw', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_zh_tw]', __($labels['video{author_i18n_zh_tw}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_zh_tw}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_zh_tw}')): ?>
    <?php echo form_error('video{author_i18n_zh_tw}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nZhTw', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_zh_tw]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_de" class="">
<h2><?php echo __('DE') ?></h2>


<div class="form-row">
  <?php echo label_for('video[title_i18n_de]', __($labels['video{title_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{title_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{title_i18n_de}')): ?>
    <?php echo form_error('video{title_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getTitleI18nDe', array (
  'disabled' => false,
  'control_name' => 'video[title_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[body_i18n_de]', __($labels['video{body_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{body_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{body_i18n_de}')): ?>
    <?php echo form_error('video{body_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getBodyI18nDe', array (
  'control_name' => 'video[body_i18n_de]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[code_i18n_de]', __($labels['video{code_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{code_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{code_i18n_de}')): ?>
    <?php echo form_error('video{code_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($video, 'getCodeI18nDe', array (
  'control_name' => 'video[code_i18n_de]',
  'disabled' => false,
  'size' => '118x6',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_de]', __($labels['video{img_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_de}')): ?>
    <?php echo form_error('video{img_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getImgI18nDe', array (
  'disabled' => false,
  'control_name' => 'video[img_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[img_i18n_de]', __($labels['video{img_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{img_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{img_i18n_de}')): ?>
    <?php echo form_error('video{img_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('img_i18n_de', array('type' => 'edit', 'video' => $video)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('video[author_i18n_de]', __($labels['video{author_i18n_de}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('video{author_i18n_de}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('video{author_i18n_de}')): ?>
    <?php echo form_error('video{author_i18n_de}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($video, 'getAuthorI18nDe', array (
  'disabled' => false,
  'control_name' => 'video[author_i18n_de]',
  'maxlength' => 255,
  'style' => 'width:80%',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('video' => $video)) ?>

</form>

<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>
<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($video->getId()): ?>
<?php echo button_to(__('delete'), 'video/delete?id='.$video->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
<?php endif ?>