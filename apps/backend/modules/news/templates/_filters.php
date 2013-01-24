<?php use_helper('Object') ?>

<div class="sf_admin_filters">
<?php echo form_tag('news/list', array('method' => 'get')) ?>

  <fieldset>
    <h2><?php echo __('filters') ?></h2>
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
    <label for="filters_show"><?php echo __('Title:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[title]', $filters['title']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Short body:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[shortbody]', $filters['shortbody']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Body:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[body]', $filters['body']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Extradate:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[extradate]', $filters['extradate']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Author:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[author]', $filters['author']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Translated by:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[translated_by]', $filters['translated_by']); echo $value ? $value : '&nbsp;' ?>
    </div>
    </div>
    
    <div class="form-row">
    <label for="filters_show"><?php echo __('Link:') ?></label>
    <div class="content">
        <?php $value = input_tag('filters[link]', $filters['link']); echo $value ? $value : '&nbsp;' ?>
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
    <li><?php echo button_to(__('reset'), 'news/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('filter'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
