<span class="likebtn-wrapper" data-identifier="<?php if ($identifier):?><?php echo $identifier; ?><?php endif ?>" data-show_like_label="false" data-dislike_enabled="false" data-color_scheme="heartcross" data-i18n_like_tooltip="<?php echo __('I like this') ?>" data-i18n_dislike_tooltip="<?php echo __('I dislike this') ?>" data-i18n_unlike_tooltip="<?php echo __('Unlike') ?>" data-i18n_undislike_tooltip="<?php echo __('Undislike') ?>" data-i18n_share_text="<?php echo __('Would you like to share?') ?>" data-i18n_share_close="<?php echo __('Close') ?>"></span>
<?php if ($init): ?>
<script type="text/javascript">
    if (typeof(window.LikeBtn) != "undefined" && window.LikeBtn) {
        LikeBtn.init();
    }
</script>
<?php endif ?>
<script type="text/javascript" src="http://www.likebtn.com/js/widget.js" async="async"></script>