<span class="likebtn-wrapper" data-identifier="<?php if ($identifier):?><?php echo $identifier; ?><?php endif ?>" data-lang="<?php echo $sf_user->getCulture(); ?>" data-dislike_enabled="false" data-color_scheme="youtube"></span>
<?php if ($init): ?>
<script type="text/javascript">
    if (typeof(window.LikeBtn) != "undefined" && window.LikeBtn) {
        LikeBtn.init();
    }
</script>
<?php endif ?>
<script type="text/javascript" src="http://www.likebtn.com/js/widget.js" async="async"></script>