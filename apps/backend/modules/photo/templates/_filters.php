<?php use_helper('Object') ?>

<div class="sf_admin_filters">
<?php echo form_tag('photo/list', array('method' => 'get')) ?>

  <fieldset>
    <h2><?php echo __('filters') ?></h2>
    <div class="form-row">
    <label for="filters_photoalbum_id"><?php echo __('Photoalbum:') ?></label>
    <div class="content">
    <?php echo object_select_tag(isset($filters['photoalbum_id']) ? $filters['photoalbum_id'] : null, null, array (
  'include_blank' => true,
  'related_class' => 'Photoalbum',
  'text_method' => '__toString',
  'control_name' => 'filters[photoalbum_id]',
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_show"><?php echo __('Show:') ?></label>
    <div class="content">
    <?php echo select_tag('filters[show]', options_for_select(array(1 => __('yes'), 0 => __('no')), isset($filters['show']) ? $filters['show'] : null, array (
  'include_custom' => __("yes or no"),
)), array (
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_img"><?php echo __('Img:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[img]', isset($filters['img']) ? $filters['img'] : null, array (
  'size' => 15,
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_carousel"><?php echo __('Carousel:') ?></label>
    <div class="content">
    <?php echo select_tag('filters[carousel]', options_for_select(array(1 => __('yes'), 0 => __('no')), isset($filters['carousel']) ? $filters['carousel'] : null, array (
  'include_custom' => __("yes or no"),
)), array (
)) ?>
    </div>
    </div>
    

        <div class="form-row">
    <label for="filters_width"><?php echo __('Width:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[width]', isset($filters['width']) ? $filters['width'] : null, array (
  'size' => 7,
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_height"><?php echo __('Height:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[height]', isset($filters['height']) ? $filters['height'] : null, array (
  'size' => 7,
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_link"><?php echo __('Link:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[link]', isset($filters['link']) ? $filters['link'] : null, array (
  'size' => 15,
)) ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Title:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[title]', $filters['title']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Body:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[body]', $filters['body']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Author:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[author]', $filters['author']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
        <small>
            <strong>%</strong> - zero or more characters<br/>
            <strong>_</strong> - exactly one character<br/>
            <strong>[charlist]</strong> - any single character in charlist<br/>
            <strong>[^charlist]</strong> - any single character not in charlist
        </small>
    </div>

      </fieldset>

  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('reset'), 'photo/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('filter'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
