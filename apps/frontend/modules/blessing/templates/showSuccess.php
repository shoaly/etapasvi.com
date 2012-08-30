<?php slot('body_id') ?>body_blessing<?php end_slot() ?>

<h1><?php echo __('Blessing') ?></h1>

<div class="box">
<?/*<img src="/uploads/photo/preview/65652a2ac8a37a4a05d7606e50043f42.jpg" />*/?>
<?php include_component('photo', 'preview', array('id'=>1607)); ?>
</div>
<?php /*
<p>
<?php echo __('Though Dharma Sangha is extremely busy with his meditation approaching its final phase, Dharma Sangha is truly happy to bless everyone and has requested that we group together as much as possible to receive blessings in the most efficient manner.') ?>
</p>
*/ ?>
<br/>
<?php echo __('You may send photos, names and messages all in one email to') ?> <a href="mailto:<?php echo UserPeer::BLESSING_EMAIL ?>"><?php echo UserPeer::BLESSING_EMAIL ?></a> <?php echo __('(add photos as .jpg attachments up to 1MB each) or use the form below.') ?>
<br/><br/>
<?php echo __('Requests are collected and periodically printed and delivered together to Maha Sambodhi Dharma Sangha for blessing (do not expect to receive answers to the questions in your requests). You will be informed by email when your submission is blessed.') ?>
<br/><br/>

<script type="text/javascript">
$(document).ready(function(){
    new easyXDM.Socket({
        remote: "<?php echo UserPeer::BLESSING_URL . '?ln=' . UserPeer::getCultureBlessingLn() ?>",
        container: document.getElementById("blessing_iframe"),
        onMessage: function(message, origin){
            var h = parseInt(message);
            if (h > 60) {
                if (!$.browser.webkit) {
                    h += 60;
                }
                $("#blessing_iframe iframe:first").height(h);
            }
        }
    });
});
</script>
<div id="blessing_iframe"></div>
<?php /*
<iframe src="<?php echo UserPeer::BLESSING_URL ?>" frameborder="no" width="100%" height="300" id="blessing_iframe" style="overflow:hidden;"></iframe>
*/ ?>

<?php include_component('comments', 'show'); ?>	