<?php slot('body_id') ?>body_sangha<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Sangha') ?><?php end_slot() ?>

<?php /*include_component('text', 'show', array('id'=>3)); */ ?>
<?php /*
<p>
    <?php echo __('If you have any questions, please, try to find answer or ask on the') ?> <a href="<?php echo UserPeer::FORUM_URL; ?>"><?php echo __('Forum') ?></a>. <?php echo __('Send your message to the email below in case of special emergency only. It is difficult for website programmer to answer all emails (there are only 24 hours in a day).') ?>
</p>
*/ ?>

<strong><?php echo __('E-mail') ?>:</strong> <a href="mailto:<?php echo UserPeer::MAIL_ADDRESS ?>"><?php echo UserPeer::MAIL_ADDRESS ?></a>
<br/><br/>

<h2 id="by_location"><?php echo __('By location'); ?></h2>
<?php include_component('locationlink', 'show');  ?>

<h2 id="by_language"><?php echo __('By language'); ?></h2>
<table class="documents_tbl">
    <tr>
        <th><div><?php echo __('Language'); ?></div></th>
        <th><div><?php echo __('Contact Details'); ?></div></th>
    </tr>
    <?php foreach($contactus_list as $contactus): ?>
        <tr>
            <td><strong><?php echo $contactus['language']; ?></strong> <span class="small light">(<?php echo $contactus['language_en']; ?>)</span></td>
            <td class="wrap">
            <?php foreach($contactus['list'] as $i=>$contactus_list_item): ?>
                    <?php if ($contactus_list_item['link']): ?>
                        <a href="<?php if (strstr($contactus_list_item['link'], '@')): ?><?php endif ?><?php echo $contactus_list_item['link']; ?>" class="external nowrap"><?php echo __($contactus_list_item['description']); ?></a><?php else: ?>
                        <span class="nowrap"><?php echo __($contactus_list_item['description']); ?></span>
                    <?php endif ?><?php if ($i != count($contactus['list'])-1 ): ?>&nbsp;&nbsp;<?php endif  ?>
            <?php endforeach ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<?php /*
<p>
    <strong><?php echo __('Official website') ?>:</strong> <a href="http://www.dharmasangha.org.np">www.dharmasangha.org.np</a>
</p>
<p>
    <strong><?php echo __('News and Teachings') ?>:</strong> <a href="http://paldendorje.com">www.paldendorje.com</a>
</p>
*/ ?>
<?php /*
<?php if (!empty($chapter_list)): ?>
    <br/>
    <table cellspacing="0" cellpadding="0" id="chapter_list" class="table">
    <tr>
        <th><?php echo __('Country') ?></th>
        <th><?php echo __('State, District, City') ?></th>
        <th><?php echo __('Main in country') ?></th>
        <th><?php echo __('Mem- bers') ?></th>
        <th><?php echo __('Responsible person') ?></th>
        <th><?php echo __('E-mail') ?></th>
    </tr>
    <?php foreach($chapter_list as $i=>$chapter_row): ?>
        <?php
        // 1-ю строку пропускаем
        if ($i == 0) {
            continue;
        }
        ?>
        <tr>
            <?php foreach($chapter_row as $chapter_item): ?>
                <td>
                <?php if (strstr($chapter_item, '@')): ?>
                    <a href="malto:<?php echo $chapter_item; ?>" class="small"><?php echo str_replace('@', ' @', $chapter_item); ?></a>
                <?php else: ?>
                    <?php echo $chapter_item; ?>
                <?php endif ?>
                </td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
    </table>
<?php endif ?>
*/ ?>
<br/>
<?php include_component('comments', 'show'); ?>