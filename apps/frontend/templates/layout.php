<!DOCTYPE html>
<html lang="<?php $user_culture = $sf_user->getCulture(); echo $user_culture; ?>" <?php if (UserPeer::isCultureDirectionRtl()):?>dir="rtl"<?php else: ?>dir="ltr"<?php endif ?>>
<head>
<meta charset="utf-8">
<?php /*if (UserPeer::isCultureHieroglyphic()):?><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /><?php endif*/ ?>
<?php $title = __(html_entity_decode($sf_response->getTitle())); ?>
<?php if ($sf_context->getModuleName() == 'news' && $sf_context->getActionName() == 'main'): ?>
<?php $description = __('Maha Sambodhi Dharma Sangha: Teachings, News, Photo, Video, Audio, Biography.'); ?>
<?php else: ?>
<?php $description = __('Maha Sambodhi Dharma Sangha') . ': ' . $title; ?>
<?php endif ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_slot('meta') ?>
<?php if (get_slot('robots')): ?><meta name="robots" content="<?php echo get_slot('robots'); ?>" /><?php endif ?>
<?php include_slot('alternate') ?>
<?php /*include_title()*/ ?>
<title><?php echo $title; ?> - <?php echo sfConfig::get('app_site_name'); ?></title>
<?php $app_domain_name = sfConfig::get('app_domain_name'); ?>
<link rel="shortcut icon" type="image/x-icon" href="http://<?php echo $app_domain_name; ?>/favicon.ico" />
<link rel="apple-touch-icon" href="http://<?php echo $app_domain_name; ?>/apple-touch-icon.png">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="http://<?php echo $app_domain_name; ?>/js/mb.miniAudioPlayer/jquery.mb.miniPlayer.js"></script>
<script type="text/javascript" src="<?php echo url_for('@js'); ?>"></script>
<link rel="stylesheet" type="text/css" media="screen" href="http://<?php echo $app_domain_name; ?>/css/css.css" />
<?php /*
<script type="text/javascript">
var _gaq = window._gaq || [];
window.onerror = function(msg, url, line) {
    var preventErrorAlert = true;
    _gaq.push(['_trackEvent', 'JS Error', msg, navigator.userAgent + ' -> ' + url + " : " + line]);
    return preventErrorAlert;
};
</script>
*/ ?>
</head>
<?php $body_id = get_slot('body_id'); ?>
<body id="<?php echo $body_id; ?>" class="culture_<?php echo $user_culture; ?><?php if (UserPeer::isCultureHieroglyphic()):?> hieroglyphic<?php endif ?> <?php include_slot('body_class') ?><?php if (UserPeer::isCultureLargeText()):?> large_text<?php endif ?><?php if (UserPeer::isCultureDirectionRtl()):?> direction_rtl<?php endif ?>">

<div id="wrapper">

<div id="header">
	<a href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>" class="no_decor"><i id="bubble_title">Tapasvi.<span>com</span></i></a>
</div>

<div id="content_wrapper">
	<div id="content">
        <?php $page_header = get_slot('page_header'); ?>
        <?php if ($page_header): ?>
            <div class="h1"><?php echo $page_header; ?></div>
        <?php endif ?>
        <?php $page_header_real = get_slot('page_header_real'); ?>
        <?php if ($page_header_real): ?>
            <h1><?php echo $page_header_real; ?></h1>
        <?php endif ?>
        <?php include_partial( 'global/toolbar' ); ?>
		<?php echo $sf_content ?>
	</div>
    <div id="menu">
        <?php include_partial('global/menu', array('body_id'=>$body_id /*, 'is_logged_in'=>UserPeer::authIsLoggedIn()*/) ); ?>
        <?php  include_partial('global/share');  ?>
        <?php /*
        <span id="lang_column"><!--UDLS-->
        <?php
            $uri          = $sf_request->getPathInfo();
            foreach( UserPeer::getCultures() as $culture) {
                $user_cultures[] = '/' . $culture . '/';
            }

            $params = str_replace( $user_cultures, '/', $uri);
            $user_cultures_data = UserPeer::getCulturesData();
            // всё, что идёт после #
            //preg_match('/#.*$/', $uri, $matches);
            //if (!empty($matches[0])) {
            //    $anchor = $matches[0];
            //} else {
             //   $anchor = '';
            //}
            $i = 0;
        ?>
        <?php foreach($user_cultures_data as $culture => $culture_data): ?>
            <?php $i++ ?>
            <?php if ($i > count(UserPeer::getCultures())) break; ?>

            <?php if ($user_culture == $culture): ?>
                <u><?php echo UserPeer::getCultureName( $culture ) ?></u>
            <?php else: ?>
                <a href="http://<?php echo $app_domain_name . '/'.$culture.$params; ?>" title="<?php echo $culture_data['name'] ?>"><?php echo $culture_data['name'] ?></a>
            <?php endif ?>
            <?php if ($i != count($user_cultures)): ?>
                <br/>
            <?php endif ?>
        <?php endforeach?>
        <!--UDLE--></span>
*/ ?>
    </div>
	<div id="footer">
        <div id="f_line"></div>
        <?php include_partial( 'global/lang_plain', array('app_domain_name'=>$app_domain_name, 'user_culture'=>$user_culture) ); ?>
        <?php $mobile_url = UserPeer::switchUrlMobile(sfContext::getInstance()->getRequest()->getUri());?>
        <?php $mobile_url = preg_replace("/\?.*/", '', $mobile_url) ;?>
        <div id="m_link">
            <?php /*<br/>
            <a href="<?php echo $mobile_url; ?>" title="<?php echo __('Mobile') ?>"><img src="http://qrcode.kaywa.com/img.php?s=3&amp;d=<?php echo urlencode($mobile_url); ?>" alt="<?php echo __('Mobile') ?>"/></a>*/ ?>
            <br/><!--UDLS--><a href="<?php echo $mobile_url; ?>" title="<?php echo __('Mobile') ?>"><?php echo __('Mobile') ?></a><!--UDLE-->
        </div>
	</div>
