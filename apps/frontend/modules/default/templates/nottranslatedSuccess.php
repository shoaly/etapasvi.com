<?php slot('body_id') ?>body_nottranslated<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Page Not Transalated') ?><?php end_slot() ?>

<?php slot('meta') ?><meta name="robots" content="noindex,nofollow" /><?php end_slot() ?>

<?php echo __("If you can translate this page into your language please email us at") ?> <a href="mailto:<?php echo UserPeer::MAIL_ADDRESS ?>"><?php echo UserPeer::MAIL_ADDRESS ?></a>
<br/><br/>
<a href="javascript:history.back();void(0)"><?php echo __("Back") ?></a>