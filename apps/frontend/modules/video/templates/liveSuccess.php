<?php slot('body_id') ?>body_video_live<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Live Video') ?><?php end_slot() ?>

<?php $html = get_component( 'video', 'live' ); ?>

<?php if (trim($html)): ?>
    <?php echo $html; ?>
<?php else: ?>
    <div class="center_text">
        <?php echo __('There are no currently live streams scheduled.') ?><br/>
        <a href="<?php echo url_for('@feed', true); ?>"><?php echo __('Stay tuned') ?></a>
    </div>
<?php endif ?>