<script type="text/javascript">
    window.CKEDITOR_BASEPATH = '/js/ckeditor/';
</script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace( 'entry.0.single' );
        CKEDITOR.replace( 'entry.1.single' );
    });
</script>
<p>
    <input type="radio" name="offer_tr_method" value="offer_tr_method_form" onclick="showOfferTrMethod(this)"> <?php echo __('Translate News, Photo, Audio or Video, presented on this page into any language.') ?>
</p>
<p>
    <input type="radio" name="offer_tr_method" value="offer_tr_method_messages" onclick="showOfferTrMethod(this)"> <?php echo __('Translate website interface from English into any other language.') ?>
</p>
<p class="light small">
    <?php echo __('Tutorials:') ?>
    <ul class="light small">
        <li><a href="https://docs.google.com/document/pub?id=1D6D5u6nvYG-A-7o_PqmYHRHEvjMaVkHGCCUXeyGO2l8" target="_blank" class="external"><?php echo __('Instructions for eTapasvi.com translators') ?></a></li>
    </ul>
</p>
<p class="light small">
    <?php echo __('Video tutorials:') ?>
    <ul class="light small">
        <li><a href="http://www.youtube.com/watch?v=WI4c1vT_yXg" target="_blank" class="external"><?php echo __('Translation Guide') ?></a></li>
        <li><a href="http://www.youtube.com/watch?v=F3E9-2FjdzA" target="_blank" class="external"><?php echo __('Video subtitles translation') ?></a></li>
    </ul>
</p>
<p class="light small">
    <?php echo __('Tips for translators:') ?>
    <ul class="light small">
        <li><?php echo __('Carefully read/watch instructions – respect your time and website programmer\'s time.') ?></li>
        <li><?php echo __('Before performing translation make sure, that text you are going to translate is not translated yet on website.') ?></li>
        <li><?php echo __('Distortion and misinterpretation of information during translation is not acceptable.') ?></li>        
        <li><?php echo __('In translated text replace Photo, Video and Audio elements with [photo], [video] and [audio] marks correspondingly. Make links underlined.') ?></li>        
        <li><?php echo __('If you would like to correct translation you sent, send both incorrect and correct versions in your language. It would allow programmer to find text, which should be replaced with correct one.') ?></li>
        <li><?php echo __('Only translations made in accordance with this instruction and sent using "Translate" link are published on website. Translations sent directly to website email will not be published.') ?></li>
        <li><?php echo __('Received translations are usually processed once a week, you can check sent translations status') ?>  <a href="https://docs.google.com/spreadsheet/pub?hl=en_US&hl=en_US&key=0ApLTjOcBiwykdF91dUtXaFFIcEZwNUptc3Z3Z3N3MVE&single=true&gid=4&output=html" title="<?php echo __('eTapasvi.com Translation : Status') ?>" target="_blank"><?php echo __('here') ?></a> <?php echo __('and in') ?> <a href="<?php echo url_for('@feed', true); ?>" title="<?php echo __('Feed') ?>"><?php echo __('Feed') ?></a>.</li>
    </ul>
</p>
<hr class="light"/>
<div id="offer_tr_method_messages" class="hidden offer_tr_method">
<br/>
<iframe frameborder="0" border="0" width="100%" height="810" src="/uploads/translate/index.html" ></iframe>
</div>

<div id="offer_tr_method_form" class="hidden offer_tr_method">
    <p>
        <?php echo __('Text') ?>:<br/>
        <span class="light">(<?php echo __('for example, if you translate news item, copy it\'s title and whole text into this field') ?>)</span>
        <br/><textarea name="entry.0.single" rows="8" id="entry.0.single"></textarea>
    </p>
    <p>
        <?php echo __('Translation') ?>:<br/>
        <span class="light">(<?php echo __('for example, if you translate news item, paste translation of it\'s title and text into this field') ?>)</span>
        <br/><textarea name="entry.1.single" rows="20" id="entry.1.single"></textarea>
    </p>
    <table cellspacing="0" cellpadding="0" class="form_table">
    <tr>
        <td><?php echo __('Language') ?>:</td>
        <td><select name="entry.4.single" id="entry_4">
            <option value=""></option>
            <?php foreach(UserPeer::$all_cultures as $culture_code => $culture_info): ?>
            <option value="<?php echo $culture_code; ?>"><?php echo UserPeer::getCultureFullName($culture_code); ?></option>
            <?php endforeach ?>
        </select>
        </td>
    </tr>
    <tr>
        <td><?php echo __('Email') ?>: </td><td><input type="text" name="entry.2.single" value="" /> (<?php echo __('optional') ?>)</td>
    </tr>
    <tr>
        <td><?php echo __('Translated by') ?>: </td><td><input type="text" name="entry.3.single" value="" /> (<?php echo __('optional') ?>)</td>
    </tr>
    <tr>
        <td><?php echo __('Comment') ?>: </td><td><input type="text" name="entry.9.single" value="" /> (<?php echo __('optional') ?>)</td>
    </tr>
    </table>
    <input type="hidden" name="pageNumber" value="0" />
    <input type="hidden" name="backupCache" value="" />
    <p class="center_text">
        <input type="submit" name="submit" value="<?php echo __('Send') ?>" id="offer_tr_submit"/>
    </p>
</div>