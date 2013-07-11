<?php if (!empty($code)): ?>
    <?php if (strlen($code) <20): ?>
    <iframe height="382" frameborder="0" width="<?php if (!empty($wide) && $wide): ?>566<?php else: ?>520<?php endif ?>" allowfullscreen="" src="http://www.youtube.com/embed/<?php echo $code; ?>?rel=0<?php if ($autoplay): ?>&autoplay=1<?php endif ?>&cc_load_policy=1&amp;hl=<?php echo UserPeer::getCultureMsdn(); ?>&wmode=opaque&cc_lang_pref=<?php echo UserPeer::getCultureMsdn(); ?>"></iframe>
    <?php else: ?>
        <?php echo html_entity_decode($code); ?>
    <?php endif ?>
<?php endif ?>