</div>

<div id="bubble_click">
	<map name="bubble_click_map" id="bubble_click_map">
	<area shape="circle" coords="154,135,135" href="<?php echo url_for('@main', true); ?>" title="<?php echo __('Home') ?>" />
	</map>
	<img usemap="#bubble_click_map" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" width="300" height="308" alt=""/>
</div>

<div id="bubble_mantra">
	<img src="http://<?php echo $app_domain_name; ?>/i/om_namo_guru_buddha_gyani.gif" title="<?php echo __('Om Namo Guru Buddha Gyani') ?>" />
<?php
/*
	<script type="text/javascript">
		$(document).ready(function() {
			var time = new Date(Date.parse('<?php include_component( 'idea', 'getthinkingtime' ); ?>'));
			$('#countdown').countdown(
				{until: time, compact: true, compactLabels: ['y', 'm', 'w', '<?php echo __('d') ?>']}
			);
		});
	</script>
	<acronym id="countdown" title="<?php echo __('Time remaining until meditation') ?>">
	</acronym>
*/
?>
</div>

<div id="bubble_lang">
<?php /*
	<span class="lang_name lang_selector b-fg b-fg_<?php echo strtoupper(UserPeer::getCultureIso( $user_culture ));?>" title="<?php echo UserPeer::getCultureName( $user_culture );?>"><img src="http://<?php echo $app_domain_name; ?>/i/fg.png" alt="<?php echo UserPeer::getCultureIso( $user_culture );?>" /></span>
	<?php // <span class="slide_arrow lang_selector">▼</span> ?>
    <?php // id используется в /lib/symfony/exception/sfError404Exception.class.php  ?>
	<div id="lang_list"><!--UDLS-->
        <table id="lang_box">
        <?php $i = 0; ?>
		<?php foreach($user_cultures_data as $culture => $culture_data): ?>
            <?php if ($i%2 == 0): ?>
                <tr>
            <?php endif ?>
            <td>
                <?php if ($i > count(UserPeer::getCultures())) break; ?>
                <i class="b-fg b-fg_<?php echo strtoupper($culture_data['iso']);?>"><img src="http://<?php echo $app_domain_name; ?>/i/fg.png"/></i>
                <?php if ($user_culture == $culture): ?>
                    <span class="light"><?php echo $culture_data['name']?></span>
                <?php else: ?>
                    <a href="http://<?php echo $_SERVER['HTTP_HOST'] . '/'.$culture.$params; ?>" title="<?php echo $culture_data['name']?>"><?php echo $culture_data['name']?></a>
                <?php endif ?>
            </td>
            <?php if ($i%2 == 1): ?>
                </tr>
            <?php endif ?>
            <?php if ( ($i == count($user_cultures_data)-1) && ($i%2 == 0)): ?>
                <td>&nbsp;</td></tr>
            <?php endif ?>
            <?php $i++ ?>
		<?php endforeach ?>
        </table><!--UDLE-->
    </div>
*/ ?>
</div>

<div id="bubble_quote"></div>

<div id="bubble_sound">
<?php /*if ($_GET['debug'] != 1): ?>
    <?php
        $song = get_component( 'song', 'randomsong' );
    ?>
	<div id="mp3" title="<?php echo $song; ?>" class="audio_player"><span><?php echo $song; ?></span></div>
<?php else: */?>
    <?php
        //$audio = get_component( 'audio', 'random' );
    ?>
	<?php /*<div id="mp3" title="" class="audio_item"><span>&nbsp;</span></div>*/ ?>
<?php /*endif */?>
</div>

<?php /*
<noscript>
	<div id="enable_javascript">
		<p class="error_list p1 center_text"><?php echo __('Please, enable JavaScript!') ?></p>
	</div>
</noscript>
*/ ?>

</div>

<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter11795683 = new Ya.Metrika({id:11795683,
                    clickmap:true,
                    accurateTrackBounce:true});
        } catch(e) {}
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/11795683" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<script type="text/javascript">
<?php /*include_component( 'text', 'js' ); */ ?>
var _gaq = _gaq || [];
_gaq.push(
    ['_setAccount', 'UA-4047144-3'],
    ['_setDomainName', 'www.etapasvi.com'],
    ['_trackPageview']
);
(function() {
 var ga = document.createElement('script');
 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
 ga.setAttribute('async', 'true');
 document.documentElement.firstChild.appendChild(ga);
})();
</script>
<?php /*<img style="width:0px;height:0px" src="http://www.maploco.com/vm24/s/3901457.png" />*/ ?>
</body>
</html>